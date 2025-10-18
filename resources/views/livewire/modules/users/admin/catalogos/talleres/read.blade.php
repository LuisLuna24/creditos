<div class="p-4 sm:p-6 lg:p-8 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-6">

        <header class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $nombre }}</h1>
            <div class="flex items-center mt-2 text-gray-600 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500 dark:text-indigo-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-semibold mr-1">Docente a cargo:</span>
                <span>{{ $docente }}</span>
            </div>
        </header>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">

            <div class="p-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <label for="perEstatus" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filtrar por
                        estatus:</label>
                    <x-select wire:model.live="perEstatus" id="perEstatus" class="w-40">
                        <option value="1">Activos</option>
                        <option value="2">Inactivos</option>
                    </x-select>
                </div>
                <x-button wire:click="create">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Nuevo Horario</span>
                </x-button>
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
                        <x-table.th class="text-center">Acciones</x-table.th>
                    </x-slot>
                    <x-slot name="rows">
                        @forelse ($horarios as $index => $item)
                            <x-table.tr>
                                <x-table.td>{{ $index + 1 }}</x-table.td>
                                <x-table.td>{{ \Carbon\Carbon::parse($item->hora_inicio)->format('g:i A') }}</x-table.td>
                                <x-table.td>{{ \Carbon\Carbon::parse($item->hora_fin)->format('g:i A') }}</x-table.td>
                                <x-table.td>{{ $item->periodo }}</x-table.td>
                                <x-table.td>
                                    @php
                                        $lugaresDisponibles = $item->cupo - $item->alumnos->count();
                                    @endphp
                                    <span @class([
                                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' =>
                                            $lugaresDisponibles <= 0,
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' =>
                                            $lugaresDisponibles > 0 && $lugaresDisponibles <= 5,
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' =>
                                            $lugaresDisponibles > 5,
                                    ])>
                                        @if ($lugaresDisponibles <= 0)
                                            Sin lugares
                                        @elseif ($lugaresDisponibles <= 5)
                                            Últimos {{ $lugaresDisponibles }}
                                            {{ Str::plural('lugar', $lugaresDisponibles) }}
                                        @else
                                            {{ $lugaresDisponibles }} disponibles
                                        @endif
                                    </span>
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
            </div>

            @if ($horarios->hasPages())
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $horarios->onEachSide(1)->links() }}
                </div>
            @endif
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
                                <x-table.td>{{ $item->alumno->user->name }}</x-table.td>
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
</div>
