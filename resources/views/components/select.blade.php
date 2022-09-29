@props(['identity'])

<select
    {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) }}
    name="{{ $identity }}" id="{{ $identity }}">
    {{ $slot }}
</select>
