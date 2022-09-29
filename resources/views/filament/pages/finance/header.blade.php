<header
    class="space-y-2 items-start justify-between sm:flex sm:space-y-0 sm:space-x-4  sm:rtl:space-x-reverse sm:py-4 filament-header">
    <h1 class="text-2xl font-bold tracking-tight capitalize md:text-3xl filament-header-heading">
        {{ __(explode('.', Route::currentRouteName())[2]) }}
    </h1>

    <div class="flex items-center bg-gray-100 dark:bg-gray-600 justify-center border-gray-200 rounded-xl border px-4 py-2 ">

        <h1 class="text-2xl text-gray-400 font-bold tracking-tight">
            {{ now()->year }}
        </h1>
    </div>

</header>
