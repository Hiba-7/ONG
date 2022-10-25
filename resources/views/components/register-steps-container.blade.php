@props(['states' => []])
@php
    $state1 = array_key_exists('state1', $states) ? $states['state1'] : 'current';
    $state2 = array_key_exists('state2', $states) ? $states['state2'] : 'upcoming';
    $state3 = array_key_exists('state3', $states) ? $states['state3'] : 'upcoming';
@endphp
<nav class="mx-4" aria-label="Progress">
    <ol role="list" class="overflow-hidden">
        <li class="relative pb-6">
            <x-register-step
                href="{{ $state1 == 'current' || $state1 == 'completed' ? route('register.step.one') : '' }}"
                :state="__($state1)" :step_name="__('INFORMATIONS PROFILE')" :step_description="__('veuillez entrer les informations de votre profile.')" />
        </li>

        <li class="relative pb-6">
            <x-register-step
                href="{{ $state2 == 'current' || $state2 == 'completed' ? route('register.step.two') : '' }}"
                :state="__($state2)" :step_name="__('INFORMATIONS PERSONNELLE')" :step_description="__('veuillez entrer vos informations personnelles.')" />
        </li>

        <li class="relative">
            <x-register-step
                href="{{ $state3 == 'current' || $state3 == 'completed' ? route('register.step.three') : '' }}"
                :state="__($state3)" :step_name="__('CARTES PERSONNELLE')" :step_description="__('veuillez entrer les informations de votre carte nationale et carte vote.')" :last="true" />
        </li>
    </ol>
</nav>
