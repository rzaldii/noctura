<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Ticket;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        return view('cart', compact('cart'));
    }

    public function add(Request $request, $ticket_id)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);

        // ambil data tiket dari DB (kalau tiket ada)
        $ticket = Ticket::with('event')->find($ticket_id);

        if ($ticket) {
        $eventName = $ticket->event->name ?? 'Event Tidak Diketahui';

        $exists = collect($cart)->firstWhere('id', $ticket->id);
        if (!$exists) {
            $cart[] = [
                'id' => $ticket->id,
                'event_name' => $eventName,
                'name' => $ticket->type ?? 'Tiket Event',
                'price' => $ticket->price ?? 50000,
            ];
        }
    }

        Cookie::queue('cart', json_encode($cart), 60 * 24);
        return redirect()->route('cart.show')->with('success', 'Tiket ditambahkan ke keranjang!');
    }

    public function remove(Request $request, $ticket_id)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $cart = array_filter($cart, fn($item) => $item['id'] != $ticket_id);

        Cookie::queue('cart', json_encode(array_values($cart)), 60 * 24);
        return redirect()->route('cart.show')->with('success', 'Tiket dihapus dari keranjang!');
    }

    // form pembelian
    public function buy($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        if (!$ticket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        // kirim data ke view cart dengan flag showForm
        $cart = [[
            'id' => $ticket->id,
            'name' => $ticket->type ?? 'Tiket Event',
            'price' => $ticket->price ?? 50000,
        ]];

        return view('cart', compact('cart'))->with('showForm', true);
    }

    // proses pembelian
    public function purchase(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // bisa disimpan ke tabel transaksi nanti, tapi sekarang cukup notif sukses
        Cookie::queue(Cookie::forget('cart'));
        return redirect()->route('dashboard')->with('success', 'Tiket berhasil dibeli!');
    }
}
