<a {{ $attributes->merge(['class' => 'relative inline-block group  focus:outline-none focus:ring']) }}>
    <span
        class="absolute inset-0 transition-transform translate-x-1.5 translate-y-1.5 bg-blue-300 group-hover:translate-y-0 group-hover:bg-blue-700 group-hover:translate-x-0 rounded-sm"></span>
    <span
        class="relative inline-block px-8 py-3 text-sm font-bold tracking-widest text-gray-600 group-hover:text-gray-50  uppercase  border-2 border-current group-active:text-opacity-75 rounded-sm">
        {{ $slot }}
    </span>
</a>
