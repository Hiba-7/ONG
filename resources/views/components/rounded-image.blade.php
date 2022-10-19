@props(['src' => ''])

<img {{ $attributes->merge(['class' => 'border-8 border-black-600 list-none w-[200px] aspect-[auto 200 / 200] h-[200px] box-border border-none inline-block overflow-hidden leading-none align-middle flex-shrink-0 rounded-full']) }}
    src="{{ $src }}" id="upload_pic" alt="" style="margin: 0 auto;">
