    <div
        class="rounded-xl p-8 bg-white shadow-lg flex items-center flex-col max-w-md lg:h-auto ">
        <h1 class="text-4xl text-blue-700 ">
            {{ $title }}
        </h1>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
