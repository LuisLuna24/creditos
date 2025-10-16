<div>
    <div
        class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 max-w-2xl mx-auto">

        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Registrar Nuevo Taller</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Completa la información para añadir un nuevo taller
                al sistema.</p>
        </div>

        <hr class="my-6 border-gray-200 dark:border-gray-700">

        @if (session()->has('message'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                class="bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded-lg relative mb-6"
                role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <form wire:submit.prevent="saveTaller" class="space-y-6">

            <div class="flex flex-col gap-1">
                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del
                    Taller</label>
                <x-input type="text" wire:model="nombre" id="nombre"
                    placeholder="Ej. Taller de Fotografía Digital" />
                <x-input-error for="nombre" class="mt-2" />
            </div>

            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de
                    Taller</label>
                <select wire:model="tipo" id="tipo"
                    class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="Deportivo">Deportivo</option>
                    <option value="Cultural">Cultural</option>
                    <option value="Académico">Académico</option>
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
    </div>
</div>
