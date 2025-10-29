@extends('layouts.app')
@section('content')

<h1 class="font-bold text-3xl text-center mb-6">Daftar Event</h1>
<a href="{{ route('events.create') }}" class="mx-1 text-white bg-pink-600 hover:bg-pink-700 py-2 px-3 rounded-md">
    + Tambah Event
</a>
<div class="mt-5 mx-30 flex justify-center items-center shadow-md rounded-xl overflow-hidden">
    <table class="justify-center items-center min-w-full divide-y divide-gray-200">
        <tr class="items-center justify-center text-center py-2 px-3 bg-gray-700 text-white">
            <th class="px-4 py-4">Gambar</th>
            <th class="px-4 py-4">Nama Event</th>
            <th class="py-2 px-20">Lokasi</th>
            <th class="py-2 px-16">Tanggal</th>
            <th class="py-2 px-14">Button</th>
        </tr>

        @foreach ($events as $event)
            <tr class="bg-gray-50 hover:bg-gray-100 text-center">
                <td class="py-1 px-2">
                    <img src="{{ asset($event->image) }}" alt="Event Image" class="w-10 h-10 object-cover rounded-md items-center justify-center mx-auto">
                </td>
                <td class="font-semibold py-2 px-4">{{ $event->name }}</td>
                <td class="py-2 px-4">{{ $event->location }}</td>
                <td class="py-2 px-4">{{ $event->date }}</td>
                <td class="py-2.5 px-4 flex justify-center">
                    <a href="{{ route('tickets.index', $event->id) }}" class="mx-1 text-white bg-green-500 py-1 px-2 rounded-md hover:bg-green-600 duration-300">Manage Tiket</a>
                    <a href="{{ route('events.edit', $event->id) }}" class="mx-1 text-white bg-yellow-500 py-1 px-2 rounded-md hover:bg-yellow-600 duration-300">Edit</a>
                    <a href="{{ route('events.destroy', $event->id) }}" class="mx-1 text-white bg-red-500 py-1 px-2 rounded-md hover:bg-red-600 duration-300">Hapus</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<div class="height h-150"></div>
@endsection
