<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Gestión de Talleres
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Administra tus talleres existentes o crea uno nuevo.
                </p>
            </div>
            <div>
                <x-button wire:click="create" class="">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Nuevo Taller</span>
                </x-button>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($collection as $item)
                <article
                    class="group bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-all duration-300 border-t-4 border-indigo-500">
                    <div class="p-5 flex flex-col h-full">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 dark:bg-indigo-900/50 rounded-full p-3">
                                <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate"
                                    title="{{ $item->nombre }}">
                                    {{ $item->nombre }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $item->tipo }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700/50">
                            <a href="{{ route('docentes.talleres.edit', ['id' => $item->taller_id]) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Visualizar
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">
                        No hay talleres
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Aún no has creado ningún taller. ¡Anímate a crear el primero!
                    </p>
                    <div class="mt-6">
                        <x-button wire:click="create" class="!bg-indigo-600 hover:!bg-indigo-700">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Crear mi primer taller</span>
                        </x-button>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($collection->hasPages())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md px-4 py-3">
                {{ $collection->onEachSide(1)->links() }}
            </div>
        @endif
    </div>
</div>
