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
                <div class="mb-3">
                    <div class="flex justify-between flex-col md:flex-row">
                        <h2 class="text-2xl font-bold mb-4">{{ $nombre }}</h2>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div class="flex flex-col md:flex-row">
                                <span class="font-semibold mr-2">Docente:</span>
                                <span>{{ $docente }}</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div class="flex flex-col md:flex-row">
                                <span class="font-semibold mr-2">Alumno:</span>
                                <span>{{ $alumno }}</span>
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
