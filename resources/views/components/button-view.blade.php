<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-primary inline-flex items-center justify-center px-2 py-2 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>