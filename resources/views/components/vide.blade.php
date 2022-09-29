<div class="flex items-center justify-center h-full">
    <div
        class="filament-tables-empty-state flex flex-col items-center justify-center p-6 mx-auto space-y-6 text-center bg-white w-3/4 h-3/4 border">
        <div class="flex items-center justify-center w-16 h-16 text-primary-500 rounded-full bg-primary-50">
            <svg wire:loading.remove.delay="1"
                wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage,$set"
                class="text-blue-300 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="animate-spin w-6 h-6"
                wire:loading.delay="wire:loading.delay"
                wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage,$set">
                <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                    fill="currentColor"></path>
                <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor">
                </path>
            </svg>
        </div>

        <div class="max-w-md space-y-1">
            <h2 class="filament-tables-empty-state-heading text-primary-500 text-xl font-bold tracking-tight">
                {{ $slot }}
            </h2>

            <p class="filament-tables-empty-state-description whitespace-normal text-sm font-medium text-gray-500">

            </p>
        </div>

    </div>

</div>
