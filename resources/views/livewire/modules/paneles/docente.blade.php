<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen" x-data="clock()" x-init="startClock()">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Panel del Docente
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tus talleres programados para hoy:
                    <span
                        class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $fechaActual->translatedFormat('l, d \d\e F') }}</span>
                    | <span class="font-mono bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded text-xs"
                        x-text="time"></span>
                </p>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($horariosDelDia as $horario)
                <article
                    class="group flex flex-col h-full bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden">

                    <div class="p-6 flex-grow">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 dark:bg-gray-700 rounded-full p-3">
                                <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-grow min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate"
                                    title="{{ $horario->taller->nombre }}">
                                    {{ $horario->taller->nombre }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Tipo: {{ $horario->taller->tipo }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{-- Asumo que tienes una relación `alumnos` en tu modelo Horario --}}
                                {{ $horario->alumnos->count() }} Estudiantes
                            </span>
                            @php
                                $horaFin = \Carbon\Carbon::parse($horario->hora_fin);
                                $haTerminado = now()->gt($horaFin);
                            @endphp
                            <span @class([
                                'inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full',
                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' => !$haTerminado,
                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' => $haTerminado,
                            ])>
                                {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A') }} -
                                {{ $horaFin->format('h:i A') }}
                            </span>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                            <a href="{{ route('docentes.horarios.read', ['id' => $horario->horario_id]) }}"
                                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>Visualizar Horario</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">
                        ¡Día libre!
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        No tienes talleres programados para hoy. ¡Disfruta tu día!
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function clock() {
            return {
                time: new Date().toLocaleTimeString('es-MX', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                }),
                startClock() {
                    setInterval(() => {
                        this.time = new Date().toLocaleTimeString('es-MX', {
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                    }, 1000);
                }
            }
        }
    </script>
</div>
