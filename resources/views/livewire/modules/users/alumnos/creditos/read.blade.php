<div class="p-6 md:p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div x-data="{ selectedTab: 'groups' }" class="w-full">
        <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()"
            class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist"
            aria-label="tab options">
            <button x-on:click="selectedTab = 'groups'" x-bind:aria-selected="selectedTab === 'groups'"
                x-bind:tabindex="selectedTab === 'groups' ? '0' : '-1'"
                x-bind:class="selectedTab === 'groups' ?
                    'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' :
                    'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
                class="h-min px-4 py-2 text-sm" type="button" role="tab"
                aria-controls="tabpanelGroups">Credito</button>
            <button x-on:click="selectedTab = 'likes'" x-bind:aria-selected="selectedTab === 'likes'"
                x-bind:tabindex="selectedTab === 'likes' ? '0' : '-1'"
                x-bind:class="selectedTab === 'likes' ?
                    'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' :
                    'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
                class="h-min px-4 py-2 text-sm" type="button" role="tab"
                aria-controls="tabpanelLikes">Taller</button>
        </div>
        <div class="px-2 py-4 text-neutral-600 dark:text-neutral-300">
            <div x-cloak x-show="selectedTab === 'groups'" id="tabpanelGroups" role="tabpanel" aria-label="groups">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-4">{{ $nombre }}</h2>

                    <div class="space-y-4 divide-y divide-gray-200">

                        <div class="flex items-center pt-4 first:pt-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-500 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-5.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-5.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222 4 2.222V20M1 12v7a2 2 0 002 2h18a2 2 0 002-2v-7" />
                            </svg>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                <span class="font-semibold">Docente:</span>
                                <span>{{ $docente }}</span>
                            </div>
                        </div>

                        <div class="flex items-center pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-500 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">12
                                <span class="font-semibold">Alumno:</span>
                                <span>{{ $alumno }}</span>
                            </div>
                        </div>

                        <div class="flex items-center pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-500 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                <span class="font-semibold">Valor numérico:</span>
                                <span>{{ $valor_numerico }}</span>
                            </div>
                        </div>

                        <div class="flex items-center pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-500 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.95-.69l1.519-4.674z" />
                            </svg>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                <span class="font-semibold">Número de créditos:</span>
                                <span>{{ $numero_creditos }}</span>
                            </div>
                        </div>

                        <div class="flex items-center pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-graph h-6 w-6 mr-3 text-indigo-500 flex-shrink-0">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M4 18v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M7 14l3 -3l2 2l3 -3l2 2" />
                            </svg>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                <span class="font-semibold">Desempeño de actividades:</span>
                                <span>{{ $desempenio }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div x-cloak x-show="selectedTab === 'likes'" id="tabpanelLikes" role="tabpanel" aria-label="likes">
                <fieldset class="max-w-4xl" disabled>
                    @include('Modules.Shere.Talleres.horarios-form')
                </fieldset>
            </div>
        </div>
    </div>
</div>
