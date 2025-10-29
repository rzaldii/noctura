<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Event;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Simpan event terakhir yang ditambahkan
        $lastEvent = Event::latest()->first();
        Session::put('event_terakhir', $lastEvent ? $lastEvent->name : 'Belum ada event');

        // Simpan pemesanan terakhir
        $lastTicket = Ticket::latest()->first();
        if ($lastTicket) {
            Session::put('pemesanan_terakhir', [
                'event' => $lastTicket->event->name ?? 'Tidak diketahui',
                'tanggal' => $lastTicket->created_at->format('Y-m-d H:i:s'),
                'jumlah' => $lastTicket->quantity ?? 1,
            ]);
        } else {
            Session::put('pemesanan_terakhir', 'Belum ada pemesanan');
        }

        // Fitur pencarian event
        $query = Event::orderBy('date', 'asc');
        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(name) LIKE ?', ["{$search}%"]);
        }

        $events = $query->get();

        return view('dashboard', compact('events'));
    }
}
