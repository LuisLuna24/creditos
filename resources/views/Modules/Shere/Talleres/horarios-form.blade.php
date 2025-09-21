<div class="">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="dia_inicio">Día de inicio del taller:</label>
            <x-input type="date" wire:model="horarioForm.dia_inicio" id="dia_inicio" />
            <x-input-error for="horarioForm.dia_inicio" />
        </div>

        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="dia_fin">Día de fin del taller:</label>
            <x-input type="date" wire:model="horarioForm.dia_fin" id="dia_fin" />
            <x-input-error for="horarioForm.dia_fin" />
        </div>


        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="hora_inicio">Hora inicio:</label>
            <x-input type="time" wire:model="horarioForm.hora_inicio" id="hora_inicio" />
            <x-input-error for="horarioForm.hora_inicio" />
        </div>

        <div class="flex flex-col gap-1 md:col-span-2">
            <label for="hora_fin">Hora fin:</label>
            <x-input type="time" wire:model="horarioForm.hora_fin" id="hora_fin" />
            <x-input-error for="horarioForm.hora_fin" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="periodo">Periodo:</label>
            <x-input wire:model="horarioForm.periodo" id="periodo" placeholder="Eje. 2025/1" />
            <x-input-error for="horarioForm.periodo" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="cupo">Cupo maximo de alumnos:</label>
            <x-input wire:model="horarioForm.cupo" id="cupo" placeholder="Eje. 25" />
            <x-input-error for="horarioForm.cupo" />
        </div>
    </div>
    <div class="my-3">
        <h3 class="text-lg">Dias de la semana</h3>
        <hr>
    </div>
    <x-input-error for="horarioForm.dias"/>
    <x-table.table>
        <x-slot name="titles">
            <x-table.th></x-table.th>
            <x-table.th>Nombre</x-table.th>
        </x-slot>
        <x-slot name="rows">
            @foreach ($horarioForm->diasSemana as $item)
                <x-table.tr wire:key="{{ $item->dia_id }}">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        <x-input type="checkbox" wire:model="horarioForm.dias" value="{{ $item->dia_id }} " />
                    </th>
                    <x-table.td>{{ $item->nombre }}</x-table.td>
                </x-table.tr>
            @endforeach
        </x-slot>
    </x-table.table>
</div>
