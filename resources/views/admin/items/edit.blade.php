<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Ítem
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.items.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="title" value="{{ $item->title }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3" required>{{ $item->description }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Orden</label>
                        <input type="number" name="order" value="{{ $item->order }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="1" required>
                    </div>
                    {{-- <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Asignar a Subject</label>
                        <select name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Selecciona --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" @if($item->subject_id == $subject->id) selected @endif>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('admin.items.index') }}" class="text-gray-600">Cancelar</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
                            Actualizar Ítem
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
