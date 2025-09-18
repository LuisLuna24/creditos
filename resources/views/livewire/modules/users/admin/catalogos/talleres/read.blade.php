<div
    class="rounded-xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-1">

    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">{{ $nombre }}</h2>

        <div class="space-y-3">

            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-indigo-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-semibold mr-2">Docente:</span>
                <span>{{ $docente }}</span>
            </div>
        </div>

        <hr class="my-6">

        <div>
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-indigo-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-semibold">Horarios Programados</h3>
            </div>

            <div class="overflow-x-auto">
                <x-table.table>
                    <x-slot name="titles">
                        <x-table.th>No.</x-table.th>
                        <x-table.th>Hora inicio</x-table.th>
                        <x-table.th>Hora fin</x-table.th>
                        <x-table.th>Periodo</x-table.th>
                        <x-table.th>Lugares Disponibles</x-table.th>
                        <x-table.th>Estatus</x-table.th>
                        <x-table.th>Acciones</x-table.th>
                    </x-slot>
                    <x-slot name="rows">
                        @forelse ($horarios as $index => $item)
                            <x-table.tr>
                                <x-table.td>{{ $index + 1 }}</x-table.td>
                                <x-table.td>{{ $item->hora_inicio }}</x-table.td>
                                <x-table.td>{{ $item->hora_fin }}</x-table.td>
                                <x-table.td>{{ $item->periodo }}</x-table.td>

                                <x-table.td>
                                    @php
                                        $lugaresDisponibles = $item->cupo - $item->alumnos->count();
                                    @endphp

                                    @if ($lugaresDisponibles <= 0)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Sin lugares
                                        </span>
                                    @elseif ($lugaresDisponibles <= 5)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Últimos {{ $lugaresDisponibles }}
                                            {{ Str::plural('lugar', $lugaresDisponibles) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $lugaresDisponibles }} disponibles
                                        </span>
                                    @endif
                                </x-table.td>
                                <x-table.td>
                                    <x-toggle-switch :id="$item->horario_id" :checked="$item->estatus" :disabled="true"
                                        wireClick="statusRegister({{ $item->horario_id }})" />
                                </x-table.td>
                                <x-table.td-buttons>
                                    <x-table.button-table tipo="edit" wire:click="edit({{ $item->horario_id }})" />
                                    <x-table.button-table tipo="delete"
                                        wire:click="delete({{ $item->horario_id }})" />
                                </x-table.td-buttons>
                            </x-table.tr>
                        @empty
                            <x-table.empty-state cols="7" message="No hay horarios disponibles" />
                        @endforelse
                    </x-slot>
                </x-table.table>
            </div>
        </div>

    </div>
</div>
