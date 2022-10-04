<div class="pt-100 bg-white px-10 shadow overflow-hidden sm:rounded-lg w-[87%]">
    <div class="py-5">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Réinisialiser votre mot de passe</h3>
    </div>
    <form novalidate id="form_pass" wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="pt-6 pb-3 grid grid-cols-7">
            <x-tw.button class="col-start-7" type="submit">
                Submit
            </x-tw.button>
        </div>
    </form>
</div>
