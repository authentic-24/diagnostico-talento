<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Crear Tema
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.subjects.store') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                               required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona el prompt para análisis:</label>
                        <select name="evaluation_prompt_id" class="w-full border rounded p-2" required>
                            <option value="">-- Selecciona un prompt --</option>
                            @foreach($prompts as $prompt)
                                <option value="{{ $prompt->id }}">{{ Str::limit($prompt->prompt, 80) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona los items para este tema:</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach($items as $item)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="items[]" value="{{ $item->id }}" class="rounded">
                                    <span>{{ $item->title }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('admin.subjects.index') }}" class="text-gray-600">Cancelar</a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
