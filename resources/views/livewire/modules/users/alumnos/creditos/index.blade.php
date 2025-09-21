<div class="space-y-3 px-6 py-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($collection as $item)
            <article
                class="flex flex-col bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1">

                <div class="p-6 flex-grow flex flex-col">
                    <div>
                        <span class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Taller</span>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white truncate"
                            title="{{ $item->horario->taller->nombre }}">
                            {{ $item->horario->taller->nombre }}
                        </h2>
                    </div>

                    <ul class="mt-4 space-y-3 text-gray-700 dark:text-gray-300 flex-grow">
                        <li class="flex items-center gap-x-3">
                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span class="text-base truncate">{{ $item->horario->taller->docente->user->name }}</span>
                        </li>
                        <li class="flex items-center gap-x-3">
                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <span class="text-sm">{{ $item->horario?->dia_inicio?->translatedFormat('d M') }} -
                                {{ $item->horario?->dia_fin?->translatedFormat('d M, Y') }}</span>
                        </li>
                        <li class="flex items-center gap-x-3">
                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                            <span class="text-sm">{{ $item->horario->periodo }}</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-gray-50 dark:bg-gray-900/50 p-4 border-t border-gray-200 dark:border-gray-700">
                    <x-button wire:click="info({{ $item->credito_id }})" class="w-full justify-center">
                        Más información
                    </x-button>
                </div>
            </article>
        @empty
            <div
                class="col-span-full flex flex-col items-center justify-center text-center py-16 px-4 bg-white dark:bg-gray-800 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
                {{-- Icono SVG Opcional --}}
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">No hay créditos</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No hay créditos disponibles en este momento.
                </p>
            </div>
        @endforelse
    </div>
    <div class="mt-3">
        {{ $collection->onEachSide(1)->links() }}
    </div>
</div>
