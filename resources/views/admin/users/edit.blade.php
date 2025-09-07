<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Usuario
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" value="{{ old('name', $user->name) }}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Correo')" />
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" value="{{ old('email', $user->email) }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="empresa" :value="__('Empresa')" />
                        <x-text-input id="empresa" name="empresa" type="text" class="block mt-1 w-full" value="{{ old('empresa', $user->empresa) }}" required />
                        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="telefono" :value="__('Teléfono')" />
                        <x-text-input id="telefono" name="telefono" type="text" class="block mt-1 w-full" value="{{ old('telefono', $user->telefono) }}" required />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Rol')" />
                        <select id="role" name="role" class="block mt-1 w-full" required>
                            @foreach($roles as $role)
                                <option value="{{ $role }}" @if($user->hasRole($role)) selected @endif>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Contraseña temporal (opcional)')" />
                        <x-text-input id="password" name="password" type="text" class="block mt-1 w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <span class="text-xs text-gray-500">Si se ingresa, el usuario podrá iniciar sesión con esta contraseña.</span>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Guardar') }}
                        </x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="ms-4 underline text-sm text-gray-600 hover:text-gray-900">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
