<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Detalle del Tema
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p><strong>ID:</strong> {{ $subject->id }}</p>
                <p><strong>Nombre:</strong> {{ $subject->name }}</p>

                <div class="mt-4 flex gap-2">
                    <a href="{{ route('subjects.edit', $subject) }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Editar</a>
                    <a href="{{ route('subjects.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
