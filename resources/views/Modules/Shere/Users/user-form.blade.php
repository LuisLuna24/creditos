<div class="">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="nombre">Nombre de usuario:</label>
            <x-input wire:model="userForm.nombre" id="nombre"/>
            <x-input-error for="userForm.nombre" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="email">Correo:</label>
            <x-input type="email" wire:model="userForm.email" id="email"/>
            <x-input-error for="userForm.email" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="password">Contraseña:</label>
            <x-input type="password" wire:model="userForm.password" id="password"/>
            <x-input-error for="userForm.password" class="mt-2 text-sm text-red-600" />
        </div>

         <div class="flex flex-col gap-1">
            <label for="password_confirmation">Confirmar contraseña:</label>
            <x-input type="password" wire:model="userForm.password_confirmation" id="password_confirmation"/>
            <x-input-error for="userForm.password_confirmation" class="mt-2 text-sm text-red-600" />
        </div>
    </div>
</div>
