<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Resultados de la Evaluación 
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
          
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-2">{{ $evaluation->subject->name ?? 'Rueda de la vida organizacional' }}</h3>
                <div class="flex justify-end mb-4">
                    <form id="exportPdfForm" method="POST" action="{{ route('evaluations.exportPdf', $evaluation->id) }}" target="_blank">
                        @csrf
                        <input type="hidden" name="labels" id="labelsInput">
                        <input type="hidden" name="data" id="dataInput">
                        <input type="hidden" name="chartImage" id="chartImageInput">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700 transition" id="exportPdfBtn">
                            <i class="fas fa-file-pdf mr-2 text-xl"></i>
                            Exportar PDF
                        </button>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var labels = @json($labels);
                            var data = @json($data);
                            document.getElementById('labelsInput').value = JSON.stringify(labels);
                            document.getElementById('dataInput').value = JSON.stringify(data);
                        });
                    </script>
                </div>
                <div class="flex justify-center items-center min-h-[300px] sm:min-h-[300px]">
                    <div class="w-full max-w-full sm:max-w-2xl mx-auto">
                        <div class="w-full h-56 sm:h-[320px]">
                            <canvas id="radarChart" class="w-full h-full" style="display: block; margin: auto;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="mt-0 flex flex-col gap-2">
                    @foreach($labels as $i => $label)
                        @php
                            $palette = ['#22c55e','#3b82f6','#f59e42','#ef4444','#a855f7','#eab308','#14b8a6','#6366f1','#f43f5e','#64748b'];
                            $color = $palette[$i % count($palette)];
                            $percent = isset($data[$i]) ? round(($data[$i] / 4) * 100) : 0;
                        @endphp
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-4 h-4 rounded-full" style="background-color:{{ $color }};"></span>
                            <span class="text-sm text-gray-700">{{ $label }}</span>
                            <span class="text-xs text-gray-500 font-semibold">{{ $percent }}%</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    <h4 class="font-semibold text-lg mb-2">Informe diagnóstico</h4>
                    <div class="prose prose-lg max-w-none">
                        @php
                            // Si la respuesta es JSON, extraer solo el campo 'text'
                            $text = $analysis;
                            if (is_string($analysis) && str_starts_with(trim($analysis), '{')) {
                                $json = json_decode($analysis, true);
                                if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                                    $text = $json['candidates'][0]['content']['parts'][0]['text'];
                                }
                            }
                            // Eliminar todos los asteriscos
                            $text = str_replace('*', '', $text);
                        @endphp
                        {!! nl2br(e($text)) !!}
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const labels = @json($labels);
                    const data = @json($data);
                    // Paleta de colores para los ítems
                    const palette = [
                        '#22c55e', // verde
                        '#3b82f6', // azul
                        '#f59e42', // naranja
                        '#ef4444', // rojo
                        '#a855f7', // morado
                        '#eab308', // amarillo
                        '#14b8a6', // teal
                        '#6366f1', // indigo
                        '#f43f5e', // rosa
                        '#64748b'  // gris
                    ];
                    const colors = labels.map((_, i) => palette[i % palette.length]);
                    const ctx = document.getElementById('radarChart').getContext('2d');
                    window.radarChartInstance = new Chart(ctx, {
                        type: 'radar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Promedio por ítem',
                                data: data,
                                backgroundColor: 'rgba(34,197,94,0.05)',
                                borderColor: 'rgba(34,197,94,1)',
                                borderWidth: 6,
                                pointBackgroundColor: colors,
                                pointBorderColor: colors
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: 120
                            },
                            plugins: {
                                legend: { position: 'bottom' },
                                title: { display: false }
                            },
                            scales: {
                                r: {
                                    min: 0,
                                    max: 4,
                                    ticks: { stepSize: 1 },
                                    pointLabels: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });

                    // --- Exportación con canvas temporal (comentado) ---
                    /*
                    document.getElementById('exportPdfForm').addEventListener('submit', function(e) {
                        e.preventDefault(); // Evitar envío inmediato
                        var form = this;
                        // Crear canvas temporal
                        var tempCanvas = document.createElement('canvas');
                        tempCanvas.width = 2400;
                        tempCanvas.height = 1800;
                        tempCanvas.style.display = 'none';
                        document.body.appendChild(tempCanvas);
                        var tempCtx = tempCanvas.getContext('2d');
                        var tempChart = new Chart(tempCtx, {
                            type: 'radar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Promedio por ítem',
                                    data: data,
                                    backgroundColor: 'rgba(34,197,94,0.05)',
                                    borderColor: 'rgba(34,197,94,1)',
                                    borderWidth: 16,
                                    pointBackgroundColor: labels.map((_, i) => palette[i % palette.length]),
                                    pointBorderColor: labels.map((_, i) => palette[i % palette.length])
                                }]
                            },
                            options: {
                                responsive: false,
                                maintainAspectRatio: false,
                                layout: { padding: 320 },
                                plugins: {
                                    legend: { position: 'bottom' },
                                    title: { display: false }
                                },
                                scales: {
                                    r: {
                                        min: 0,
                                        max: 4,
                                        ticks: { stepSize: 1 },
                                        pointLabels: { display: false }
                                    }
                                }
                            }
                        });
                        // Esperar a que se renderice y capturar imagen
                        setTimeout(function() {
                            var chartImage = tempCanvas.toDataURL('image/png');
                            document.getElementById('chartImageInput').value = chartImage;
                            tempChart.destroy();
                            tempCanvas.remove();
                            form.submit(); // Enviar el formulario manualmente
                        }, 900);
                    });
                    */
                    // --- Fin exportación con canvas temporal ---

                    // Exportación usando el canvas actual (activo)
                    document.getElementById('exportPdfForm').addEventListener('submit', function(e) {
                        e.preventDefault(); // Evitar envío inmediato
                        var form = this;
                        var canvas = document.getElementById('radarChart');
                        if (canvas) {
                            var chartImage = canvas.toDataURL('image/png');
                            document.getElementById('chartImageInput').value = chartImage;
                        }
                        form.submit(); // Enviar el formulario manualmente
                    });
                </script>
                

                
                </script>
                <div class="mt-6">
                    <a href="{{ route('evaluations.show', $evaluation) }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">Volver a la evaluación</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
