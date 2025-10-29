<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index($event_id)
    {
        $event = Event::with('tickets')->findOrFail($event_id);
        return view('tickets.index', compact('event'));
    }

    public function create($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('tickets.create', compact('event'));
    }

    public function store(Request $request, $event_id)
    {
        Ticket::create([
            'event_id' => $event_id,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        return redirect()->route('tickets.index', $event_id);
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        return redirect()->route('tickets.index', $ticket->event_id);
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index', $ticket->event_id);
    }
}
