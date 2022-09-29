<div class="px-10  pt-10">

    <h1 class="text-4xl text-blue-700">Les Instances qui sont visibles!</h1>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-8 p-3  bg-white shadow overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
            @foreach ($instances as $instance)
                <li>
                    <livewire:components.instance-card :instance="$instance" />
                </li>
            @endforeach
        </ul>
        <div class="mt-2">
            {{ $instances->links() }}
        </div>
    </div>


</div>
