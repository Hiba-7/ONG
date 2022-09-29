<div class="bg-white flex flex-col w-full justify-start pb-12 rounded-xl gap-4 shadow-xl col-span-2">

    <div class="h-2/6 w-full rounded-t-xl bg-blue-700 p-3 flex items-center">
        <x-application-logo class="mx-4 w-32 h-20 fill-current " />
    </div>

    <h1 class="text-blue-700 pt-11 text-3xl 2xl:text-4xl p-6">{{ __('Créer un nouveau compte') }}</h1>

    <x-register-steps-container :states="$states" />

</div>

{{-- !add stickines to the this sidebar --}}
