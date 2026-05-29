<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-[#241b1f] antialiased bg-[#f3ede8]">
        <div class="min-h-screen flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-6xl grid gap-10 lg:grid-cols-[1.05fr_0.95fr] items-center">
                <div class="rounded-[2.5rem] bg-[#34181f] p-10 text-white shadow-[0_40px_80px_-40px_rgba(0,0,0,0.45)]">
                    <div class="max-w-xl">
                        <a href="/" class="inline-flex items-center gap-3 mb-8 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.35em] text-white/80">
                            <x-application-logo class="w-8 h-8 fill-current text-white" />
                            UMKM Sports Shop
                        </a>
                        <h1 class="text-4xl font-black tracking-tight">Toko Sepatu Olahraga Profesional</h1>
                        <p class="mt-6 text-base leading-8 text-white/80">Temukan koleksi sepatu futsal, sepakbola, running, dan sneakers dengan tampilan modern dan performa terbaik.</p>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#221216] shadow-lg shadow-black/10 hover:bg-[#faf5f2] transition">Masuk Sekarang</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white hover:bg-white/15 transition">Daftar Akun</a>
                        </div>

                        @isset($categories)
                            <div class="mt-10 rounded-[2rem] border border-white/10 bg-white/10 p-6 shadow-[inset_0_0_0_1px_rgba(255,255,255,0.08)]">
                                <p class="text-xs uppercase tracking-[0.35em] text-white/60">Kategori Populer</p>
                                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                    @foreach($categories as $category)
                                        <div class="rounded-3xl border border-white/10 bg-white/10 p-4">
                                            <p class="text-sm font-semibold text-white">{{ $category->name }}</p>
                                            <p class="mt-1 text-xs text-white/70">{{ $category->products_count }} produk</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>

                <div class="rounded-[2.5rem] bg-white p-8 shadow-[0_40px_80px_-30px_rgba(0,0,0,0.1)]">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
