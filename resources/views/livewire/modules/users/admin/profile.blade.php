<div>
    <div class="container p-4 mx-auto md:p-8">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Configuración del Perfil</h1>
            <p class="text-gray-600 dark:text-slate-400">Actualiza tu información personal y de seguridad.</p>
        </header>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <aside class="lg:col-span-1">
                <div
                    class="p-6 text-center bg-white rounded-lg shadow-md dark:bg-slate-800 dark:border dark:border-slate-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $nombre }}</h2>
                    <p class="text-gray-500 dark:text-slate-400">{{ $correo }}</p>
                </div>
            </aside>

            <main class="space-y-8 lg:col-span-2">
                <form wire:submit="submitDataForm"
                    class="bg-white rounded-lg shadow-md dark:bg-slate-800 dark:border dark:border-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Información del Perfil</h3>
                        <div class="grid grid-cols-1 gap-6 mt-6">
                            <div class="flex flex-col gap-1">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-slate-300">Nombre Completo</label>
                                <x-input type="text" id="name" wire:model="name" />
                                <x-input-error for="name" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-slate-300">Correo</label>
                                <x-input type="email" id="email" wire:model="email" />
                                <x-input-error for="email" />
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-3 text-right bg-gray-50 rounded-b-lg dark:bg-slate-800/50">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar Cambios
                        </button>
                    </div>
                </form>

                <form wire:submit="submitPaswordChange"
                    class="bg-white rounded-lg shadow-md dark:bg-slate-800 dark:border dark:border-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Actualizar Contraseña</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-slate-400">Asegúrate de usar una contraseña
                            segura.</p>

                        <div class="grid grid-cols-1 gap-6 mt-6">
                            <div class="flex flex-col gap-1">
                                <label for="current_password"
                                    class="block text-sm font-medium text-gray-700 dark:text-slate-300">Contraseña
                                    Actual</label>
                                <x-input type="password" id="current_password" wire:model="current_password" />
                                <x-input-error for="current_password" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 dark:text-slate-300">Nueva
                                    Contraseña</label>
                                <x-input type="password" id="password" wire:model="password" />
                                <x-input-error for="password" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 dark:text-slate-300">Confirmar Nueva
                                    Contraseña</label>
                                <x-input type="password" id="password_confirmation"
                                    wire:model="password_confirmation" />
                                <x-input-error for="password_confirmation" />
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-3 text-right bg-gray-50 rounded-b-lg dark:bg-slate-800/50">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Actualizar Contraseña
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>
