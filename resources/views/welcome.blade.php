<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'UMKM Sports Shop') }}</title>

        @fonts

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#f4ede6] text-[#22161b] antialiased">
        <main class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.95),_rgba(244,237,230,0.95))]">
            <div class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-14">
                <div class="grid gap-10 lg:grid-cols-[1.15fr_0.85fr] items-center">
                    <section class="rounded-[3rem] bg-[#22161b] p-10 text-white shadow-[0_40px_90px_-40px_rgba(34,22,27,0.45)]">
                        <div class="inline-flex items-center gap-3 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.35em] text-white/80">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-white">S</span>
                            Sports Shoes Store
                        </div>

                        <h1 class="mt-8 text-5xl font-black tracking-tight sm:text-6xl">Sepatu Olahraga untuk Setiap Lapangan</h1>
                        <p class="mt-6 max-w-2xl text-base leading-8 text-white/75">Pilih sepatu futsal, sepakbola, running, dan sneakers premium dengan tampilan stylish, dukungan performa, serta kenyamanan sepanjang hari.</p>

                        <div class="mt-10 grid gap-4 sm:grid-cols-2">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-[#f7f0ee] px-6 py-4 text-sm font-semibold text-[#22161b] shadow-lg shadow-black/10 transition hover:bg-white">Masuk Sekarang</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-6 py-4 text-sm font-semibold text-white transition hover:bg-white/15">Daftar Akun</a>
                        </div>

                        <div class="mt-12 grid gap-4 sm:grid-cols-2">
                            @foreach($categories as $category)
                                <div class="rounded-[1.75rem] border border-white/10 bg-white/10 p-5 backdrop-blur-sm">
                                    <p class="text-sm uppercase tracking-[0.3em] text-white/60">{{ $category->name }}</p>
                                    <p class="mt-3 text-lg font-semibold text-white">{{ $category->products_count }} produk</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="grid gap-6">
                        <div class="rounded-[2rem] overflow-hidden shadow-[0_25px_45px_-20px_rgba(0,0,0,0.35)]">
                            <img src="{{ asset('assets/img/ney.jpg') }}" alt="Sepatu Olahraga" class="h-64 w-full object-cover" />
                            <div class="bg-white p-6">
                                <p class="text-sm uppercase tracking-[0.35em] text-[#7f5f63]">Influencer Pick</p>
                                <h2 class="mt-3 text-2xl font-semibold text-[#22161b]">{{ optional($products->first())->name ?? 'Sepatu Unggulan' }}</h2>
                                <p class="mt-3 text-sm leading-6 text-[#5c4f4f]">{{ Str::limit(optional($products->first())->description ?? 'Koleksi sepatu terpilih untuk aktivitas olahraga dan gaya sehari-hari.', 110) }}</p>
                            </div>
                        </div>
                        <div class="grid gap-6 sm:grid-cols-2">
                            @foreach($products->skip(1)->take(2) as $product)
                                <article class="rounded-[2rem] overflow-hidden bg-white shadow-sm">
                                    <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-44 w-full object-cover" />
                                    <div class="p-5">
                                        <p class="text-xs uppercase tracking-[0.35em] text-[#9f7a7f]">{{ $product->category->name }}</p>
                                        <h3 class="mt-3 text-lg font-semibold text-[#22161b]">{{ $product->name }}</h3>
                                        <p class="mt-2 text-sm text-[#6a5559]">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                </div>

                <section class="mt-16 rounded-[2.5rem] bg-white p-8 shadow-[0_40px_90px_-40px_rgba(0,0,0,0.08)]">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <span class="inline-flex rounded-full bg-[#fde8e4] px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-[#b14540]">Koleksi Terbaru</span>
                            <h2 class="mt-4 text-3xl font-black text-[#22161b]">Produk Sepatu Sport Pilihan</h2>
                            <p class="mt-3 max-w-2xl text-sm leading-7 text-[#6f5d5f]">Jelajahi koleksi sepatu futsal, sepakbola, lari, dan sneakers dengan desain modern dan kualitas terbaik.</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-full bg-[#22161b] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-black/10 hover:bg-[#1a1317] transition">Lihat Semua Produk</a>
                    </div>

                    <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                        @foreach($products as $product)
                            <article class="group overflow-hidden rounded-[2rem] border border-[#ece1df] bg-[#faf4f2] shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                                <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105" />
                                <div class="p-5">
                                    <p class="text-xs uppercase tracking-[0.35em] text-[#9f7a7f]">{{ $product->category->name }}</p>
                                    <h3 class="mt-3 text-lg font-semibold text-[#22161b]">{{ $product->name }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-[#6f5d5f]">{{ Str::limit($product->description, 80) }}</p>
                                    <p class="mt-4 text-xs uppercase tracking-[0.25em] text-[#8b1f3f] font-semibold">Ukuran: 39 - 44</p>
                                    <div class="mt-5 flex items-center justify-between gap-2">
                                        <span class="text-lg font-bold text-[#8b1f3f]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <div class="flex gap-2">
                                            <a href="{{ route('products.buy-now', $product) }}" class="inline-flex items-center justify-center rounded-full bg-[#8b1f3f] px-3 py-2 text-sm font-semibold text-white transition hover:bg-[#a0251f] shadow-md" title="Beli Sekarang">
                                                🛍️ Beli
                                            </a>
                                            <a href="{{ route('products.show', $product) }}" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 shadow-md" title="Tambah ke Keranjang">
                                                🛒
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="mt-16 grid gap-8 lg:grid-cols-2">
                    <div class="rounded-[2rem] bg-[#22161b] p-10 text-white shadow-[0_40px_90px_-40px_rgba(34,22,27,0.45)]">
                        <p class="text-sm uppercase tracking-[0.35em] text-[#f8d7da]">Tentang Kami</p>
                        <h2 class="mt-6 text-3xl font-bold">UMKM Sports Shop</h2>
                        <p class="mt-5 text-base leading-8 text-white/80">Kami adalah toko sepatu olahraga lokal yang menghadirkan produk berkualitas untuk futsal, sepakbola, lari, dan gaya harian. Misi kami adalah memberikan kenyamanan, performa terbaik, dan desain yang trendi bagi setiap atlet dan penggemar olahraga.</p>
                        <p class="mt-5 text-sm text-[#d1b1ae]">Dukungan pelanggan kami siap membantu Anda menemukan sepatu yang cocok untuk setiap lapangan dan aktivitas. Belanja dengan percaya diri dan dapatkan pengalaman belanja yang ramah dan mudah.</p>
                    </div>

                    <div class="rounded-[2rem] bg-white p-10 shadow-[0_40px_90px_-40px_rgba(0,0,0,0.08)]">
                        <p class="text-sm uppercase tracking-[0.35em] text-[#9f7a7f]">Kontak Kami</p>
                        <h2 class="mt-6 text-3xl font-bold text-[#22161b]">Hubungi untuk Pesanan</h2>
                        <p class="mt-5 text-base leading-8 text-[#5c4f4f]">Jika Anda membutuhkan bantuan, ingin cek ketersediaan produk, atau ingin melakukan pemesanan langsung, silakan hubungi kami melalui nomor berikut.</p>
                        <div class="mt-8 rounded-[1.75rem] bg-[#f4ede6] p-6">
                            <p class="text-sm text-[#7f5f63]">WhatsApp / Telepon</p>
                            <p class="mt-3 text-2xl font-semibold text-[#22161b]">0857 1930 1469</p>
                            <p class="mt-3 text-sm text-[#6f5d5f]">Kami siap melayani setiap hari kerja dengan cepat dan responsif.</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>
