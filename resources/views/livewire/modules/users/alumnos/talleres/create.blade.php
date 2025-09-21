<div class="bg-gray-100 dark:bg-gray-900 p-4 sm:p-6 rounded-lg shadow-inner space-y-6">

    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Buscar Taller
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <x-input wire:model.live.debounce.500ms="search" id="search" placeholder="Buscar por nombre o docente..."
                class="w-full pl-10 pr-10 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />

            <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg class="animate-spin h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>

            <div wire:loading.remove wire:target="search">
                @if ($search)
                    <button type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors"
                        wire:click="$set('search', '')" aria-label="Limpiar búsqueda">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($talleres as $item)
            <article
                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col transform hover:scale-105 transition-transform duration-300 ease-in-out">


                <div class="p-6 flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4 truncate">
                        {{ $item->nombre }}
                    </h2>
                    <div class="flex items-center">
                        <div>
                            <p class="font-semibold text-gray-700 dark:text-gray-200">{{ $item->docente->user->name }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Docente</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4">
                    <x-button wire:click="info({{ $item->taller_id }})" class="w-full">
                        Más información
                    </x-button>
                </div>

            </article>
        @empty
            <div class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md text-center py-16 px-6">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No se encontraron talleres</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Intenta ajustar tus términos de búsqueda o revisa más tarde.
                </p>
            </div>
        @endforelse
    </div>
</div>
