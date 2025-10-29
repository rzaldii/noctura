@extends('layouts.app')
@section('content')

<h4 class="ml-31 text-2xl">Daftar Tiket Event <strong>{{ $event->name }}</strong></h4>
<p class="ml-31 mt-4 mb-6">
    <a href="{{ route('events.index') }}" class="mx-1 text-white bg-gray-600 py-2 px-3 rounded-md mb-10 my-3 ml-31">← Kembali ke Event</a>
</p>
<a href="{{ route('tickets.create', $event->id) }}" class="mx-1 text-white bg-pink-600 hover:bg-pink-700 py-2 px-3 rounded-md mb-10 my-3 ml-31">+ Tambah Tiket</a>

<div class="mt-5 mx-30 flex justify-center items-center shadow-md rounded-xl overflow-hidden">
    <table class="justify-center items-center min-w-full divide-y divide-gray-200">
        <tr class="text-center bg-gray-800 text-white">
            <th class="px-4 py-2">Jenis Tiket</th>
            <th class="px-4 py-2">Harga</th>
            <th class="px-4 py-2">Stok</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>

        @forelse ($event->tickets as $ticket)
        <tr class="bg-gray-50 hover:bg-gray-100 text-center">
            <td class="font-semibold py-2 px-4">{{ $ticket->type }}</td>
            <td class="py-2 px-4">Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
            <td class="py-2 px-4">{{ $ticket->stock }}</td>
            <td class="py-2 px-4 flex justify-center">
                <a href="{{ route('tickets.edit', $ticket->id) }}" class="mx-1 text-white bg-yellow-500 py-1 px-2 rounded-md hover:bg-yellow-600 duration-300">Edit</a>
                <a href="{{ route('tickets.destroy', $ticket->id) }}" class="mx-1 text-white bg-red-500 py-1 px-2 rounded-md hover:bg-red-600 duration-300">Hapus</a>
            </td>
        </tr>
        @empty
        <tr class="bg-gray-100">
            <td colspan="4" class="text-center text-muted py-5">Belum ada tiket</td>
        </tr>
        @endforelse
    </table>
</div>


@endsection
