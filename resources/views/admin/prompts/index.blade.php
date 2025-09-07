<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Gestión de Prompts</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('admin.prompts.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
                    <i class="fa-solid fa-plus"></i> Nuevo Prompt
                </a>
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Prompt</th>
                            <th class="px-4 py-2 border">Activo</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prompts as $prompt)
                        <tr>
                            <td class="px-4 py-2 border">{{ $prompt->id }}</td>
                            <td class="px-4 py-2 border text-xs">{{ Str::limit($prompt->prompt, 100) }}</td>
                            <td class="px-4 py-2 border">{{ $prompt->active ? 'Sí' : 'No' }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('admin.prompts.edit', $prompt) }}" class="bg-blue-600 text-white px-2 py-2 rounded hover:bg-blue-700 mr-2 inline-block" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @if($prompt->active)
                                <form action="{{ route('admin.prompts.deactivate', $prompt) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-600 text-white px-2 py-2 rounded hover:bg-red-700 inline-block" title="Desactivar">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.prompts.activate', $prompt) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white px-2 py-2 rounded hover:bg-green-700 inline-block" title="Activar">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
