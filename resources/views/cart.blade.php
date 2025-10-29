@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Keranjang Tiket</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-3 text-center">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
        <table class="w-full text-left border-collapse mb-5">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Nama Event</th>
                    <th class="p-2">Nama Tiket</th>
                    <th class="p-2">Harga</th>
                    <th class="p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item['event_name'] ?? 'Event Tidak Diketahui' }}</td>
                        <td class="p-2">{{ $item['name'] }}</td>
                        <td class="p-2">Rp {{ number_format($item['price']) }}</td>
                        <td class="p-2 text-center">
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center">
            <button id="showFormBtn" class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded-md">
                Beli Tiket
            </button>
        </div>

        {{-- FORM PEMBELIAN --}}
        <div id="purchaseForm" class="bg-pink-100 p-5 rounded-lg w-2/3 mx-auto mt-5 hidden">
            <h3 class="text-lg font-semibold text-center mb-3">Form Pembelian</h3>

            <form id="purchaseFormReal" action="{{ route('cart.purchase') }}" method="POST">
                @csrf
                @foreach($cart as $item)
                    <div class="border-b border-gray-300 mb-3 pb-3">
                        <p><strong>Nama Event:</strong> {{ $item['event_name'] ?? '-' }}</p>
                        <p><strong>Nama Tiket:</strong> {{ $item['name'] }}</p>
                        <p><strong>Harga per Tiket:</strong> Rp <span class="price">{{ number_format($item['price']) }}</span></p>

                        <div class="flex items-center gap-2 mt-2">
                            <button type="button" class="bg-pink-400 text-white px-2 rounded decrease">-</button>
                            <input type="number" name="quantity[{{ $item['id'] }}]" value="1" min="1"
                                class="w-16 text-center border border-gray-300 rounded">
                            <button type="button" class="bg-pink-400 text-white px-2 rounded increase">+</button>
                        </div>

                        <p class="mt-2"><strong>Total Harga:</strong>
                            <span class="total">Rp {{ number_format($item['price']) }}</span>
                        </p>
                    </div>
                @endforeach

                {{-- Total keseluruhan --}}
                <div class="text-right font-bold text-lg mt-4">
                    Total Keseluruhan: <span id="grandTotal">Rp 0</span>
                </div>

                <div class="text-center mt-5">
                    <button id="buyNowBtn" type="submit"
                        class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded-md">
                        Beli Sekarang
                    </button>
                </div>
            </form>
        </div>

        {{-- SCRIPT --}}
        <script>
            const showFormBtn = document.getElementById('showFormBtn');
            const purchaseForm = document.getElementById('purchaseForm');
            const grandTotalEl = document.getElementById('grandTotal');

            showFormBtn.addEventListener('click', () => {
                purchaseForm.classList.toggle('hidden');
                hitungTotalKeseluruhan();
            });

            document.querySelectorAll('.increase').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    input.value = parseInt(input.value) + 1;
                    updateTotal(this);
                });
            });

            document.querySelectorAll('.decrease').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.nextElementSibling;
                    if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
                    updateTotal(this);
                });
            });

            function updateTotal(btn) {
                const wrapper = btn.closest('div.border-b');
                const price = parseInt(wrapper.querySelector('.price').innerText.replace(/\D/g, ''));
                const qty = parseInt(wrapper.querySelector('input[type=number]').value);
                const totalEl = wrapper.querySelector('.total');
                totalEl.innerText = "Rp " + (price * qty).toLocaleString();
                hitungTotalKeseluruhan();
            }

            function hitungTotalKeseluruhan() {
                let total = 0;
                document.querySelectorAll('.total').forEach(el => {
                    total += parseInt(el.innerText.replace(/\D/g, '')) || 0;
                });
                grandTotalEl.innerText = "Rp " + total.toLocaleString();
            }

            // efek pembelian berhasil
            const form = document.getElementById('purchaseFormReal');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = document.getElementById('buyNowBtn');
                btn.innerText = 'Selesai';
                btn.disabled = true;

                const notif = document.createElement('div');
                notif.className = 'bg-green-200 text-green-800 p-2 rounded mb-3 text-center';
                notif.innerText = 'Pesanan berhasil!';
                form.parentNode.insertBefore(notif, form);

                setTimeout(() => {
                    form.submit();
                }, 1500);
            });

            // Jalankan awal
            hitungTotalKeseluruhan();
        </script>

    @else
        <p class="text-center text-gray-600">Keranjang masih kosong</p>
    @endif
</div>
@endsection
