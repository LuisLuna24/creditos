<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Mis Talleres Inscritos
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Aquí puedes ver los talleres a los que te has unido.
                    </p>
                </div>

                <div class="w-full sm:w-1/3">
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-blue-700 dark:text-white">Progreso</span>
                        <span class="text-sm font-medium text-blue-700 dark:text-white">
                            {{ $collection->count() }} de 2 talleres
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full"
                            style="width: {{ ($collection->count() / 2) * 100 }}%"></div>
                    </div>
                </div>

                <div>
                    <x-button wire:click="create">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        <span>Inscribirse a Taller</span>
                    </x-button>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($collection as $item)
                <article
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col group transform hover:-translate-y-1 transition-transform duration-300">

                    <div class="h-3 bg-teal-500"></div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-1 truncate"
                            title="{{ $item->horarios->taller->nombre }}">
                            {{ $item->horarios->taller->nombre }}
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex items-center">
                            <svg class="h-4 w-4 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Prof. {{ $item->horarios->profesor->nombre ?? 'No asignado' }}</span>
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="h-5 w-5 mr-3 text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($item->horarios->hora_inicio)->format('g:i A') }} -
                                    {{ \Carbon\Carbon::parse($item->horarios->hora_fin)->format('g:i A') }}</span>
                            </div>
                            <div class="flex items-start text-sm text-gray-600 dark:text-gray-300">
                                <svg class="h-5 w-5 mr-3 text-gray-400 flex-shrink-0 mt-0.5"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                                </svg>
                                <ul class="flex flex-wrap gap-2">
                                    @forelse ($item->horarios->dias as $dia)
                                        <li
                                            class="bg-teal-100 text-teal-800 text-xs font-semibold px-2 py-0.5 rounded-full dark:bg-teal-900 dark:text-teal-200">
                                            {{ $dia->nombre }}</li>
                                    @empty
                                        <li class="text-xs text-gray-400">Sin días</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="mt-auto pt-6">
                            <x-button wire:click="info({{ $item->horario_alumno_id }})"
                                class="w-full !bg-white dark:!bg-gray-700 !text-gray-700 dark:!text-gray-200 border border-gray-300 dark:border-gray-600 hover:!bg-gray-50 dark:hover:!bg-gray-600">
                                Ver Detalles
                            </x-button>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Aún no te has inscrito a ningún
                        taller</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Explora las opciones disponibles y
                        encuentra tu próximo reto académico.</p>
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
