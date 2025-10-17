<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">

    <header class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Gestión de Alumnos del Horario
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Taller: <span class="font-medium">{{ $horario->taller->nombre ?? 'Nombre del Taller' }}</span> |
            Período: <span class="font-medium">{{ $horario->periodo ?? '2025/1' }}</span>
        </p>
    </header>

    <div class="p-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-4">
            <div class="w-full sm:max-w-xs">
            </div>
            <div class="flex items-center gap-x-3 w-full sm:w-auto">

                <x-button wire:click="confirmarLiberarCreditos('selected')" :disabled="!count($alumnosSeleccionados)"
                    class="w-full justify-center !bg-indigo-600 hover:!bg-indigo-700 disabled:opacity-50 disabled:bg-gray-400 disabled:cursor-not-allowed">
                    Liberar a Seleccionados ({{ count($alumnosSeleccionados) }})
                </x-button>

                <x-danger-button wire:click="confirmarLiberarCreditos('all')" class="w-full justify-center">
                    Liberar a Todos
                </x-danger-button>

            </div>
        </div>

        <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
            <x-table.table>
                <x-slot name="titles">
                    <x-table.th class="w-12">
                        <x-input type="checkbox" wire:model.live="seleccionarTodos" />
                    </x-table.th>
                    <x-table.th>Matrícula</x-table.th>
                    <x-table.th>Nombre del Alumno</x-table.th>
                    <x-table.th>Carrera</x-table.th>
                    <x-table.th class="text-center">Estado del Crédito</x-table.th>
                    <x-table.th class="text-center">Acciones</x-table.th>
                </x-slot>
                <x-slot name="rows">
                    @forelse ($alumnos as $item)
                        <x-table.tr wire:key="alumno-{{ $item->alumno_id }}"
                            class="{{ in_array($item->alumno_id, $alumnosSeleccionados) ? 'bg-indigo-50 dark:bg-gray-900' : '' }}">
                            <x-table.td>
                                <x-input type="checkbox" wire:model.live="alumnosSeleccionados"
                                    value="{{ $item->alumno_id }}" />
                            </x-table.td>
                            <x-table.td
                                class="font-mono text-sm">{{ $item->alumno->matricula ?? $item->alumno_id }}</x-table.td>
                            <x-table.td
                                class="font-medium text-gray-800 dark:text-gray-200">{{ $item->alumno->user->name }}</x-table.td>
                            <x-table.td class="font-mono text-sm">{{ $item->alumno->carrera->nombre }}</x-table.td>

                            <x-table.td class="text-center">
                                @php
                                    // Verifica si la colección de créditos del alumno contiene uno que coincida con el horario_id actual.
                                    $esLiberado = $item->alumno->creditos->contains('horario_id', $item->horario_id);
                                @endphp

                                <span @class([
                                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' => $esLiberado,
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' => !$esLiberado,
                                ])>
                                    {{ $esLiberado ? 'Liberado' : 'Pendiente' }}
                                </span>
                            </x-table.td>
                            <x-table.td-buttons>
                                @if (!$esLiberado)
                                    <x-table.button-table tipo="delete"
                                        wire:click="deleteAlumno({{ $item->horario_alumno_id }})" />
                                @endif
                            </x-table.td-buttons>
                        </x-table.tr>
                    @empty
                        <x-table.empty-state cols="6" message="No hay alumnos inscritos en este horario." />
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </div>

    <x-dialog-modal wire:model="showConfirmModal">
        <x-slot name="title">
            <h2 class="text-center">Liberar creditos</h2>
        </x-slot>
        <x-slot name="content">
            <p class="text-center">Para liberar los créditos, coloque su contraseña.</p>
            <form wire:submit="liberarCreditos">
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
                    <x-danger-button wire:click="$set('showConfirmModal',false)"
                        wire:loading.attr="disabled">Cancelar</x-danger-button>
                    <x-button class="ml-3" wire:loading.attr="disabled" wire:target="liberarCreditos">
                        <span wire:loading.remove wire:target="liberarCreditos">
                            Liberar
                        </span>
                        <span wire:loading wire:target="liberarCreditos">
                            Procesando...
                        </span>
                    </x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="deleteModalAlumno">
        <x-slot name="title">
            <h2 class="text-center">Dar de baja al alumno</h2>
        </x-slot>
        <x-slot name="content">
            <p class="text-center">¿Desea dar de baja al alumno del horario?</p>
            <form wire:submit="deleteAlumnoSubmit">
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
                    <x-danger-button wire:click="$set('deleteModalAlumno', false)" wire:loading.attr="disabled">
                        Cancelar
                    </x-danger-button>

                    <x-button class="ml-3" wire:loading.attr="disabled" wire:target="deleteAlumnoSubmit">
                        <span wire:loading.remove wire:target="deleteAlumnoSubmit">
                            Dar de Baja
                        </span>
                        <span wire:loading wire:target="deleteAlumnoSubmit">
                            Procesando...
                        </span>
                    </x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
