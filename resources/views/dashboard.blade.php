@extends('layouts.app')
@section('content')

@if (session('error'))
<div class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-3 text-center w-5/12 mx-auto">
    {{ session('error') }}
</div>
@endif

<h1 class="font-bold text-3xl text-center mt-6 mb-8">Hallowww {{ session('userr') }}, Mau cari Event apa nihh?</h1>

<form action="{{ route('dashboard') }}" method="GET" class="text-center mb-6">
    <input type="text" name="search" placeholder="Cari event..."
           value="{{ request('search') }}"
           class="border border-gray-400 rounded-lg px-3 py-2 w-1/3 focus:ring-2 focus:ring-pink-400 focus:outline-none">
    <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700">Cari</button>
</form>

<div class="my-6 mx-30 px-10 py-8 grid grid-cols-3 gap-10 shadow-md rounded-xl">
    @forelse ($events as $event)
        <form action="" class="shadow-md rounded-md flex gap-4 py-3 px-3 bg-gray-100">
            <div>
                <img src="{{ asset($event->image) }}" alt="Event Image"
                    class="w-40 h-56 rounded-md border-2 border-gray-800 object-cover object-center mx-auto">
            </div>
            <div class="mx-3">
                <h1 class="text font-semibold pt-3 pb-2">{{ $event->name }}</h1>
                <p class="text-sm text-gray-600 py-2">📅 {{ $event->date }}</p>
                <p class="text-sm text-gray-600 pb-2">📍 {{ $event->location }}</p>
                <p class="text-sm text-gray-800 pb-3">Tiket Tersedia: {{ $event->tickets->sum('stock') }}</p>
                <button type="submit" class="text-white bg-pink-600 hover:bg-pink-700 py-1 px-3 mt-2 rounded-md">
                    Beli Tiket
                </button>
            </div>
        </form>
    @empty
        <p class="col-span-3 text-center text-gray-600 text-lg py-10">
            Tidak ada event yang ditemukan.
        </p>
    @endforelse
</div>

<div class="height h-150"></div>
@endsection
