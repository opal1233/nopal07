<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-white to-gray-50">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-gray-900">🛒 Keranjang Belanja</h1>
                    <a href="{{ route('products.index') }}" class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        + Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>

        @if($cartItems->isEmpty())
            <!-- Empty Cart -->
            <div class="py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl border-2 border-dashed border-gray-300 p-12 text-center shadow-sm">
                        <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <p class="text-xl text-gray-600 mb-4">Keranjang Anda masih kosong</p>
                        <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                            Mulai Belanja
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="py-8 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto grid gap-8 lg:grid-cols-3">
                    <!-- Cart Items Section -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">{{ $cartItems->count() }}</span>
                                Item Dalam Keranjang
                            </h2>

                            <div class="space-y-4">
                                @foreach($cartItems as $item)
                                    <div class="border border-gray-200 rounded-xl p-4 hover:border-blue-300 transition">
                                        <div class="flex gap-4">
                                            <!-- Product Image -->
                                            <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                                @if($item->product->image)
                                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" />
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Product Info -->
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->product->description, 60) }}</p>
                                                <div class="mt-3 flex flex-wrap items-center gap-3">
                                                    <span class="text-lg font-bold text-[#8b4513]">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                                    <span class="text-sm text-gray-600">× {{ $item->quantity }}</span>
                                                    @if($item->size)
                                                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Ukuran: {{ $item->size }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Price & Remove -->
                                            <div class="flex flex-col items-end justify-between">
                                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-semibold transition">
                                                        ✕ Hapus
                                                    </button>
                                                </form>
                                                <div class="text-right">
                                                    <p class="text-xs text-gray-600">Subtotal</p>
                                                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Summary Section - SEPARATED -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-6 space-y-4">
                            <!-- Payment Summary Card -->
                            <div class="bg-gradient-to-br from-[#8b4513] to-[#a0550f] rounded-2xl shadow-lg p-6 text-white">
                                <h3 class="text-2xl font-bold mb-6">Ringkasan Pembayaran</h3>

                                <div class="space-y-4 mb-6 pb-6 border-b border-white/30">
                                    <div class="flex justify-between items-center">
                                        <span class="opacity-90">Total Produk</span>
                                        <span class="font-semibold">{{ $cartItems->sum('quantity') }} item</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="opacity-90">Subtotal</span>
                                        <span class="font-semibold">Rp {{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->price), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="opacity-90">Pajak (0%)</span>
                                        <span class="font-semibold">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="opacity-90">Biaya Admin</span>
                                        <span class="font-semibold">Gratis</span>
                                    </div>
                                </div>

                                <div class="bg-white/20 rounded-xl p-4 mb-6">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-semibold">Total Pembayaran</span>
                                            <span class="text-3xl font-bold">Rp {{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->price), 0, ',', '.') }}</span>
                                        </div>
                                        <a href="{{ route('cart.checkout.form') }}" class="self-end rounded-xl bg-white/20 border border-white/40 py-3 px-5 text-sm font-semibold text-white hover:bg-white/30 transition">
                                            Beli Sekarang
                                        </a>
                                    </div>
                                </div>

                                <!-- Info Box -->
                                <div class="bg-white/10 rounded-lg p-3 text-sm mb-6">
                                    <p class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.778 8.222c-4.296-4.296-11.26-4.296-15.556 0A11.994 11.994 0 01.808 15.192a1 1 0 001.414 1.414A9.964 9.964 0 0110 2.073a9.964 9.964 0 016.778 14.533 1 1 0 001.414-1.414A11.994 11.994 0 0117.778 8.222z" clip-rule="evenodd"/></svg>
                                        Checkout dalam 30 menit untuk penawaran spesial
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
