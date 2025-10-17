<div class="">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="matricula">Matrícula:</label>
            <x-input type="number" wire:model="dataForm.matricula" id="matricula" disabled />
            <x-input-error for="dataForm.matricula" class="mt-2 text-sm text-red-600" />
        </div>
        @if ($dataForm->esAlumno == 1)
            <div class="flex flex-col gap-1 mb-2 md:col-span-2">
                <label for="dataForm.carrera">Carrera:</label>
                <x-select wire:model="dataForm.carrera">
                    <option value="" disabled>Seleccione una opción</option>
                    @forelse($carreras as $item)
                        <option value="{{ $item->carrera_id }}">{{ $item->nombre }}</option>
                    @empty
                        <option value="0" disabled>No hay carreras registradas</option>
                    @endforelse
                </x-select>
                <x-input-error for="dataForm.carrera" />
            </div>
        @endif
        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="nombre">Nombre/s:</label>
            <x-input wire:model="dataForm.nombre" id="nombre" />
            <x-input-error for="dataForm.nombre" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="a_paterno">Apellido paterno:</label>
            <x-input wire:model="dataForm.a_paterno" id="a_paterno" />
            <x-input-error for="dataForm.a_paterno" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="a_materno">Apellido materno:</label>
            <x-input wire:model="dataForm.a_materno" id="a_materno" />
            <x-input-error for="dataForm.a_materno" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="pt-2">
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
        @if ($dataForm->esAlumno == 1)
            <div class="flex flex-col gap-1">
                <label for="semestre">Semestre:</label>
                <x-select wire:model="dataForm.semestre" id="semestre">
                    <option value="" disabled>Selecciona un semestre</option>
                    @php
                        // Arreglo con las terminaciones para los números ordinales
                        $suffixes = [
                            1 => 'er',
                            2 => 'do',
                            3 => 'er',
                            4 => 'to',
                            5 => 'to',
                            6 => 'to',
                            7 => 'mo',
                            8 => 'vo',
                            9 => 'no',
                            10 => 'mo',
                            11 => 'vo',
                            12 => 'vo',
                            13 => 'vo',
                        ];
                    @endphp
                    @for ($i = 1; $i <= 13; $i++)
                        <option value="{{ $i }}">{{ $i }}{{ $suffixes[$i] ?? 'to' }} Semestre
                        </option>
                    @endfor
                </x-select>
                <x-input-error for="dataForm.semestre" class="mt-2 text-sm text-red-600" />
            </div>
        @endif
    </div>
</div>
