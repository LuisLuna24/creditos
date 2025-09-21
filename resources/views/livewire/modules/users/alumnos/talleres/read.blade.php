<div class="p-6 md:p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div class="mb-3">
        <div class="flex justify-between flex-col md:flex-row">
            <h2 class="text-2xl font-bold mb-4">{{ $nombre }}</h2>
            <x-danger-button wire:click="delete({{ $id }})">Darse de baja del taller</x-danger-button>
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
        </div>

        <hr class="my-6">
    </div>
    <fieldset class="max-w-4xl" disabled>
        @include('Modules.Shere.Talleres.horarios-form')
    </fieldset>

    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <h2 class="text-center">Darse de baja del taller</h2>
        </x-slot>
        <x-slot name="content">
            <p class="text-center">¿Desea darte de baja de este taller?</p>
            <p class="text-center">Si te das de baja no resiviras tu credito</p>
            <form wire:submit="deleteSubmit">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="flex flex-col gap-1">
                        <label for="password">Contraseña:</label>
                        <x-input type="password" wire:model="password" id="password" />
                        <x-input-error for="password" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password_confirmation">Confirmar contraseña:</label>
                        <x-input type="password" wire:model="password_confirmation" id="password_confirmation" />
                        <x-input-error for="password_confirmation" class="mt-2 text-sm text-red-600" />
                    </div>
                </div>
                <div class="flex justify-around mt-5">
                    <x-danger-button wire:click="$set('deleteModal',false)">Cancelar</x-danger-button>
                    <x-button>Elimnar</x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
