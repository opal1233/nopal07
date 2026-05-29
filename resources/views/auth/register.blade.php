<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-black tracking-tight text-[#22161b]">Daftar Akun Baru</h1>
        <p class="mt-2 text-sm text-[#5c4f4f]">Bergabunglah dengan Sports Shoes Store untuk belanja sepatu olahraga premium.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" class="text-[#581f2d]" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" class="text-[#581f2d]" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" class="text-[#581f2d]" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]" type="text" name="phone" :value="old('phone')" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" class="text-[#581f2d]" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" class="text-[#581f2d]" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" class="text-[#581f2d]" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl border border-[#e5d1d4] bg-[#f8efee] px-4 py-3 text-sm text-[#321818] focus:border-[#581f2d] focus:ring-[#581f2d]"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-[#7c4d5a]" />
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="underline text-sm text-[#5d3340] hover:text-[#8b1f3f] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8b1f3f]" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
