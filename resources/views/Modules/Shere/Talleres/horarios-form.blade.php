<div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">

    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Configurar Horario del Taller</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Define las fechas, horas y días en que se impartirá el
            taller.</p>
    </div>

    <hr class="my-6 border-gray-200 dark:border-gray-700">

    <div class="space-y-8">
        <section>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Duración y Fechas</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Establece el rango en que el taller estará activo.</p>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-1">
                    <label for="dia_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Día de
                        inicio</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><svg
                                class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                            </svg></div>
                        <x-input type="date" wire:model="horarioForm.dia_inicio" id="dia_inicio" class="!pl-10 w-full" />
                    </div>
                    <x-input-error for="horarioForm.dia_inicio" />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="dia_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Día de
                        fin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><svg
                                class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                            </svg></div>
                        <x-input type="date" wire:model="horarioForm.dia_fin" id="dia_fin" class="!pl-10 w-full" />
                    </div>
                    <x-input-error for="horarioForm.dia_fin" />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="hora_inicio"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hora de inicio</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><svg
                                class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <x-input type="time" wire:model="horarioForm.hora_inicio" id="hora_inicio" class="!pl-10 w-full" />
                    </div>
                    <x-input-error for="horarioForm.hora_inicio" />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="hora_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hora
                        de fin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><svg
                                class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <x-input type="time" wire:model="horarioForm.hora_fin" id="hora_fin" class="!pl-10 w-full" />
                    </div>
                    <x-input-error for="horarioForm.hora_fin" />
                </div>
            </div>
        </section>

        <section>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Días de la Semana</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Selecciona los días en que se impartirá la clase.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                @foreach ($horarioForm->diasSemana as $item)
                    <label wire:key="{{ $item->dia_id }}" class="cursor-pointer">
                        <input type="checkbox" wire:model="horarioForm.dias" value="{{ $item->dia_id }}"
                            class="sr-only peer">
                        <span
                            class="block px-4 py-2 rounded-lg text-sm font-semibold border
                                     bg-gray-100 text-gray-700 border-gray-200
                                     dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600
                                     transition-colors duration-200
                                     peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600">
                            {{ $item->nombre }}
                        </span>
                    </label>
                @endforeach
            </div>
            <x-input-error for="horarioForm.dias" class="mt-2" />
        </section>

        <section>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Detalles Adicionales</h3>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-1">
                    <label for="periodo"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Período</label>
                    <x-input wire:model="horarioForm.periodo" id="periodo" placeholder="Ej. 2025/1" />
                    <x-input-error for="horarioForm.periodo" />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="cupo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cupo
                        máximo de alumnos</label>
                    <x-input type="number" wire:model="horarioForm.cupo" id="cupo" placeholder="Ej. 25" />
                    <x-input-error for="horarioForm.cupo" />
                </div>
            </div>
        </section>
    </div>
</div>
