<div class="max-w-2xl p-8 mx-auto bg-gray-900 rounded-lg shadow-xl text-gray-200">

    <h2 class="text-2xl font-bold mb-6 text-center">Datos del alumno</h2>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="saveAlumno">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="flex flex-col gap-1 col-span-2">
                <label for="matricula" class="block mb-2 text-sm font-medium">Matricula</label>
                <x-input type="number" id="matricula" wire:model="matricula" />
                @error('matricula')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="nombre" class="block mb-2 text-sm font-medium">Nombre(s)</label>
                <x-input type="text" id="nombre" wire:model="nombre" />
                @error('nombre')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="a_paterno" class="block mb-2 text-sm font-medium">Apellido Paterno</label>
                <x-input type="text" id="a_paterno" wire:model="a_paterno" />
                @error('a_paterno')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="a_materno" class="block mb-2 text-sm font-medium">Apellido Materno</label>
                <x-input type="text" id="a_materno" wire:model="a_materno" />
                @error('a_materno')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="carrera_id" class="block mb-2 text-sm font-medium">Carrera</label>
                <x-select id="carrera_id" wire:model="carrera_id">
                    <option value="" disabled>-- Seleccione una carrera --</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->carrera_id }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </x-select>
                @error('carrera_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="semestre" class="block mb-2 text-sm font-medium">Semestre</label>
                <x-select id="semestre" wire:model="semestre">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}º Semestre</option>
                    @endfor
                </x-select>
                @error('semestre')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium">Sexo</label>
                <div class="flex items-center space-x-6 mt-2">
                    <label class="flex items-center">
                        <x-input type="radio" name="sexo" value="M" wire:model="sexo"
                            class="text-blue-600 focus:ring-blue-500" />
                        <span class="ml-2 text-sm text-gray-700">Masculino</span>
                    </label>
                    <label class="flex items-center">
                        <x-input type="radio" name="sexo" value="F" wire:model="sexo"
                            class="text-pink-600 focus:ring-pink-500" />
                        <span class="ml-2 text-sm text-gray-700">Femenino</span>
                    </label>
                </div>
                @error('sexo')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-8 text-right">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition ease-in-out duration-150">
                <span wire:loading.remove wire:target="saveAlumno">
                    Guardar Alumno
                </span>
                <span wire:loading wire:target="saveAlumno">
                    Guardando...
                </span>
            </button>
        </div>
    </form>
</div>
