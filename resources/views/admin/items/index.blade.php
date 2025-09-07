
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Ítems
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Listado de Ítems</h3>
                    <a href="{{ route('admin.items.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
                        <span class="material-icons text-white"></span>
                        Crear Ítem
                    </a>
                </div>

                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Título</th>
                            <th class="px-4 py-2 border">Descripción</th>
                            <th class="px-4 py-2 border">Orden</th>
                            <th class="px-4 py-2 border">Creador</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td class="px-4 py-2 border">{{ $item->id }}</td>
                                <td class="px-4 py-2 border">{{ $item->title }}</td>
                                <td class="px-4 py-2 border">{{ $item->description }}</td>
                                <td class="px-4 py-2 border">{{ $item->order }}</td>
                                <td class="px-4 py-2 border">{{ $item->creator->name ?? '-' }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('admin.items.show', $item) }}" class="text-blue-600" title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.items.edit', $item) }}" class="text-yellow-600 ml-2" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este ítem?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No hay ítems registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
