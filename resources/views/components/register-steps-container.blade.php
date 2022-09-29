@props(['states' => []])
@php
$state1 = array_key_exists('state1', $states) ? $states['state1'] : 'current';
$state2 = array_key_exists('state2', $states) ? $states['state2'] : 'upcoming';
$state3 = array_key_exists('state3', $states) ? $states['state3'] : 'upcoming';
$state4 = array_key_exists('state4', $states) ? $states['state4'] : 'upcoming';
@endphp
<nav class="mx-4" aria-label="Progress">
    <ol role="list" class="overflow-hidden">
        <li class="relative pb-6">
            <x-register-step href="{{ route('register.step.one') }}" :state="__($state1)" :step_name="__('INFORMATIONS PROFILE')" :step_description="__('veuillez entrer les informations de votre profile.')" />
        </li>

        <li class="relative pb-6">
            <x-register-step href="{{ route('register.step.two') }}" :state="__($state2)" :step_name="__('INFORMATIONS PERSONNELLE')" :step_description="__('veuillez entrer vos informations personnelles.')" />
        </li>

        <li class="relative pb-6">
            <x-register-step href="{{ route('register.step.three') }}" :state="__($state3)" :step_name="__('CV')" :step_description="__('veuillez entrer les informations de votre CV.')" />
        </li>

        <li class="relative">
            <x-register-step href="{{ route('register.step.four') }}" :state="__($state4)" :step_name="__('CARTE NATIONALE')" :step_description="__('veuillez entrer les informations de votre carte nationale.')"
                :last="true" />
        </li>
    </ol>
</nav>
