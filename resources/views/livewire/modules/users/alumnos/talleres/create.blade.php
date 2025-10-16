<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <header
            class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex-grow">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Explorar Talleres Disponibles
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Encuentra el taller perfecto para ti. Busca por nombre o por docente.
                </p>
            </div>

            <div class="w-full md:w-auto md:min-w-[350px]">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-input wire:model.live.debounce.500ms="search" id="search"
                        placeholder="Buscar por nombre o docente..." class="w-full pl-10 pr-10" />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <div wire:loading wire:target="search">
                            <svg class="animate-spin h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                        <div wire:loading.remove wire:target="search">
                            @if ($search)
                                <button type="button" class="text-gray-500 hover:text-gray-700"
                                    wire:click="$set('search', '')" aria-label="Limpiar búsqueda">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($talleres as $item)
                <article
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col group transform hover:-translate-y-1 transition-all duration-300">
                    <div class="h-2 bg-purple-500"></div>

                    <div class="p-5 flex flex-col flex-grow">
                        <div>
                            <span
                                class="inline-block bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300 text-xs font-semibold px-2.5 py-1 rounded-full mb-2">{{ $item->tipo ?? 'General' }}</span>
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white truncate"
                                title="{{ $item->nombre }}">
                                {{ $item->nombre }}
                            </h2>
                        </div>

                        <p class="mt-2 flex items-center gap-x-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Impartido por: <strong>{{ $item->docente->user->name }}</strong></span>
                        </p>

                        <hr class="my-4 border-gray-200 dark:border-gray-700">

                        <div class="mt-auto pt-6">
                            <x-button wire:click="info({{ $item->taller_id }})"
                                class="w-full justify-center ">
                                Ver Horarios y Cupos
                            </x-button>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md text-center py-16 px-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium">No se encontraron talleres</h3>
                    <p class="mt-2 text-sm">Prueba con otras palabras clave o revisa la
                        lista completa sin filtros.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
