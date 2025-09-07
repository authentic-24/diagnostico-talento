
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Nuevo Ítem
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.items.store') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3" required></textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Orden</label>
                        <input type="number" name="order" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="1" required>
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('admin.items.index') }}" class="text-gray-600">Cancelar</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
                            Crear Ítem
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
