<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index(Request $request)
    {
        if (!session('is_logged_in')) {
            return redirect('dashboard')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (session('role') !== 'admin') {
            return redirect('dashboard')->with('error', 'Akses ditolak!! Hanya admin yang dapat mengakses halaman ini.');
        }

        $query = Event::orderBy('id', 'asc');
        $events = $query->get();

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events/img', 'public');
            $imagePath = 'storage/' . $path;
        }

        Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'date' => $request->date,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $event->image;
        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }
            $path = $request->file('image')->store('events/img', 'public');
            $imagePath = 'storage/' . $path;
        }

        $event->update([
            'name' => $request->name,
            'location' => $request->location,
            'date' => $request->date,
            'description' => $request->description,
            'image' => $imagePath,
        ]);


        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->route('events.index');
    }
}
