<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Tema
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ $subject->name }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                               required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona el prompt para análisis:</label>
                        <select name="evaluation_prompt_id" class="w-full border rounded p-2" required>
                            <option value="">-- Selecciona un prompt --</option>
                            @foreach(App\Models\EvaluationPrompt::where('active', 1)->get() as $prompt)
                                <option value="{{ $prompt->id }}" @if($subject->evaluation_prompt_id == $prompt->id) selected @endif>{{ Str::limit($prompt->prompt, 80) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('admin.subjects.index') }}" class="text-gray-600">Cancelar</a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
