<div class="rounded-xl shadow-lg overflow-hidden">

    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">{{ $nombre }}</h2>

        <div class="space-y-3">

            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-indigo-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-semibold mr-2">Docente:</span>
                <span>{{ $docente }}</span>
            </div>
        </div>

        <hr class="my-6">

        <div>
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-indigo-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-semibold">Horarios Programados</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($horarios as $item)
                    <article
                        class="relative flex flex-col overflow-hidden transition-transform duration-300 ease-in-out transform bg-white rounded-lg shadow-lg dark:bg-slate-800 dark:border dark:border-slate-700 hover:scale-105">

                        <div class="flex flex-col flex-grow p-6">

                            <div class="flex items-start justify-between mb-4">
                                @php
                                    $lugaresDisponibles = $item->cupo - $item->alumnos->count();
                                @endphp
                                <div class="flex-shrink-0">
                                    @if ($lugaresDisponibles <= 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full dark:text-red-200 dark:bg-red-900/50">
                                            Agotado
                                        </span>
                                    @elseif ($lugaresDisponibles <= 5)
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full dark:text-yellow-200 dark:bg-yellow-900/50">
                                            ¡Últimos {{ $lugaresDisponibles }}!
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:text-green-200 dark:bg-green-900/50">
                                            {{ $lugaresDisponibles }} Disponibles
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-3 text-sm text-gray-600 dark:text-slate-300">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-400 dark:text-slate-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($item->hora_inicio)->format('g:i A') }} -
                                        {{ \Carbon\Carbon::parse($item->hora_fin)->format('g:i A') }}
                                    </span>
                                </div>

                                <div class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 text-gray-400 dark:text-slate-500 flex-shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($item->dias as $dia)
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full dark:bg-blue-900/70 dark:text-blue-200">
                                                {{ $dia->nombre }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-gray-400 dark:text-gray-500">Días no
                                                especificados</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 mt-auto bg-gray-300 dark:bg-slate-700/50">
                            <x-button wire:click="inscribir({{ $item->horario_id }})" class="w-full" :disabled="$lugaresDisponibles <= 0">
                                {{ $lugaresDisponibles > 0 ? 'Inscribirme' : 'Cupo Lleno' }}
                            </x-button>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md text-center py-16 px-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No se encontraron horarios
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Intenta ajustar tus términos de búsqueda o revisa más tarde.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="inscribirModal">
        <x-slot name="title">
            <h2 class="text-center">Inscribirse</h2>
        </x-slot>
        <x-slot name="content">
            <form wire:submit="inscribirForm" class="space-y-3">
                <p class="text-center">¿Deseas inscribirte a {{ $nombre }}?</p>
                <div class="flex justify-around">
                    <x-danger-button wire:click="$set('inscribirModal',false)">Cancelar</x-danger-button>
                    <x-button>Inscribirse</x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
