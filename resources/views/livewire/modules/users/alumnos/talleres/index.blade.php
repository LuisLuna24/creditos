<div class="space-y-3 px-6">
    <section class="w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">

            <div>
                <x-button wire:click="create">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Inscribirse a taller</span>
                </x-button>
            </div>

            <div class="text-sm font-medium text-gray-600 dark:text-gray-300">
                Talleres inscritos:
                <span
                    class="font-bold text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 rounded-full px-2 py-1">
                    {{ count($collection) }}/2
                </span>
            </div>

        </div>
    </section>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($collection as $item)
            <article
                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col transform hover:scale-105 transition-transform duration-300 ease-in-out">

                <div class="p-6 flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2 truncate">
                        {{ $item->horarios->taller->nombre }}
                    </h2>

                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>
                            {{ \Carbon\Carbon::parse($item->horarios->hora_inicio)->format('g:i A') }} -
                            {{ \Carbon\Carbon::parse($item->horarios->hora_fin)->format('g:i A') }}
                        </span>
                    </p>

                    <div class="mb-6">
                        <h3 class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 mb-2">Días
                            disponibles</h3>
                        <ul class="flex flex-wrap gap-2">
                            @forelse ($item->horarios->dias as $dia)
                                <li
                                    class="bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full dark:bg-teal-900 dark:text-teal-200">
                                    {{ $dia->nombre }}
                                </li>
                            @empty
                                <li class="text-xs text-gray-400 dark:text-gray-500">No hay días definidos.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700/50 p-4">
                    <x-button wire:click="info({{ $item->horario_alumno_id }})" class="w-full">
                        Más información
                    </x-button>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 text-lg">No hay talleres disponibles en este momento.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-3">
        {{ $collection->onEachSide(1)->links() }}
    </div>
</div>
