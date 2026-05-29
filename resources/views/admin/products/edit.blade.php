<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Produk') }}</h2>
            <a href="{{ route('admin.dashboard') }}" class="rounded-xl border border-gray-200 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition button-press">Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input name="name" type="text" value="{{ old('name', $product->name) }}" required class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-[#f53003] focus:ring-[#f53003]" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4" required class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-[#f53003] focus:ring-[#f53003]">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga</label>
                            <input name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price) }}" required class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-[#f53003] focus:ring-[#f53003]" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stok</label>
                            <input name="stock" type="number" min="0" value="{{ old('stock', $product->stock) }}" required class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-[#f53003] focus:ring-[#f53003]" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" required class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-[#f53003] focus:ring-[#f53003]">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                        <input id="image-input-edit" name="image" type="file" accept="image/*" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-[#f53003] focus:ring-[#f53003]" />
                        @if($product->image)
                            <div class="mt-3 flex items-center gap-4">
                                <img id="image-preview-edit" src="{{ $product->image }}" alt="Preview" class="h-28 w-28 rounded-lg object-cover border" />
                                <p class="text-xs text-gray-500">Gambar saat ini. Pilih file baru untuk menggantinya.</p>
                            </div>
                        @else
                            <img id="image-preview-edit" src="" alt="Preview" class="mt-3 hidden h-28 w-28 rounded-lg object-cover border" />
                        @endif
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <button type="submit" class="rounded-xl bg-[#f53003] px-6 py-3 text-sm font-semibold text-white hover:bg-[#d02702] transition button-press">Perbarui Produk</button>
                        <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('image-input-edit');
        const preview = document.getElementById('image-preview-edit');
        if (!input) return;
        input.addEventListener('change', function (e) {
            const file = e.target.files && e.target.files[0];
            if (!file) {
                if (preview) preview.classList.add('hidden');
                return;
            }
            const url = URL.createObjectURL(file);
            if (preview) {
                preview.src = url;
                preview.classList.remove('hidden');
            }
        });
    });
</script>
