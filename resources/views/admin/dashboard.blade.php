<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="font-black text-3xl text-[#321818] leading-tight">Admin Dashboard</h2>
                <p class="mt-2 text-sm text-[#6e4b54]">Pantau inventaris, transaksi, dan pelanggan toko sepatu olahraga.</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-[#8b1f3f] px-4 py-2 text-sm font-semibold text-white shadow-sm">Admin</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <section class="rounded-[2.5rem] bg-white p-8 shadow-[0_40px_100px_-40px_rgba(0,0,0,0.12)] border border-[#efe1df]">
                <div class="grid gap-6 lg:grid-cols-3">
                    <article class="rounded-[2rem] bg-[#8b1f3f] p-6 text-white shadow-lg">
                        <p class="text-sm uppercase tracking-[0.35em] text-[#f4d3d9]">Produk</p>
                        <p class="mt-5 text-4xl font-black">{{ $products->count() }}</p>
                        <p class="mt-3 text-sm text-[#f5c9d0]">Katalog sepatu futsal, sepakbola, running, dan sneakers.</p>
                    </article>
                    <article class="rounded-[2rem] border border-[#f3e2e1] bg-white p-6 shadow-sm">
                        <p class="text-sm uppercase tracking-[0.35em] text-[#5c2b3d]">Transaksi</p>
                        <p class="mt-5 text-4xl font-black text-[#321818]">{{ $transactions->count() }}</p>
                        <p class="mt-3 text-sm text-[#7c5a62]">Pesanan terbaru dan pendapatan toko.</p>
                    </article>
                    <article class="rounded-[2rem] border border-[#f3e2e1] bg-white p-6 shadow-sm">
                        <p class="text-sm uppercase tracking-[0.35em] text-[#5c2b3d]">Pelanggan</p>
                        <p class="mt-5 text-4xl font-black text-[#321818]">{{ $customers->count() }}</p>
                        <p class="mt-3 text-sm text-[#7c5a62]">Jumlah pelanggan aktif di toko Anda.</p>
                    </article>
                </div>
            </section>

            <section class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
                <div class="rounded-[2rem] bg-white p-6 shadow-sm border border-[#efe1df]">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-[#321818]">Tambah Produk Baru</h3>
                            <p class="mt-2 text-sm text-[#7c5a62]">Masukkan koleksi sepatu dengan gambar produk agar halaman depan lebih menarik.</p>
                        </div>
                        <span class="rounded-full bg-[#f9eceb] px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-[#8b1f3f]">Fast Add</span>
                    </div>

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-[#5c2b3d]">Nama Produk</label>
                                <input name="name" type="text" required class="mt-2 block w-full rounded-[1.5rem] border border-[#e7d6d4] bg-[#faf4f3] px-4 py-3 text-sm text-[#321818] focus:border-[#8b1f3f] focus:ring-[#8b1f3f] focus:ring-1" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[#5c2b3d]">Stok</label>
                                <input name="stock" type="number" min="0" required class="mt-2 block w-full rounded-[1.5rem] border border-[#e7d6d4] bg-[#faf4f3] px-4 py-3 text-sm text-[#321818] focus:border-[#8b1f3f] focus:ring-[#8b1f3f] focus:ring-1" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#5c2b3d]">Deskripsi</label>
                            <textarea name="description" rows="4" required class="mt-2 block w-full rounded-[1.5rem] border border-[#e7d6d4] bg-[#faf4f3] px-4 py-3 text-sm text-[#321818] focus:border-[#8b1f3f] focus:ring-[#8b1f3f] focus:ring-1"></textarea>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-[#5c2b3d]">Harga</label>
                                <input name="price" type="number" min="0" step="0.01" required class="mt-2 block w-full rounded-[1.5rem] border border-[#e7d6d4] bg-[#faf4f3] px-4 py-3 text-sm text-[#321818] focus:border-[#8b1f3f] focus:ring-[#8b1f3f] focus:ring-1" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[#5c2b3d]">Kategori</label>
                                <select name="category_id" required class="mt-2 block w-full rounded-[1.5rem] border border-[#e7d6d4] bg-[#faf4f3] px-4 py-3 text-sm text-[#321818] focus:border-[#8b1f3f] focus:ring-[#8b1f3f] focus:ring-1">
                                    <option value="">Pilih kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#5c2b3d]">Gambar Produk</label>
                            <input id="image-input-add" name="image" type="file" accept="image/*" class="mt-2 block w-full rounded-[1.5rem] border border-[#e7d6d4] bg-[#faf4f3] px-4 py-3 text-sm text-[#321818] focus:border-[#8b1f3f] focus:ring-[#8b1f3f] focus:ring-1" />
                            <img id="image-preview-add" src="" alt="Preview" class="mt-3 hidden h-36 w-36 rounded-lg object-cover border" />
                        </div>

                        <button type="submit" class="w-full rounded-[1.5rem] bg-[#8b1f3f] px-4 py-3 text-sm font-semibold text-white hover:bg-[#a73d57] transition button-press">Simpan Produk</button>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const input = document.getElementById('image-input-add');
                            const preview = document.getElementById('image-preview-add');
                            if (!input) return;
                            input.addEventListener('change', function (e) {
                                const file = e.target.files && e.target.files[0];
                                if (!file) {
                                    preview.src = '';
                                    preview.classList.add('hidden');
                                    return;
                                }
                                preview.src = URL.createObjectURL(file);
                                preview.classList.remove('hidden');
                            });
                        });
                    </script>
                </div>

                <div class="rounded-[2rem] bg-white p-6 shadow-sm border border-[#efe1ef]">
                    <h3 class="text-lg font-semibold text-[#321818]">Transaksi Terbaru</h3>
                    <div class="mt-5 space-y-3">
                        @forelse($transactions->take(5) as $transaction)
                            <div class="rounded-[1.75rem] border border-[#f0d7d6] bg-[#fff6f5] p-4">
                                <div class="flex items-center justify-between gap-3 text-sm text-[#5c2b3d]">
                                    <div>
                                        <p class="font-semibold text-[#321818]">#{{ $transaction->id }}</p>
                                        <p>{{ $transaction->user->name }}</p>
                                    </div>
                                    <span class="text-xs font-semibold uppercase text-[#8b1f3f]">{{ ucfirst($transaction->status) }}</span>
                                </div>
                                <div class="mt-3 flex items-center justify-between text-sm text-[#7c5a62]">
                                    <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="text-[#8b1f3f] hover:underline">Detail</a>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-[1.75rem] border border-dashed border-[#dfc3c1] p-6 text-center text-sm text-[#7c5a62]">Belum ada transaksi.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] bg-white p-8 shadow-sm border border-[#efe1ef]">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-[#321818]">Daftar Produk</h3>
                        <p class="mt-1 text-sm text-[#7c5a62]">Edit dan kelola produk sepatu Anda langsung dari dashboard.</p>
                    </div>
                    <span class="rounded-full bg-[#f3e1e0] px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-[#8b1f3f]">{{ $products->count() }} item</span>
                </div>

                <div class="mt-6 grid gap-4 xl:grid-cols-2">
                    @foreach($products as $product)
                        <article class="group overflow-hidden rounded-[1.75rem] border border-[#eee3e0] bg-[#fff8f7] shadow-sm transition hover:shadow-md">
                            <div class="grid grid-cols-[150px_1fr] gap-4 p-4">
                                <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $product->name }}" class="h-36 w-full rounded-[1.5rem] object-cover" />
                                <div class="flex flex-col justify-between gap-4">
                                    <div>
                                        <p class="text-sm uppercase tracking-[0.35em] text-[#8b1f3f]">{{ $product->category->name }}</p>
                                        <h4 class="mt-2 text-xl font-semibold text-[#321818]">{{ $product->name }}</h4>
                                        <p class="mt-2 text-sm text-[#6f5d5f]">{{ Str::limit($product->description, 90) }}</p>
                                    </div>
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-sm font-semibold text-[#321818]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="rounded-full bg-[#8b1f3f] px-3 py-2 text-xs font-semibold text-white hover:bg-[#a73d57] transition">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full bg-[#e33e4d] px-3 py-2 text-xs font-semibold text-white hover:bg-[#c12a36] transition">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-[#6f5d5f]">Ukuran tersedia: 39 - 44</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="rounded-[2rem] bg-white p-8 shadow-sm border border-[#efe1ef]">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-[#321818]">Daftar Pelanggan</h3>
                        <p class="mt-1 text-sm text-[#7c5a62]">Kelola akun pelanggan dan reset kata sandi dengan mudah.</p>
                    </div>
                    <span class="rounded-full bg-[#f3e1e0] px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-[#8b1f3f]">{{ $customers->count() }} pelanggan</span>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#efe3e1] text-sm text-[#5c3a44]">
                        <thead class="bg-[#fff6f5] text-left text-xs uppercase tracking-[0.3em] text-[#8b1f3f]">
                            <tr>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Telepon</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#efe3e1]">
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="px-4 py-4">{{ $customer->name }}</td>
                                    <td class="px-4 py-4 text-[#5c2b3d]">{{ $customer->email }}</td>
                                    <td class="px-4 py-4">{{ $customer->phone ?? '-' }}</td>
                                    <td class="px-4 py-4">
                                        <form action="{{ route('admin.customers.reset-password', $customer) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="rounded-full bg-[#f2c34d] px-4 py-2 text-xs font-semibold text-[#5a2e20] hover:bg-[#e0b135] transition">Reset Password</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
