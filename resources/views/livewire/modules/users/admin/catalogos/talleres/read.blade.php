<div class="rounded-xl shadow-lg overflow-hidden">

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

            <div class="overflow-x-auto space-y-3">
                <div class="flex justify-between">
                    <div class="flex flex-col gap-1 max-w-xl">
                        <label for="perEstatus">Estatus:</label>
                        <x-select wire:model.change="perEstatus" id="perEstatus">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </x-select>
                    </div>
                    <div class="flex flex-col justify-end">
                        <x-button wire:click="create">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Nuevo</span>
                        </x-button>
                    </div>
                </div>
                <x-table.table>
                    <x-slot name="titles">
                        <x-table.th>No.</x-table.th>
                        <x-table.th>Hora inicio</x-table.th>
                        <x-table.th>Hora fin</x-table.th>
                        <x-table.th>Periodo</x-table.th>
                        <x-table.th>Lugares Disponibles</x-table.th>
                        <x-table.th>Estatus</x-table.th>
                        <x-table.th class="text-center">Acciones</x-table.th>
                    </x-slot>
                    <x-slot name="rows">
                        @forelse ($horarios as $index => $item)
                            <x-table.tr>
                                <x-table.td>{{ $index + 1 }}</x-table.td>
                                <x-table.td>
                                    {{ \Carbon\Carbon::parse($item->hora_inicio)->format('g:i A') }}
                                </x-table.td>

                                <x-table.td>
                                    {{ \Carbon\Carbon::parse($item->hora_fin)->format('g:i A') }}
                                </x-table.td>
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
                                    <x-table.button-table tipo="view" wire:click="view({{ $item->horario_id }})" />
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
                <div>
                    {{ $horarios->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <h2 class="text-center">Elimnar Registro</h2>
        </x-slot>
        <x-slot name="content">
            <p class="text-center">¿Desea eliminar este carrera?</p>
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

    <x-dialog-modal wire:model="estatusModal">
        <x-slot name="title">
            <h2 class="text-center">Cambiar estatus del registro</h2>
        </x-slot>
        <x-slot name="content">
            <p class="text-center">¿Desea cambiar el estatus de esta carrera?</p>
            <form wire:submit="estatusSubmit">
                <div class="flex justify-around mt-5">
                    <x-danger-button wire:click="$set('estatusModal',false)">Cancelar</x-danger-button>
                    <x-button>Guardar</x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="modalForm">
        <x-slot name="title">
            <h2 class="text-center">{{ $typeForm == 1 ? 'Crear' : 'Editar' }} Registro</h2>
        </x-slot>
        <x-slot name="content">
            <form wire:submit="submitForm">
                @include('Modules.Shere.Talleres.horarios-form')
                <div class="flex justify-around mt-5">
                    <x-danger-button wire:click="$set('modalForm',false)">Cancelar</x-danger-button>
                    <x-button>Guardar</x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="modalView">
        <x-slot name="title">
            <h2 class="text-center">Alumnos registrados</h2>
        </x-slot>
        <x-slot name="content">
            <x-table.table>
                <x-slot name="titles">
                    <x-table.th>No.</x-table.th>
                    <x-table.th>Matricula</x-table.th>
                    <x-table.th>Nombre</x-table.th>
                </x-slot>
                <x-slot name="rows">
                    @forelse ($alumnos as $index => $item)
                        <x-table.tr>
                            <x-table.td>{{ $index + 1 }}</x-table.td>
                            <x-table.td>{{ $item->alumno_id }}</x-table.td>
                            <x-table.td>{{ $item->alumnos->user->name }}</x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.empty-state cols="3" message="No hay alumnos disponibles" />
                    @endforelse
                </x-slot>
            </x-table.table>
            <div>
                {{ $alumnos->onEachSide(1)->links() }}
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="closeView">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
