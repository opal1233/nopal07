<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-white to-gray-50">
        <!-- Breadcrumb -->
        <nav class="px-4 py-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-2 text-sm">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">Produk</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-900 font-semibold">{{ $product->name }}</span>
                </div>
            </div>
        </nav>

        <div class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid gap-8 lg:grid-cols-2 items-start">
                    <!-- Product Image Section -->
                    <div class="space-y-4">
                        <div class="relative rounded-2xl overflow-hidden bg-gray-100 aspect-square shadow-lg">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover" />
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                                </div>
                            @endif
                            <!-- Badge -->
                            <div class="absolute top-4 left-4 inline-block rounded-full bg-red-500 text-white text-xs font-bold px-4 py-2">
                                🔥 Pilihan
                            </div>
                            <!-- Stock Badge -->
                            @if($product->stock > 0)
                                <div class="absolute bottom-4 left-4 inline-block rounded-full bg-green-500 text-white text-xs font-bold px-4 py-2">
                                    ✓ Stok tersedia
                                </div>
                            @else
                                <div class="absolute bottom-4 left-4 inline-block rounded-full bg-red-600 text-white text-xs font-bold px-4 py-2">
                                    Habis Terjual
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info Section -->
                    <div class="space-y-6">
                        <!-- Header Info -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="inline-block mb-3 px-3 py-1 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full">
                                {{ $product->category->name }}
                            </div>
                            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>
                            
                            <!-- Rating -->
                            <div class="flex items-center gap-2 mb-4">
                                <div class="flex gap-0.5">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-5 h-5 {{ $i < 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-600 text-sm">(4.5/5 - 128 ulasan)</span>
                            </div>

                            <!-- Price Section -->
                            <div class="flex items-baseline gap-3 mb-4">
                                <span class="text-4xl font-bold text-[#8b4513]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-lg text-gray-500 line-through">Rp {{ number_format($product->price * 1.25, 0, ',', '.') }}</span>
                                <span class="text-sm font-bold bg-red-100 text-red-700 px-3 py-1 rounded-full">-20%</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-semibold text-gray-800">Ukuran tersedia</p>
                                <p class="text-sm text-gray-600">39, 40, 41, 42, 43, 44</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-gray-900">Deskripsi Produk</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <!-- Key Features -->
                        <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">Stok: {{ $product->stock }}</p>
                                    <p class="text-gray-600">Tersedia</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">Pengiriman</p>
                                    <p class="text-gray-600">1-2 hari</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">Pembayaran</p>
                                    <p class="text-gray-600">Transfer/COD</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">Jaminan</p>
                                    <p class="text-gray-600">100% Aman</p>
                                </div>
                            </div>
                        </div>

                        <!-- Add to Cart / Login -->
                        <div class="space-y-3 pt-4">
                            @auth
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-3">
                                    @csrf
                                    <div>
                                        <label for="size" class="block text-sm font-semibold text-gray-900 mb-2">Pilih Ukuran</label>
                                        <div class="grid grid-cols-4 gap-2">
                                            @foreach(['35', '36', '37', '38', '39', '40', '41', '42'] as $sizeOption)
                                                <label class="relative">
                                                    <input type="radio" name="size" value="{{ $sizeOption }}" class="hidden peer" required />
                                                    <span class="block py-2 px-3 text-center text-sm font-semibold border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-[#8b4513] peer-checked:text-white peer-checked:border-[#8b4513] hover:border-[#8b4513] transition">{{ $sizeOption }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <label for="quantity" class="block text-sm font-semibold text-gray-900 mb-2">Jumlah Pembelian</label>
                                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                            <button type="button" class="px-4 py-3 bg-gray-100 text-gray-600 hover:bg-gray-200 transition" onclick="decreaseQuantity()">−</button>
                                            <input id="quantity" name="quantity" type="number" value="1" min="1" max="{{ $product->stock }}" class="flex-1 text-center py-3 border-0 focus:ring-0" />
                                            <button type="button" class="px-4 py-3 bg-gray-100 text-gray-600 hover:bg-gray-200 transition" onclick="increaseQuantity()">+</button>
                                        </div>
                                    </div>

                                    <div class="grid gap-3 sm:grid-cols-2">
                                        <button type="submit" class="w-full bg-[#8b4513] hover:bg-[#a0550f] text-white font-bold py-4 px-6 rounded-lg transition transform hover:scale-105 flex items-center justify-center gap-2 shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            Tambah ke Keranjang
                                        </button>
                                        <a href="{{ route('products.buy-now', $product) }}" class="inline-flex items-center justify-center rounded-lg border border-[#8b4513] bg-white text-[#8b4513] font-bold py-4 px-6 transition hover:bg-[#f4ede6] hover:text-[#7a3216] shadow-sm">
                                            🛍️ Beli Sekarang
                                        </a>
                                    </div>
                                </form>
                            @else
                                <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-6 text-center">
                                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    <p class="text-gray-700 mb-4">Silakan login untuk menambahkan produk ke keranjang</p>
                                    <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                                        Login Sekarang
                                    </a>
                                </div>
                            @endauth

                            <!-- Share Buttons -->
                            <div class="flex gap-2 pt-2 border-t border-gray-200">
                                <button class="flex-1 py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    Bagikan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.max);
            const current = parseInt(input.value);
            if (current < max) {
                input.value = current + 1;
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current > 1) {
                input.value = current - 1;
            }
        }
    </script>
</x-app-layout>
