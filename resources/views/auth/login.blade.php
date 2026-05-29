<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-black tracking-tight text-[#22161b]">Masuk ke Sports Shoes Store</h1>
        <p class="mt-2 text-sm text-[#5c4f4f]">Akses katalog sepatu futsal, sepakbola, running, dan sneakers dengan harga terbaik.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email or Username -->
        <div>
            <x-input-label for="login" class="text-[#581f2d]" :value="__('Email atau Username')" />
            <x-text-input id="login" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('login')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" class="text-[#581f2d]" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-3">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-[#5d3340]">
                <input id="remember_me" type="checkbox" class="rounded border-[#d8c2c6] text-[#8b1f3f] shadow-sm focus:ring-[#8b1f3f]" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#5d3340] hover:text-[#8b1f3f] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8b1f3f]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
