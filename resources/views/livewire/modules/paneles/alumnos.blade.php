<div>
    <header class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Bienvenido, {{ $alumno_nombre }}</h1>
            <p class="text-gray-600 dark:text-slate-400">Aquí tienes el resumen de tu actividad.</p>
        </div>
        <button id="theme-toggle"
            class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-slate-700">
            <svg id="theme-toggle-dark-icon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 5.05a1 1 0 010 1.414l-.707.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM3 11a1 1 0 100-2H2a1 1 0 100 2h1z">
                </path>
            </svg>
        </button>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div
            class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-md dark:border dark:border-slate-700 flex items-center">
            <div class="bg-green-100 dark:bg-green-900/50 p-3 rounded-full mr-4">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.95-.69l1.519-4.674z">
                    </path>
                </svg>
            </div>
            <div>
                <span class="text-gray-500 dark:text-slate-400 font-semibold">Créditos Acumulados</span>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $alumno_creditos }}</p>
            </div>
        </div>
        <div
            class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-md dark:border dark:border-slate-700 flex items-center">
            <div class="bg-blue-100 dark:bg-blue-900/50 p-3 rounded-full mr-4">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <span class="text-gray-500 dark:text-slate-400 font-semibold">Talleres Inscritos</span>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($mis_inscripciones) }}</p>
            </div>
        </div>
        <div
            class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-md dark:border dark:border-slate-700 flex items-center">
            <div class="bg-indigo-100 dark:bg-indigo-900/50 p-3 rounded-full mr-4">
                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
            </div>
            <div>
                <span class="text-gray-500 dark:text-slate-400 font-semibold">Talleres Disponibles</span>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($talleres_disponibles) }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <main class="lg:col-span-2">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Inscríbete a un Taller</h2>
            <div class="space-y-4">
                @foreach ($talleres_disponibles as $taller)
                    <div
                        class="bg-white dark:bg-slate-800 p-5 rounded-lg shadow-md transition hover:shadow-xl dark:border dark:border-slate-700">
                        <div class="flex flex-col sm:flex-row justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-indigo-700 dark:text-indigo-400">
                                    {{ $taller->nombre }}</h3>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mb-2">Impartido por:
                                    {{ $taller->docente->user->name }}</p>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mb-2">Tipo:
                                    {{ $taller->tipo }}</p>
                                <div class="flex items-center text-sm space-x-4">
                                    <span class="font-bold text-green-600 dark:text-green-500">1
                                        Créditos</span>
                                </div>
                            </div>
                            <div class="mt-4 sm:mt-0 flex items-center">
                                @if (count($mis_inscripciones) == 2)
                                    <button disabled
                                        class="w-full sm:w-auto flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-500 dark:bg-blue-600 rounded-md cursor-not-allowed">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Ya estás inscrito a 2 talleres
                                    </button>
                                @else
                                    <button wire:click="info({{ $taller->taller_id }})"
                                        class="w-full sm:w-auto px-4 py-2 font-medium text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                        Inscribirse
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <aside>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-md dark:border dark:border-slate-700">
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Mis Inscripciones</h3>
                <div class="space-y-4">
                    @forelse ($mis_inscripciones as $inscripcion)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-slate-100">
                                    {{ $inscripcion->horarios->taller->nombre }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-slate-400">{{ $inscripcion['creditos'] }}
                                    créditos</p>
                            </div>
                            <span
                                class="text-sm font-medium{{ $inscripcion->estatus == 1 ? 'text-lime-600 dark:text-lime-500' : 'text-red-600 dark:text-red-500' }} ">{{ $inscripcion->estatus == 1 ? 'Activo' : 'Finalizado' }}</span>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 dark:text-slate-400 py-4">Aún no te has inscrito a ningún
                            taller.</p>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>
