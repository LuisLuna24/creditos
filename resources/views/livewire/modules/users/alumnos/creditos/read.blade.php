<div class="p-6 md:p-8 bg-gray-50 dark:bg-gray-900 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div x-data="{ selectedTab: 'groups' }" class="w-full">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex gap-6" role="tablist" aria-label="Tab options">
                <button @click="selectedTab = 'groups'"
                    :class="selectedTab === 'groups' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" role="tab"
                    :aria-selected="selectedTab === 'groups'" :tabindex="selectedTab === 'groups' ? '0' : '-1'">
                    Detalles del Crédito
                </button>
                <button @click="selectedTab = 'likes'"
                    :class="selectedTab === 'likes' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" role="tab"
                    :aria-selected="selectedTab === 'likes'" :tabindex="selectedTab === 'likes' ? '0' : '-1'">
                    Información del Taller
                </button>
            </nav>
        </div>

        <div class="py-6">
            <div x-cloak x-show="selectedTab === 'groups'" role="tabpanel" aria-label="groups">
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 p-6">

                    <div
                        class="flex flex-col sm:flex-row justify-between items-start gap-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <span class="block text-sm font-medium text-indigo-600 dark:text-indigo-400">Constancia de
                                Acreditación</span>
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $nombre }}</h2>
                        </div>

                        <div class="text-center flex-shrink-0">
                            <span class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Calificación Final</span>
                            @php($desempenio = strtolower($desempenio))
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1.5 px-4 rounded-full text-lg font-semibold
                                {{ $desempenio == 'excelente' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                {{ $desempenio == 'bueno' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                {{ $desempenio == 'regular' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                {{ $desempenio == 'insuficiente' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}">
                                {{ ucfirst($desempenio) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 mt-6">
                        <div class="space-y-4">
                            <div class="flex items-start gap-x-4">
                                <svg class="h-6 w-6 text-gray-400 mt-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Alumno</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $alumno }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-x-4">
                                <svg class="h-6 w-6 text-gray-400 mt-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0l-.07.004c-.03.002-.06.004-.09.006l-.09.006c-.09.006-.179.01-.268.014l-.068.007-.068.007c-.083.009-.164.017-.246.026l-.07.009c-.097.012-.193.023-.288.034l-.074.009-.074.009c-.093.011-.187.022-.28.033l-.07.008c-.097.012-.193.023-.288.035l-.074.008c-.094.012-.187.022-.28.033l-.07.008-.097.012-.073.008c-.097.012-.193.023-.288.035l-.074.008-.094.012l-.07.008c-.097.012-.193.023-.288.034l-.074.009c-.094.012-.187.022-.28.033l-.07.008-.097.012l-.073.008c-.097.012-.193.023-.288.034l-.074.009-.094.012-.07.008c-.097.012-.193.023-.288.035l-.073.008c-.097.012-.193.023-.288.034" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Docente</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $docente }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start gap-x-4">
                                <svg class="h-6 w-6 text-gray-400 mt-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Valor del Crédito</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $numero_creditos }} créditos con
                                        valor de {{ $valor_numerico }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-right">
                        <x-button class="!bg-indigo-600 hover:!bg-indigo-700">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Descargar Constancia
                        </x-button>
                    </div-->
                </div>
            </div>

            <div x-cloak x-show="selectedTab === 'likes'" role="tabpanel" aria-label="likes">
                <fieldset class="max-w-4xl opacity-60" disabled>
                    @include('Modules.Shere.Talleres.horarios-form')
                </fieldset>
            </div>
        </div>
    </div>
</div>
