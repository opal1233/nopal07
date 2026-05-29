<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-white to-gray-50">
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">💳 Checkout Pembayaran</h1>
                        <p class="text-sm text-gray-600 mt-2">Lengkapi pembayaran dan pengiriman di halaman terpisah dari keranjang belanja.</p>
                    </div>
                    <a href="{{ route('cart.index') }}" class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>

        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="border border-gray-200 rounded-xl p-4 hover:border-blue-300 transition">
                                    <div class="flex gap-4">
                                        <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                            @if($item->product->image)
                                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->product->description, 60) }}</p>
                                            <div class="mt-3 flex items-center gap-4">
                                                <span class="text-lg font-bold text-[#8b4513]">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                                <span class="text-sm text-gray-600">× {{ $item->quantity }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-600">Subtotal</p>
                                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="space-y-4">
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
                                    <p class="text-sm opacity-90">Silakan lengkapi data di bawah untuk menyelesaikan pembayaran.</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('cart.checkout') }}" method="POST" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                            @csrf
                            <h3 class="text-lg font-bold text-gray-900 mb-4">📋 Detail Pembayaran</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
                                    <select id="payment_method" name="payment_method" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8b4513] focus:border-transparent transition">
                                        <option value="">-- Pilih Metode --</option>
                                        <option value="Transfer">💳 Transfer Bank</option>
                                        <option value="COD">🚚 COD (Bayar di Tempat)</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="shipping_method" class="block text-sm font-semibold text-gray-700 mb-2">Kurir Pengiriman</label>
                                    <select id="shipping_method" name="shipping_method" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8b4513] focus:border-transparent transition">
                                        <option value="">-- Pilih Kurir --</option>
                                        <option value="JNE">🚚 JNE (1-2 hari)</option>
                                        <option value="J&T">📦 J&T (1-2 hari)</option>
                                        <option value="Grab Express">🏍️ Grab Express (Hari Sama)</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Pengiriman</label>
                                    <textarea id="address" name="address" rows="4" placeholder="Jl. Contoh No. 123, RT/RW 01/02, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8b4513] focus:border-transparent transition resize-none"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-[#8b4513] to-[#a0550f] hover:from-[#a0550f] hover:to-[#b8611a] text-white font-bold py-4 px-6 rounded-xl transition transform hover:scale-105 shadow-lg flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Bayar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
