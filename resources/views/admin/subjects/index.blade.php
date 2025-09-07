<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Lista de Temas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Temas registrados</h3>
                    @if(auth()->user() && auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.subjects.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border" >
                            Nuevo Tema
                        </a>
                    @endif
                </div>

                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $subject)
                            <tr>
                                <td class="px-4 py-2 border">{{ $subject->id }}</td>
                                <td class="px-4 py-2 border">{{ $subject->name }}</td>
                                <td class="px-4 py-2 border flex gap-2">
                                    @if(auth()->user() && auth()->user()->hasRole('admin'))
                                        <a href="{{ route('admin.subjects.show', $subject) }}" class="text-blue-600" title="Ver"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.subjects.edit', $subject) }}" class="text-green-600" title="Editar"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este tema?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600" title="Eliminar"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">Solo admin</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No hay temas registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
