<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 sm:p-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Gestión de Talleres
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Administra tus talleres existentes o crea uno nuevo.
                </p>
            </div>
            <div>
                <x-button wire:click="create" class="">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Nuevo Taller</span>
                </x-button>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($collection as $item)
                <article
                    class="group flex flex-col h-full bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden">

                    <div class="p-6 flex-grow">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 dark:bg-gray-700 rounded-full p-3">
                                <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                </svg>
                            </div>
                            <div class="flex-grow min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate"
                                    title="{{ $item->nombre }}">
                                    {{ $item->nombre }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $item->tipo }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex justify-end gap-3">
                            <x-button wire:click="edit({{ $item->taller_id }})">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                Editar
                            </x-button>
                            <a href="{{ route('docentes.talleres.read', ['id' => $item->taller_id]) }}"
                                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Horarios
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">
                        No hay talleres
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Aún no has creado ningún taller. ¡Anímate a crear el primero!
                    </p>
                    <div class="mt-6">
                        <x-button wire:click="create" class="!bg-indigo-600 hover:!bg-indigo-700">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Crear mi primer taller</span>
                        </x-button>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($collection->hasPages())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md px-4 py-3">
                {{ $collection->onEachSide(1)->links() }}
            </div>
        @endif
    </div>

    <x-dialog-modal wire:model="modalForm">
        <x-slot name="title">
            <h2 class="text-center">Editar Taller</h2>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="submitForm" class="space-y-3">
                <div class="flex flex-col gap-1">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre
                        del
                        Taller</label>
                    <x-input type="text" wire:model="nombre" id="nombre"
                        placeholder="Ej. Taller de Fotografía Digital" />
                    <x-input-error for="nombre" class="mt-2" />
                </div>

                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo
                        de
                        Taller</label>
                    <select wire:model="tipo" id="tipo"
                        class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="Deportivo">Deportivo</option>
                        <option value="Cultural">Cultural</option>
                        <option value="Academico">Académico</option>
                    </select>
                    <x-input-error for="tipo" class="mt-2" />
                </div>

                <div class="pt-4 text-right">
                    <x-button type="submit">
                        <span wire:loading.remove wire:target="saveTaller">
                            Guardar Taller
                        </span>
                        <span wire:loading wire:target="saveTaller">
                            Guardando...
                        </span>
                    </x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
