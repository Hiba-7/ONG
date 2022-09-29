@props(['size' => 'md'])

@switch($size)
    @case('sm')
        <button {{ $attributes->merge(['type' => 'submit', "class" => "inline-flex items-center justify-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"]) }}>
            {{ $slot }}
        </button>
    @break

    @case('md')
        <button {{ $attributes->merge(['type' => 'submit', "class" => "inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"]) }}>
            {{ $slot }}
        </button>
    @break

    @case('lg')
        <button {{ $attributes->merge(['type' => 'submit', "class" => "inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"]) }}>
            {{ $slot }}
        </button>
    @break

    @case('xl')
        <button {{ $attributes->merge(['type' => 'submit', "class" => "inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"]) }}>
            {{ $slot }}
        </button>
    @break

    @case('2xl')
        <button {{ $attributes->merge(['type' => 'submit', "class" => "inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"]) }}>
            {{ $slot }}
        </button>
    @break        
@endswitch
