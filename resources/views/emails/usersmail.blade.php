<x-mail::message>
    # Introduction

    We look forward to communicating more with you. For more information visit our website.

    <x-mail::button :url="'http://localhost:8000/'">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
