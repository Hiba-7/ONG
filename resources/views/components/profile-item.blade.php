@props(['label' => '', 'content' => '', 'value' => '', 'input' => false, 'name' => '', 'disabled' => false, 'type' => 'text'])
<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="flex items-center text-sm font-medium text-gray-500">{{ $label }}</dt>
    @if ($input)
        <div class="col-span-2">
            <input type="{{ $type }}" {{ $disabled == true ? 'disabled' : '' }} name="{{ $name }}"
                value="{{ old($name) ? old($name) : $value }}"
                class='rounded-md shadow-sm w-full border-gray-300 @error($name) border-red-300 @enderror focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 object-fit h-10 text-sm text-gray-900 sm:mt-0 sm:col-span-2'
                placeholder="{{ $content }}" />
            @error($name)
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    @else
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> {{ $content }}</dd>
    @endif

</div>
