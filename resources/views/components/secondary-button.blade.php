<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-[#e8d3d4] rounded-md font-semibold text-xs text-[#581f2d] uppercase tracking-widest shadow-sm hover:bg-[#f8edea] focus:outline-none focus:ring-2 focus:ring-[#8b1f3f] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 button-press']) }}>
    {{ $slot }}
</button>
