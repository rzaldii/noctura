<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::orderBy('date', 'asc');

        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(name) LIKE ?', ["{$search}%"]);
        }

        $events = $query->get();

        return view('dashboard', compact('events'));
    }
}
