<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;

// LOGIN
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// EVENTS
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}/update', [EventController::class, 'update'])->name('events.update');
Route::get('/events/{id}/destroy', [EventController::class, 'destroy'])->name('events.destroy');

// TICKETS
Route::get('/tickets/{event_id}', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{event_id}/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets/{event_id}/store', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
Route::put('/tickets/{id}/update', [TicketController::class, 'update'])->name('tickets.update');
Route::get('/tickets/{id}/destroy', [TicketController::class, 'destroy'])->name('tickets.destroy');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CART
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add/{ticket_id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{ticket_id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cart/buy/{ticket_id}', [CartController::class, 'buy'])->name('cart.buy');
Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');

Route::get('/test-session', function () {return response()->json(Session::all());});
