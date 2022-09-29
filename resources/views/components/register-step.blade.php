@props(['state' => 'upcoming', 'step_name' => '', 'step_description' => '', 'last' => false])

@php
$vertical_line_class = $state == 'completed' ? '-ml-px absolute mt-0.5 top-3 left-3 w-0.5 h-full bg-blue-600' : '-ml-px absolute mt-0.5 top-3 left-3 w-0.5 h-full bg-gray-300';
$inner_circle_class = $state == 'completed' ? 'relative z-10 w-6 h-6 flex items-center justify-center bg-blue-600 rounded-full group-hover:bg-blue-800' : ($state == 'current' ? 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-blue-600 rounded-full' : 'relative z-10 w-6 h-6 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400');
$step_name_class = $state == 'upcoming' ? 'text-xs 2xl:text-s font-bold tracking-wide uppercase text-gray-500' : ($state == 'current' ? 'text-xs 2xl:text-s font-semibold tracking-wide uppercase text-blue-600' : 'text-xs 2xl:text-s font-semibold tracking-wide uppercase');
@endphp

@if (!$last)
    <div class="{{ $vertical_line_class }}" aria-hidden="true"></div>
@endif

<a {{ $attributes->merge(['href' => '#']) }} class='relative flex items-start group'>
    <span class="h-9 flex items-center" {{ in_array($state, ['upcoming', 'current']) ? 'aria-hidden="true"' : '' }}>

        <span class="{{ $inner_circle_class }}">

            @switch($state)
                @case('completed')
                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                @break

                @case('current')
                    <span class="h-2.5 w-2.5 bg-blue-600 rounded-full"></span>
                @break

                @default
                    <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
            @endswitch

        </span>
    </span>

    <span class="ml-4 min-w-0 flex flex-col">
        <span {{ $attributes->merge(['class' => $step_name_class]) }}>{{ $step_name }}</span>
        <span class="text-xs 2xl:text-s text-gray-500">{{ $step_description }}</span>
    </span>
</a>
