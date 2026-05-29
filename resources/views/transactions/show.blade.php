<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detail Transaksi') }}</h2>
                <p class="text-sm text-gray-500">#{{ $transaction->id }} • {{ $transaction->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <button type="button" onclick="window.print()" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                    Cetak Invoice
                </button>
                <span class="text-sm font-semibold text-green-700">{{ ucfirst($transaction->status) }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
                <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold">Rincian Pembelian</h3>
                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-3xl bg-gray-50 p-4">
                                <p class="text-sm text-gray-500">Metode Pembayaran</p>
                                <p class="mt-2 text-gray-900">{{ $transaction->payment_method }}</p>
                            </div>
                            <div class="rounded-3xl bg-gray-50 p-4">
                                <p class="text-sm text-gray-500">Metode Pengiriman</p>
                                <p class="mt-2 text-gray-900">{{ $transaction->shipping_method }}</p>
                            </div>
                            <div class="rounded-3xl bg-gray-50 p-4 sm:col-span-2">
                                <p class="text-sm text-gray-500">Alamat Pengiriman</p>
                                <p class="mt-2 text-gray-900">{{ $transaction->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-gray-200 p-4">
                        <h4 class="text-base font-semibold text-gray-900">Item Pesanan</h4>
                        <div class="mt-4 space-y-4">
                            @foreach($transaction->items as $item)
                                <div class="grid gap-3 sm:grid-cols-[1fr_auto] items-center rounded-3xl bg-gray-50 p-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                            <p class="text-sm text-gray-500">Qty {{ $item->quantity }}</p>
                                            @if($item->size)
                                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">Ukuran: {{ $item->size }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500">Harga</p>
                                        <p class="font-semibold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <aside class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Transaksi</h3>
                    <div class="space-y-4 text-sm text-gray-600">
                        <div class="flex items-center justify-between">
                            <span>Total item</span>
                            <span>{{ $transaction->items->sum('quantity') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Total bayar</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Pelanggan</span>
                            <span>{{ $transaction->user->name }}</span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
