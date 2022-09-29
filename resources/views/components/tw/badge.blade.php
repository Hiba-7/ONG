@props(['content' => 'Badge', 'color' => 'green'])
<span
    class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-{{ $color }}-100 text-{{ $color }}-800">
    {{ $content }}
</span>
