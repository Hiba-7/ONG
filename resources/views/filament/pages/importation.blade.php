<x-filament::page>
    {{ App::setLocale('fr') }}
    <form novalidate id="form_importation" wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="pt-6 pb-3 flex justify-end">
            <x-tw.button type="submit">
                Import
            </x-tw.button>
        </div>
    </form>
</x-filament::page>
