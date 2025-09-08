<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Bienvenido, {{ Auth::user()->name }}</h3>
                    <p class="mb-4">Aquí puedes ver el estado de tus encuestas y evaluaciones.</p>
                    <hr class="mb-4">
                    <h4 class="text-md font-semibold mb-2">Tus evaluaciones recientes:</h4>
                    {{-- <canvas id="userEvaluationsChart" height="100"></canvas> --}}
                    @if(isset($evaluations) && $evaluations->count())
                        <ul class="list-disc ml-6 mt-6">
                            @foreach($evaluations->take(5) as $evaluation)
                                <li>
                                    <span class="font-medium">{{ $evaluation->subject->name ?? 'Sin materia' }}</span> - Estado: <span class="font-semibold">{{ ucfirst($evaluation->status) }}</span>
                                    <span class="ml-2">Puntaje: <span class="font-bold">{{ $evaluation->total_score ?? 'N/A' }}</span></span>
                                    <span class="ml-2 text-xs text-gray-500">{{ $evaluation->created_at->format('d/m/Y') }}</span>
                                    <a href="{{ route('evaluations.show', $evaluation) }}" class="text-indigo-600 underline ml-2">Ver</a>
                                    @if($evaluation->status === 'completed')
                                        <a href="{{ route('evaluations.results', $evaluation) }}" class="text-green-600 underline ml-2">Resultados</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No tienes evaluaciones registradas.</p>
                    @endif
                    <div class="mt-6">
                        <a href="{{ route('evaluations.create') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Iniciar nueva encuesta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('userEvaluationsChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($evaluations->take(5) as $evaluation)
                        '{{ $evaluation->subject->name ?? "Sin materia" }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Puntaje',
                    data: [
                        @foreach($evaluations->take(5) as $evaluation)
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
                        text: 'Puntaje de tus últimas evaluaciones'
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
    @endpush --}}
</x-app-layout>
