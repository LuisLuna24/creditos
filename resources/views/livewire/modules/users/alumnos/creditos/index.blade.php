<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Mis Créditos Académicos
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Un resumen de todos los talleres y actividades que has completado.
                </p>
            </div>
            <div class="text-center">
                <span
                    class="block text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $collection->count() }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">Créditos Obtenidos</span>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($collection as $item)
                <article
                    class="relative bg-white dark:bg-gray-800 rounded-lg shadow-md flex flex-col group transition-shadow duration-300 hover:shadow-xl">

                    @if (true)
                        <div class="absolute top-0 right-0 mt-3 mr-3">
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Acreditado
                            </span>
                        </div>
                    @endif

                    <div class="p-5 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white pr-20"
                            title="{{ $item->horario->taller->nombre }}">
                            {{ $item->horario->taller->nombre }}
                        </h2>

                        <p class="mt-2 flex items-center gap-x-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $item->horario->taller->docente->user->name }}</span>
                        </p>

                        <hr class="my-4 border-gray-200 dark:border-gray-700">

                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="flex items-center gap-x-2 text-gray-500 dark:text-gray-400">
                                <svg class="h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-gray-700 dark:text-gray-300">Período</span>
                                    <p>{{ $item->horario->periodo }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-x-2 text-gray-500 dark:text-gray-400">
                                <svg class="h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-gray-700 dark:text-gray-300">Fecha</span>
                                    <p>{{ $item->horario?->dia_inicio?->translatedFormat('d M') }} -
                                        {{ $item->horario?->dia_fin?->translatedFormat('d M, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto pt-5">
                            <x-button wire:click="info({{ $item->credito_id }})"
                                class="w-full justify-center !bg-indigo-600 hover:!bg-indigo-700">
                                Ver Constancia
                            </x-button>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full flex flex-col items-center justify-center text-center py-16 px-4 bg-white dark:bg-gray-800 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Aún no tienes créditos</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Los créditos de los talleres que completes
                        aparecerán aquí.</p>
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
