@php
$classes = $active ? 'bg-blue-800 group mt-1 text-white w-full p-3 rounded-md flex flex-col items-center text-xs font-semibold' : 'text-blue-100 hover:text-white hover:bg-blue-800 group ease-in duration-200 mt-1 hover:text-white w-full h-full p-3 rounded-md flex flex-col items-center text-xs font-semibold ';
$icon_classes = 'h-4 w-4 2xl:h-6 2xl:w-6 text-white font-light';
@endphp

<div>
    @switch($name)
        @case('accueil')
            <a class="{{ $classes }}" wire:click='loadPage' href="{{ route($name) }}"
                aria-current="{{ $active ? 'page' : '' }}">
                @if ($active)
                    <x-heroicon-s-home class="{{ $icon_classes }}" />
                @else
                    <x-heroicon-o-home class="{{ $icon_classes }}" />
                @endif
                <span class="mt-2 text-xs">Accueil</span>

            </a>
        @break

        @case('formation')
            <a class="{{ $classes }}" wire:click='loadPage' href="{{ route($name) }}"
                aria-current="{{ $active ? 'page' : '' }}">
                @if ($active)
                    <x-heroicon-s-academic-cap class="{{ $icon_classes }}" />
                @else
                    <x-heroicon-o-academic-cap class="{{ $icon_classes }}" />
                @endif
                <span class="mt-2 text-xs">Formation</span>
            </a>
        @break

        @case('instances')
            <a class="{{ $classes }}" wire:click='loadPage' href="{{ route($name) }}"
                aria-current="{{ $active ? 'page' : '' }}">
                @if ($active)
                    <x-heroicon-s-user-group class="{{ $icon_classes }}" />
                @else
                    <x-heroicon-o-user-group class="{{ $icon_classes }}" />
                @endif

                <span class="mt-2 text-xs">Instances</span>
            </a>
        @break

        @case('faq')
            <a class="{{ $classes }}" wire:click='loadPage' href="{{ route($name) }}"
                aria-current="{{ $active ? 'page' : '' }}">
                @if ($active)
                    <x-heroicon-s-exclamation-circle class="{{ $icon_classes }}" />
                @else
                    <x-heroicon-o-exclamation-circle class="{{ $icon_classes }}" />
                @endif

                <span class="mt-2 text-xs">FAQ</span>
            </a>
        @break

        @case('parametres')
            <a class="{{ $classes }}" wire:click='loadPage' href="{{ route($name) }}"
                aria-current="{{ $active ? 'page' : '' }}">
                @if ($active)
                    <x-heroicon-s-cog class="{{ $icon_classes }}" />
                @else
                    <x-heroicon-o-cog class="{{ $icon_classes }}" />
                @endif

                <span class="mt-2 text-xs">Paramétres</span>
            </a>
        @break

    @endswitch
</div>
