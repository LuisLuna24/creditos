<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">

    <header class="p-6 border-b border-gray-200 dark:border-gray-700">
        <span
            class="inline-block bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 text-xs font-semibold px-2.5 py-1 rounded-full mb-2">
            {{-- $tipo ?? 'Taller General' --}} Taller Cultural
        </span>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $nombre }}</h2>
        <p class="mt-2 flex items-center gap-x-2 text-sm text-gray-600 dark:text-gray-400">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                    clip-rule="evenodd" />
            </svg>
            <span>Impartido por: <strong>{{ $docente }}</strong></span>
        </p>
    </header>

    <div class="p-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-4">
            <div>
                <label for="perEstatus" class="sr-only">Filtrar por Estatus</label>
                <x-select wire:model.live="perEstatus" id="perEstatus" class="!py-2">
                    <option value="1">Ver Activos</option>
                    <option value="2">Ver Inactivos</option>
                </x-select>
            </div>
            <div>
                <x-button wire:click="create" class="w-full sm:w-auto">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    <span>Nuevo Horario</span>
                </x-button>
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
            <x-table.table>
                <x-slot name="titles">
                    <x-table.th>No.</x-table.th>
                    <x-table.th>Horario</x-table.th>
                    <x-table.th>Periodo</x-table.th>
                    <x-table.th>Lugares</x-table.th>
                    <x-table.th>Estatus</x-table.th>
                    <x-table.th class="text-center">Acciones</x-table.th>
                </x-slot>
                <x-slot name="rows">
                    @forelse ($horarios as $index => $item)
                        <x-table.tr wire:key="horario-{{ $item->horario_id }}">
                            <x-table.td>{{ $index + 1 }}</x-table.td>
                            <x-table.td>
                                {{ \Carbon\Carbon::parse($item->hora_inicio)->format('g:i A') }} -
                                {{ \Carbon\Carbon::parse($item->hora_fin)->format('g:i A') }}
                            </x-table.td>
                            <x-table.td>{{ $item->periodo }}</x-table.td>
                            <x-table.td>
                                @php($lugaresDisponibles = $item->cupo - $item->alumnos->count())
                                @if ($lugaresDisponibles <= 0)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Sin
                                        lugares</span>
                                @elseif ($lugaresDisponibles <= 5)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Últimos
                                        {{ $lugaresDisponibles }}</span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">{{ $lugaresDisponibles }}
                                        disponibles</span>
                                @endif
                            </x-table.td>
                            <x-table.td>
                                <x-toggle-switch :id="$item->horario_id" :checked="$item->estatus" :disabled="true"
                                    wireClick="statusRegister({{ $item->horario_id }})" />
                            </x-table.td>
                            <x-table.td-buttons>
                                <x-table.button-table tipo="view" wire:click="view({{ $item->horario_id }})" />
                                <x-table.button-table tipo="edit" wire:click="edit({{ $item->horario_id }})" />
                                <x-table.button-table tipo="delete" wire:click="delete({{ $item->horario_id }})" />
                            </x-table.td-buttons>
                        </x-table.tr>
                    @empty
                        <x-table.empty-state cols="6" message="No hay horarios programados para este taller." />
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>

        @if ($horarios->hasPages())
            <div class="mt-4">
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
</div>
