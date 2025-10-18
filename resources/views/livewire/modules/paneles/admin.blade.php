<div class="p-4 sm:p-6 lg:p-8 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Panel de Administrador</h1>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Resumen general del sistema.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex items-center space-x-4">
                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900 rounded-full p-3">
                    <svg class="h-7 w-7 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Alumnos</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAlumnos }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex items-center space-x-4">
                <div class="flex-shrink-0 bg-indigo-100 dark:bg-indigo-900 rounded-full p-3">
                    <svg class="h-7 w-7 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Docentes</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalDocentes }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex items-center space-x-4">
                <div class="flex-shrink-0 bg-green-100 dark:bg-green-900 rounded-full p-3">
                    <svg class="h-7 w-7 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0l-.07.002z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Talleres</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalTalleres }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex items-center space-x-4">
                <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900 rounded-full p-3">
                    <svg class="h-7 w-7 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Inscripciones</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalInscripciones }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Talleres con Mayor Demanda</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Top 5 de talleres con más alumnos inscritos.
                </p>
            </div>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($talleresPopulares as $horario)
                    <li class="p-6">
                        <div class="flex items-center justify-between">
                            <span
                                class="font-semibold text-gray-800 dark:text-gray-200">{{ $horario->taller->nombre }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $horario->alumnos_count }} de
                                {{ $horario->cupo }} alumnos</span>
                        </div>
                        <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                            @php
                                $porcentaje = $horario->cupo > 0 ? ($horario->alumnos_count / $horario->cupo) * 100 : 0;
                            @endphp
                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $porcentaje }}%"></div>
                        </div>
                    </li>
                @empty
                    <li class="p-6 text-center text-gray-500 dark:text-gray-400">No hay datos de talleres para mostrar.
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Nuevos Alumnos</h3>
                </div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($alumnosRecientes as $alumno)
                        <li class="p-4 flex items-center space-x-3">
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="https://ui-avatars.com/api/?name={{ urlencode($alumno->name) }}&color=7F9CF5&background=EBF4FF"
                                alt="">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $alumno->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $alumno->created_at->diffForHumans() }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="p-6 text-center text-gray-500 dark:text-gray-400">No hay alumnos recientes.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Nuevos Docentes</h3>
                </div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($docentesRecientes as $docente)
                        <li class="p-4 flex items-center space-x-3">
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="https://ui-avatars.com/api/?name={{ urlencode($docente->name) }}&color=818CF8&background=EEF2FF"
                                alt="">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $docente->name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $docente->created_at->diffForHumans() }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="p-6 text-center text-gray-500 dark:text-gray-400">No hay docentes recientes.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
