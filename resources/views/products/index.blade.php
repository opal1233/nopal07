<x-app-layout>
    <main class="min-h-screen bg-white">
        <!-- Featured Collection Section -->
        <section class="px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Featured Collection</h2>
                
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                        @foreach($products->take(5) as $product)
                            <div class="group relative">
                                <a href="{{ route('products.show', $product) }}">
                                    <div class="relative rounded-lg overflow-hidden bg-gray-100 aspect-square mb-3 shadow hover:shadow-md transition">
                                        <div class="h-full w-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            @if($product->image)
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
                                            @else
                                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                                            @endif
                                        </div>
                                        <div class="absolute top-2 left-2">
                                            <span class="inline-block rounded-md bg-red-500 text-white text-xs font-bold px-2 py-1">Sale</span>
                                        </div>
                                    </div>
                                    <h3 class="text-xs font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600">{{ $product->name }}</h3>
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="text-sm font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                    @if(($product->price * 1.2) > $product->price)
                                        <div class="mt-1 flex items-center gap-2 text-xs">
                                            <span class="line-through text-gray-500">Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}</span>
                                            <span class="text-red-500 font-semibold">Save Rp {{ number_format($product->price * 0.2, 0, ',', '.') }}</span>
                                        </div>
                                    @endif
                                </a>
                                <div class="mt-3 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                                    <a href="{{ route('products.buy-now', $product) }}" class="flex-1 inline-flex items-center justify-center rounded-lg bg-[#8b4513] text-white text-xs font-bold py-2 hover:bg-[#a0550f] transition">🛍️ Beli</a>
                                    <a href="{{ route('products.show', $product) }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 text-white px-2 py-2 hover:bg-blue-700 transition" title="Tambah Keranjang">🛒</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- All Products Section -->
        <section class="border-t px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">All Products</h2>
                    <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all</a>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                        @foreach($products as $product)
                            <div class="group relative">
                                <a href="{{ route('products.show', $product) }}">
                                    <div class="relative rounded-lg overflow-hidden bg-gray-100 aspect-square mb-3 shadow hover:shadow-md transition">
                                        <div class="h-full w-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            @if($product->image)
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
                                            @else
                                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                                            @endif
                                        </div>
                                        <div class="absolute top-2 left-2">
                                            <span class="inline-block rounded-md bg-red-500 text-white text-xs font-bold px-2 py-1">Sale</span>
                                        </div>
                                    </div>
                                    <h3 class="text-xs font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600">{{ $product->name }}</h3>
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="text-sm font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                    @if(($product->price * 1.2) > $product->price)
                                        <div class="mt-1 flex items-center gap-2 text-xs">
                                            <span class="line-through text-gray-500">Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}</span>
                                            <span class="text-red-500 font-semibold">Save Rp {{ number_format($product->price * 0.2, 0, ',', '.') }}</span>
                                        </div>
                                    @endif
                                </a>
                                <div class="mt-3 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                                    <a href="{{ route('products.buy-now', $product) }}" class="flex-1 inline-flex items-center justify-center rounded-lg bg-[#8b4513] text-white text-xs font-bold py-2 hover:bg-[#a0550f] transition">🛍️ Beli</a>
                                    <a href="{{ route('products.show', $product) }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 text-white px-2 py-2 hover:bg-blue-700 transition" title="Tambah Keranjang">🛒</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-12 text-center">
                        <p class="text-gray-500">No products found.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>
</x-app-layout>


