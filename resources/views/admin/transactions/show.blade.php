<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detail Transaksi Admin') }}</h2>
                <p class="text-sm text-gray-500">#{{ $transaction->id }}</p>
            </div>
            <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition button-press">Hapus Transaksi</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Informasi Pembeli</h3>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div><strong>Nama:</strong> {{ $transaction->user->name }}</div>
                            <div><strong>Email:</strong> {{ $transaction->user->email }}</div>
                            <div><strong>Telepon:</strong> {{ $transaction->user->phone ?? 'Tidak tersedia' }}</div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Rincian Pengiriman</h3>
                            <div class="space-y-3 text-sm text-gray-600">
                                <div><strong>Alamat:</strong> {{ $transaction->address }}</div>
                                <div><strong>Metode Pengiriman:</strong> {{ $transaction->shipping_method }}</div>
                                <div><strong>Metode Pembayaran:</strong> {{ $transaction->payment_method }}</div>
                            </div>
                        </div>
                    </div>

                    <aside class="rounded-3xl bg-gray-50 p-5">
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm uppercase tracking-[0.12em] text-gray-500">Status</h4>
                                <p class="mt-2 text-sm font-semibold text-gray-900">{{ ucfirst($transaction->status) }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm uppercase tracking-[0.12em] text-gray-500">Total Bayar</h4>
                                <p class="mt-2 text-2xl font-semibold text-[#f53003]">Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </aside>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Item Transaksi</h3>
                    <div class="space-y-3">
                        @foreach($transaction->items as $item)
                            <div class="rounded-3xl border border-gray-200 bg-white p-4 shadow-sm">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">Qty {{ $item->quantity }}</p>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
