<div class="">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="matricula">Matrícula:</label>
            <x-input type="number" wire:model="dataForm.matricula" id="matricula"/>
            <x-input-error for="dataForm.matricula" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="nombre">Nombre/s:</label>
            <x-input wire:model="dataForm.nombre" id="nombre"/>
            <x-input-error for="dataForm.nombre" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="a_paterno">Apellido paterno:</label>
            <x-input wire:model="dataForm.a_paterno" id="a_paterno"/>
            <x-input-error for="dataForm.a_paterno" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="a_materno">Apellido materno:</label>
            <x-input wire:model="dataForm.a_materno" id="a_materno"/>
            <x-input-error for="dataForm.a_materno" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="md:col-span-2 pt-2">
            <fieldset>
                <legend>Sexo</legend>
                <div class="mt-2 flex items-center gap-x-6">
                    <label class="flex items-center gap-x-2 cursor-pointer">
                        <x-input type="radio" wire:model="dataForm.sexo" value="M" />
                        <span class="text-sm">Masculino</span>
                    </label>

                    <label class="flex items-center gap-x-2 cursor-pointer">
                        <x-input type="radio" wire:model="dataForm.sexo" value="F" />
                        <span class="text-sm">Femenino</span>
                    </label>
                </div>
            </fieldset>
            <x-input-error for="dataForm.sexo" class="mt-2 text-sm text-red-600" />
        </div>
    </div>
</div>
