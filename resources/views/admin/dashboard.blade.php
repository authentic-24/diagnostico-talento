<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administración
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-6">Resumen General</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-indigo-50 p-6 rounded shadow flex items-center">
                            <i class="fa-solid fa-users text-indigo-600 text-3xl mr-4"></i>
                            <div>
                                <div class="text-2xl font-bold">{{ $usersCount }}</div>
                                <div class="text-gray-700">Usuarios registrados</div>
                            </div>
                        </div>
                        <div class="bg-green-50 p-6 rounded shadow flex items-center">
                            <i class="fa-solid fa-book text-green-600 text-3xl mr-4"></i>
                            <div>
                                <div class="text-2xl font-bold">{{ $subjectsCount }}</div>
                                <div class="text-gray-700">Subjects creados</div>
                            </div>
                        </div>
                        <div class="bg-blue-50 p-6 rounded shadow flex items-center">
                            <i class="fa-solid fa-clipboard-list text-blue-600 text-3xl mr-4"></i>
                            <div>
                                <div class="text-2xl font-bold">{{ $evaluationsCount }}</div>
                                <div class="text-gray-700">Evaluaciones totales</div>
                            </div>
                        </div>
                        <div class="bg-yellow-50 p-6 rounded shadow flex items-center">
                            <i class="fa-solid fa-check-circle text-yellow-600 text-3xl mr-4"></i>
                            <div>
                                <div class="text-2xl font-bold">{{ $completedCount }}</div>
                                <div class="text-gray-700">Evaluaciones completadas</div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-6 rounded shadow flex items-center">
                            <i class="fa-solid fa-spinner text-gray-600 text-3xl mr-4"></i>
                            <div>
                                <div class="text-2xl font-bold">{{ $inProgressCount }}</div>
                                <div class="text-gray-700">Evaluaciones en progreso</div>
                            </div>
                        </div>
                        <div class="bg-purple-50 p-6 rounded shadow flex items-center">
                            <i class="fa-solid fa-star text-purple-600 text-3xl mr-4"></i>
                            <div>
                                <div class="text-2xl font-bold">{{ $avgScore ? number_format($avgScore,2) : 'N/A' }}</div>
                                <div class="text-gray-700">Promedio general</div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h4 class="font-semibold mb-2">Últimos usuarios registrados</h4>
                            <ul class="divide-y divide-gray-200">
                                @foreach($latestUsers as $user)
                                    <li class="py-2 flex justify-between items-center">
                                        <span>{{ $user->name }} <span class="text-xs text-gray-500">({{ $user->empresa }})</span></span>
                                        <span class="text-gray-500 text-xs">{{ $user->created_at->format('d/m/Y') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('admin.users.index') }}" class="text-indigo-600 underline mt-2 inline-block">Ver todos los usuarios</a>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Últimos subjects creados</h4>
                            <ul class="divide-y divide-gray-200">
                                @foreach($latestSubjects as $subject)
                                    <li class="py-2 flex justify-between items-center">
                                        <span>{{ $subject->name }}</span>
                                        <span class="text-gray-500 text-xs">{{ $subject->created_at->format('d/m/Y') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('admin.subjects.index') }}" class="text-green-600 underline mt-2 inline-block">Ver todos los subjects</a>
                        </div>
                    </div>
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-semibold">Últimas evaluaciones</h4>
                            <a href="{{ route('admin.export.evaluations') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                <i class="fa-solid fa-file-excel mr-2"></i> Exportar a Excel
                            </a>
                        </div>
                        <canvas id="evaluationsChart" height="100"></canvas>
                        <table class="w-full border-collapse border mt-6">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Usuario</th>
                                    <th class="px-4 py-2 border">Subject</th>
                                    <th class="px-4 py-2 border">Estado</th>
                                    <th class="px-4 py-2 border">Puntaje</th>
                                    <th class="px-4 py-2 border">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestEvaluations as $evaluation)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $evaluation->id }}</td>
                                        <td class="px-4 py-2 border">{{ $evaluation->evaluator->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $evaluation->subject->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ ucfirst($evaluation->status) }}</td>
                                        <td class="px-4 py-2 border">{{ $evaluation->total_score ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $evaluation->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @push('scripts')
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('evaluationsChart').getContext('2d');
                        const chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [
                                    @foreach($latestEvaluations as $evaluation)
                                        '{{ $evaluation->subject->name ?? "N/A" }}',
                                    @endforeach
                                ],
                                datasets: [{
                                    label: 'Puntaje',
                                    data: [
                                        @foreach($latestEvaluations as $evaluation)
                                            {{ $evaluation->total_score ?? 0 }},
                                        @endforeach
                                    ],
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { display: false },
                                    title: {
                                        display: true,
                                        text: 'Puntaje de las últimas evaluaciones'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
