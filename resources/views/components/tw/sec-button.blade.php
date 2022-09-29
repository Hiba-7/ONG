@props(['size' => 'md'])

@switch($size)
    @case('sm')
        <button
            {{ $attributes->merge(['type' => '', 'class' => 'inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) }}>
            {{ $slot }}
        </button>
    @break

    @case('md')
        <button
            {{ $attributes->merge(['type' => '', 'class' => 'inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) }}>
            {{ $slot }}
        </button>
    @break

    @case('lg')
        <button
            {{ $attributes->merge(['type' => '', 'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) }}>
            {{ $slot }}
        </button>
    @break

    @case('xl')
        <button
            {{ $attributes->merge(['type' => '', 'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) }}>
            {{ $slot }}
        </button>
    @break

    @case('2xl')
        <button
            {{ $attributes->merge(['type' => '', 'class' => 'inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) }}>
            {{ $slot }}
        </button>
    @break
@endswitch
