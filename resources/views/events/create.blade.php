@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl bg-white p-6 shadow-lg rounded-xl mt-6">
    <h4 class="text-2xl font-semibold mb-4 text-gray-700">Tambah Event</h4>

    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama Event</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400" required>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Lokasi</label>
            <input type="text" name="location" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400" required>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
            <input type="date" name="date" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400" required>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400"></textarea>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Gambar Event</label>
            <input type="file" name="image" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400 form-control">
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('events.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
