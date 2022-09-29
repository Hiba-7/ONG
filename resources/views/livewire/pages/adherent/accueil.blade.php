<section class="bg-gray-50">
    <div class="mx-auto max-w-screen-xl lg:h-screen lg:items-center lg:flex">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Bonjour {{ $user->nom }} {{ $user->prénom }}.
                <strong class="font-extrabold text-blue-700 sm:block">
                    Inscrivez-vous dans une formation.
                </strong>
            </h1>

            <p class="mt-4 sm:leading-relaxed sm:text-xl">
                ou voir les formations disponibles.
            </p>

            <div class="flex flex-wrap justify-center mt-8 gap-4">
                <a class="block w-full px-12 py-3 text-sm font-medium text-white bg-blue-600 rounded shadow sm:w-auto active:bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring"
                    href="{{ route('formation') }}">
                    Formations
                </a>

                <a class="block w-full px-12 py-3 text-sm font-medium text-blue-600 rounded shadow sm:w-auto hover:text-blue-700 active:text-blue-500 focus:outline-none focus:ring"
                    href="{{ route('faq') }}">
                    FAQ
                </a>
            </div>
        </div>
    </div>
</section>
