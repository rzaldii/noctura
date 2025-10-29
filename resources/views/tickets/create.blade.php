@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl bg-white p-6 shadow-lg rounded-xl mt-6">
  <h4 class="text-2xl font-semibold mb-4 text-gray-700">
    Tambah Tiket untuk Event: <span class="font-bold">{{ $event->name }}</span>
  </h4>

  <form method="POST" action="{{ route('tickets.store', $event->id) }}" class="space-y-4">
    @csrf

    <div>
      <label class="block text-gray-700 font-medium mb-1">Jenis Tiket</label>
      <input type="text" name="type" placeholder="Contoh: VIP, Regular, Student"
        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400" required>
    </div>

    <div>
      <label class="block text-gray-700 font-medium mb-1">Harga</label>
      <input type="number" name="price"
        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400" required>
    </div>

    <div>
      <label class="block text-gray-700 font-medium mb-1">Stok</label>
      <input type="number" name="stock"
        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-gray-400" required>
    </div>

    <div class="flex justify-end gap-2 pt-4">
      <a href="{{ route('tickets.index', $event->id) }}"
        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</a>
      <button type="submit"
        class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">Simpan</button>
    </div>
  </form>
</div>
@endsection
