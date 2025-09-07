<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Nueva Evaluación
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if($subjects->count() > 0)
                    <form action="{{ route('evaluations.store') }}" method="POST">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Selecciona un tema</label>
                            <select name="subject_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 flex justify-end gap-2">
                            <a href="{{ route('evaluations.index') }}" class="text-gray-600">Cancelar</a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
                                Crear Evaluación
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-8 text-gray-500">
                        No hay temas disponibles para evaluar. Ya has realizado todas las evaluaciones posibles.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
