<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Administración de Usuarios
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 flex gap-2">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nombre o empresa" class="border rounded px-3 py-2 w-64" />
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Buscar</button>
                </form>
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Correo</th>
                            <th class="px-4 py-2 border">Empresa</th>
                            <th class="px-4 py-2 border">Teléfono</th>
                            <th class="px-4 py-2 border">Rol</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-4 py-2 border">{{ $user->id }}</td>
                                <td class="px-4 py-2 border">{{ $user->name }}</td>
                                <td class="px-4 py-2 border">{{ $user->email }}</td>
                                <td class="px-4 py-2 border">{{ $user->empresa }}</td>
                                <td class="px-4 py-2 border">{{ $user->telefono }}</td>
                                <td class="px-4 py-2 border">{{ $user->getRoleNames()->first() }}</td>
                                <td class="px-4 py-2 border flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-600" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No hay usuarios registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
