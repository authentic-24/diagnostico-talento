<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Mis Evaluaciones
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Evaluaciones realizadas</h3>
                          <a href="{{ route('evaluations.create') }}"
                              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
                        Nueva Evaluación
                    </a>
                </div>

                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Tema</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($evaluations as $evaluation)
                            <tr>
                                <td class="px-4 py-2 border">{{ $evaluation->id }}</td>
                                <td class="px-4 py-2 border">{{ $evaluation->subject->name ?? '-' }}</td>
                                <td class="px-4 py-2 border">
                                    @if ($evaluation->status === 'completed')
                                        <span class="text-green-600 font-semibold">Completada</span>
                                    @else
                                        <span class="text-yellow-600 font-semibold">En progreso</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border flex gap-2">
                                    <a href="{{ route('evaluations.show', $evaluation) }}" class="text-blue-600" title="Ver"><i class="fas fa-eye"></i></a>
                                    @if ($evaluation->status === 'completed')
                                        <a href="{{ route('evaluations.results', $evaluation) }}" class="text-green-600" title="Resultados"><i class="fas fa-chart-bar"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No tienes evaluaciones registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
