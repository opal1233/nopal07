<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-200">
                    <div class="grid gap-6 lg:grid-cols-[280px_1fr]">
                        <div class="space-y-4">
                            <div class="rounded-xl border border-gray-600 p-5 bg-gray-700">
                                <h3 class="text-lg font-semibold mb-3 text-gray-200">Kategori</h3>
                                <ul class="space-y-2 text-sm text-gray-300">
                                    @forelse($categories as $category)
                                        <li class="px-3 py-2 rounded-md bg-gray-600 border border-gray-500">
                                            <span class="font-medium text-gray-200">{{ $category->name }}</span>
                                            <span class="text-xs text-gray-400">({{ $category->products_count }} produk)</span>
                                        </li>
                                    @empty
                                        <li class="text-gray-400">Tidak ada kategori tersedia.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="rounded-xl border border-gray-600 p-5 bg-gray-700">
                                <h3 class="text-lg font-semibold mb-3 text-gray-200">Aksi Cepat</h3>
                                <div class="space-y-2">
                                    <a href="{{ route('products.index') }}" class="block w-full text-center px-4 py-3 rounded-lg bg-[#8b4513] text-white hover:bg-[#a0550f] transition button-press">Telusuri Produk</a>
                                    <a href="{{ route('cart.index') }}" class="block w-full text-center px-4 py-3 rounded-lg border border-gray-500 hover:bg-gray-600 transition text-gray-200 button-press">Lihat Keranjang</a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-200">Produk Terbaru</h3>
                                    <p class="text-sm text-gray-400">Temukan produk lokal terbaik untuk kebutuhan Anda.</p>
                                </div>
                            </div>

                            <div class="grid gap-6 sm:grid-cols-2">
                                @forelse($products as $product)
                                    <article class="rounded-3xl border border-gray-600 bg-gray-700 p-5 shadow-sm">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-200">{{ $product->name }}</h4>
                                                <p class="mt-2 text-sm text-gray-500">{{ Str::limit($product->description, 120) }}</p>
                                            </div>
                                            <span class="text-sm font-semibold text-[#f53003]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="mt-4 flex items-center justify-between gap-3">
                                            <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                                            <a href="{{ route('products.show', $product) }}" class="text-sm text-[#f53003] hover:underline">Lihat detail</a>
                                        </div>
                                    </article>
                                @empty
                                    <div class="p-6 rounded-3xl border border-dashed border-gray-300 text-center text-sm text-gray-500">
                                        Belum ada produk tersedia.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
