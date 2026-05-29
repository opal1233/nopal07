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
                    <span class="text-gray-900 font-semibold">Checkout</span>
                </div>
            </div>
        </nav>

        <div class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Beli Sekarang</h1>
                        <p class="text-gray-600 mb-8">Pilih ukuran dan lanjutkan ke pembayaran</p>

                        <div class="grid gap-8 lg:grid-cols-[1fr_350px] items-start">
                            <!-- Product Info -->
                            <div class="space-y-6">
                                <!-- Product Details -->
                                <div class="border border-gray-200 rounded-xl p-6">
                                    <div class="flex gap-6">
                                        <div class="w-40 h-40 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                            @if($product->image)
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h2 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h2>
                                            <p class="text-sm text-gray-600 mt-2">{{ $product->category->name }}</p>
                                            <p class="text-gray-700 leading-relaxed mt-4">{{ $product->description }}</p>
                                            <div class="mt-4 flex items-center gap-4">
                                                <span class="text-3xl font-bold text-[#8b4513]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                @if($product->stock > 0)
                                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">✓ Stok Tersedia</span>
                                                @else
                                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full">Habis Terjual</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Form -->
                            <div class="bg-gradient-to-br from-[#8b4513] to-[#a0550f] rounded-xl shadow-lg p-6 text-white h-fit sticky top-20">
                                <h3 class="text-xl font-bold mb-6">Ringkasan Pesanan</h3>

                                @auth
                                    <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-4">
                                        @csrf

                                        <!-- Size Selection -->
                                        <div>
                                            <label class="block text-sm font-semibold mb-3">Pilih Ukuran</label>
                                            <div class="grid grid-cols-4 gap-2">
                                                @foreach(['35', '36', '37', '38', '39', '40', '41', '42'] as $sizeOption)
                                                    <label class="relative">
                                                        <input type="radio" name="size" value="{{ $sizeOption }}" class="hidden peer" required />
                                                        <span class="block py-2 px-3 text-center text-sm font-semibold border border-white/40 rounded-lg cursor-pointer peer-checked:bg-white peer-checked:text-[#8b4513] hover:border-white transition">{{ $sizeOption }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            @error('size')
                                                <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Quantity -->
                                        <div>
                                            <label class="block text-sm font-semibold mb-2">Jumlah</label>
                                            <div class="flex items-center border border-white/40 rounded-lg overflow-hidden bg-white/10">
                                                <button type="button" class="px-3 py-2 text-white hover:bg-white/20 transition" onclick="decreaseQty()">−</button>
                                                <input id="qty" name="quantity" type="number" value="1" min="1" max="{{ $product->stock }}" class="flex-1 text-center py-2 border-0 focus:ring-0 bg-transparent text-white text-sm" />
                                                <button type="button" class="px-3 py-2 text-white hover:bg-white/20 transition" onclick="increaseQty()">+</button>
                                            </div>
                                        </div>

                                        <!-- Price Summary -->
                                        <div class="bg-white/20 rounded-lg p-4 mt-6 pt-6 border-t border-white/30">
                                            <div class="flex justify-between items-center mb-3">
                                                <span>Harga Satuan</span>
                                                <span class="font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="flex justify-between items-center text-xl font-bold">
                                                <span>Total</span>
                                                <span>Rp <span id="total-price">{{ number_format($product->price, 0, ',', '.') }}</span></span>
                                            </div>
                                        </div>

                                        <!-- Payment & Shipping -->
                                        <div class="mt-6 space-y-3">
                                            <div>
                                                <label for="payment_method" class="block text-sm font-semibold mb-2">Metode Pembayaran</label>
                                                <select id="payment_method" name="payment_method" required class="w-full px-3 py-2 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-white">
                                                    <option value="">-- Pilih Metode --</option>
                                                    <option value="Transfer">💳 Transfer Bank</option>
                                                    <option value="COD">🚚 COD (Bayar di Tempat)</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label for="shipping_method" class="block text-sm font-semibold mb-2">Kurir Pengiriman</label>
                                                <select id="shipping_method" name="shipping_method" required class="w-full px-3 py-2 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-white">
                                                    <option value="">-- Pilih Kurir --</option>
                                                    <option value="JNE">🚚 JNE (1-2 hari)</option>
                                                    <option value="J&T">📦 J&T (1-2 hari)</option>
                                                    <option value="Grab Express">🏍️ Grab Express (Hari Sama)</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label for="address" class="block text-sm font-semibold mb-2">Alamat Pengiriman</label>
                                                <textarea id="address" name="address" rows="3" placeholder="Jl. Contoh No. 123" required class="w-full px-3 py-2 rounded-lg text-gray-900 text-sm resize-none focus:ring-2 focus:ring-white"></textarea>
                                            </div>
                                        </div>

                                        <!-- Hidden fields for cart -->
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <button type="submit" class="w-full mt-6 bg-white hover:bg-gray-100 text-[#8b4513] font-bold py-3 px-6 rounded-lg transition transform hover:scale-105 shadow-lg flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Lanjut Bayar
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-white/10 border border-white/30 rounded-lg p-4 text-center">
                                        <p class="mb-4">Silakan login untuk melanjutkan pembelian</p>
                                        <a href="{{ route('login') }}" class="inline-block w-full bg-white hover:bg-gray-100 text-[#8b4513] font-bold py-2 px-4 rounded-lg transition">
                                            Login
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const productPrice = {{ $product->price }};
        const qtyInput = document.getElementById('qty');
        const totalPriceSpan = document.getElementById('total-price');

        function updateTotal() {
            const qty = parseInt(qtyInput.value) || 1;
            const total = productPrice * qty;
            totalPriceSpan.textContent = new Intl.NumberFormat('id-ID').format(total);
        }

        function increaseQty() {
            const max = parseInt(qtyInput.max);
            const current = parseInt(qtyInput.value);
            if (current < max) {
                qtyInput.value = current + 1;
                updateTotal();
            }
        }

        function decreaseQty() {
            const current = parseInt(qtyInput.value);
            if (current > 1) {
                qtyInput.value = current - 1;
                updateTotal();
            }
        }

        qtyInput.addEventListener('change', updateTotal);
    </script>
</x-app-layout>
