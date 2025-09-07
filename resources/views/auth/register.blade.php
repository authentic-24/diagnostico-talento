<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="'Nombre completo'" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ingrese su nombre" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!-- Empresa -->
        <div class="mt-4">
            <x-input-label for="empresa" :value="'Empresa'" />
            <x-text-input id="empresa" class="block mt-1 w-full" type="text" name="empresa" :value="old('empresa')" required autocomplete="organization" placeholder="Nombre de la empresa" />
            <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="'Teléfono'" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autocomplete="tel" placeholder="Ejemplo: 999999999" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Correo electrónico -->
        <div class="mt-4">
            <x-input-label for="email" :value="'Correo electrónico'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Contraseña'" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Ingrese una contraseña" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Confirmar contraseña'" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Repita la contraseña" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Políticas -->
        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" name="politicas" required class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <span class="ml-2 text-sm text-gray-600">
                    Acepto las <a href="{{ route('politicas') }}" class="underline text-blue-600" target="_blank">Políticas de Privacidad</a> y <a href="{{ route('politicas') }}" class="underline text-blue-600" target="_blank">Términos de Uso</a>.
                </span>
            </label>
            <x-input-error :messages="$errors->get('politicas')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                ¿Ya tienes una cuenta? Inicia sesión
            </a>

            <x-primary-button class="ms-4">
                Registrarse
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
