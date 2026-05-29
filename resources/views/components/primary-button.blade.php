<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#8b1f3f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#ad3d5e] focus:bg-[#ad3d5e] active:bg-[#7a1c34] focus:outline-none focus:ring-2 focus:ring-[#ad3d5e] focus:ring-offset-2 transition ease-in-out duration-150 button-press']) }}>
    {{ $slot }}
</button>
