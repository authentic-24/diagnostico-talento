<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Crear Prompt</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.prompts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-2">Texto del Prompt</label>
                        <textarea name="prompt" rows="8" class="w-full border rounded p-2" required></textarea>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Guardar</button>
                    <a href="{{ route('admin.prompts.index') }}" class="ml-4 text-gray-600 underline">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
