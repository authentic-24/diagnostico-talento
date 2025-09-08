<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <p><strong>Tema:</strong> {{ $evaluation->subject->name ?? '-' }}</p>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-4 sm:p-6">
                
                <p><strong>Estado:</strong>
                    @if ($evaluation->status === 'completed')
                        <span class="text-green-600 font-semibold">Completada</span>
                    @else
                        <span class="text-yellow-600 font-semibold">En progreso</span>
                    @endif
                </p>

                {{-- Aquí en el futuro se mostrarán las preguntas del ítem --}}
                <div class="mt-6">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
                    @php
                        $items = $evaluation->subject ? $evaluation->subject->items : collect();
                        $responses = $evaluation->status === 'completed' ? \App\Models\Response::where('evaluation_id', $evaluation->id)->get()->keyBy('question_id') : collect();
                        $itemIcons = [
                            'fa-layer-group', // Valores Organizacionales
                            'fa-star', // Principios de Experiencia
                            'fa-people-group', // Libertad y Colaboración
                            'fa-book-open', // Gestión del Conocimiento
                            'fa-chart-line', // Plan de Desarrollo
                            'fa-microchip', // Tecnología
                            'fa-user-astronaut', // Auto liderazgo
                            'fa-gift', // Beneficios
                            'fa-heart-pulse', // Bienestar y Salud Mental
                            'fa-dumbbell', // Salud Física y Flexibilidad
                        ];
                    @endphp
                    @if($evaluation->status !== 'completed')
                <form id="evaluationForm" action="{{ route('evaluations.submit', $evaluation) }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <h4 class="text-md font-bold mb-2">Guía de opciones de respuesta:</h4>
                                <ul class="list-disc pl-6 text-gray-700 text-sm">
                                    <li><strong>Casi nunca:</strong> Este nivel indica que la acción ocurre con muy poca frecuencia. Es un paso por encima de "Nunca," pero aún es extremadamente infrecuente.</li>
                                    <li><strong>Ocasionalmente:</strong> Este es el punto medio, donde la acción se produce, pero no de forma constante ni predecible. Refleja una frecuencia irregular.</li>
                                    <li><strong>Frecuentemente:</strong> En este nivel, la acción ocurre de forma habitual, más que esporádicamente, pero sin llegar a ser una constante total.</li>
                                    <li><strong>Constantemente:</strong> Este punto final indica que la acción o el comportamiento se produce en todas las ocasiones o de forma continua.</li>
                                </ul>
                            </div>
                            @forelse ($items as $iIndex => $item)
                                @php
                                    $color = $iIndex % 2 === 0 ? 'text-blue-700' : 'text-green-600';
                                    $icon = $itemIcons[$iIndex % count($itemIcons)];
                                @endphp
                                <div class="mb-10 pb-6 border-b border-gray-200">
                                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2 {{ $color }}">
                                        <span class="text-gray-400">{{ $iIndex+1 }}.</span>
                                        <i class="fa-solid {{ $icon }} {{ $color }}"></i>
                                        {{ $item->title }}
                                    </h3>
                                    @if(!empty($item->description))
                                        <div class="mb-4 text-gray-600 text-sm italic">
                                            {!! preg_replace(
                                                '/(?<!href=")https:\/\/yo-soy\.co\//',
                                                '<a href="https://yo-soy.co/" target="_blank" class="text-blue-600 underline">https://yo-soy.co/</a>',
                                                $item->description
                                            ) !!}
                                        </div>
                                    @endif
                                    <div class="grid gap-6">
                                    @forelse ($item->questions as $question)
                                        <div class="mb-0 p-4 sm:p-6 border rounded-lg bg-gray-50 shadow-sm">
                                            <label class="block font-medium text-gray-700 mb-3 flex items-center gap-2">
                                                {{-- <i class="fa-regular fa-circle-question text-indigo-500"></i> --}}
                                                <span class="break-words">
                                                    {!! preg_replace([
                                                        '/https:\/\/yo-soy\.co\//',
                                                        '/https:\/\/www\.docokids\.com/',
                                                        '/Empathica\.com\.co\/empresas/'
                                                    ], [
                                                        '<a href="https://yo-soy.co/" target="_blank" class="text-blue-600 underline">https://yo-soy.co/</a>',
                                                        '<a href="https://www.docokids.com" target="_blank" class="text-blue-600 underline">https://www.docokids.com</a>',
                                                        '<a href="https://empathica.com.co/iniciar-sesion" target="_blank" class="text-blue-600 underline">https://empathica.com.co/iniciar-sesion</a>'
                                                    ], $question->text) !!}
                                                </span>
                                                @if($question->required)
                                                    <span class="text-red-500">*</span>
                                                @endif
                                            </label>
                                            @if($question->type === 'radio')
                                                @php
                                                    $opts = is_array($question->options) ? $question->options : explode(',', $question->options);
                                                @endphp
                                                <div class="flex flex-col sm:flex-row flex-wrap gap-4 sm:gap-6 mt-2">
                                                    @foreach($opts as $option)
                                                        <label class="inline-flex items-center px-4 py-2 bg-white border rounded-lg shadow-sm hover:bg-blue-50 transition w-full sm:w-auto">
                                                            <input type="radio" name="responses[{{ $question->id }}]" value="{{ trim($option) }}" @if($question->required) required @endif>
                                                            <span class="ml-2 font-semibold text-gray-700">{{ trim($option) }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-gray-500">No hay preguntas para este ítem.</p>
                                    @endforelse
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">No hay ítems para este tema.</p>
                            @endforelse
                            
                            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-4">
                                <button type="button" id="openConfirmModal"
                                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-bold flex items-center gap-2 w-full sm:w-auto">
                                    <i class="fa-solid fa-paper-plane"></i> Enviar Evaluación
                                </button>
                            </div>
                        </form>
                        <!-- Modal de confirmación -->
                        <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
                                <h3 class="text-lg font-bold mb-4">¿Seguro que deseas enviar la evaluación?</h3>
                                <div class="flex justify-center gap-4 mt-6">
                                    <button id="cancelModalBtn" type="button" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold">Cancelar</button>
                                    <button id="confirmModalBtn" type="button" class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white font-bold">Sí, enviar</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    @push('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const openConfirmModal = document.getElementById('openConfirmModal');
                            const confirmModal = document.getElementById('confirmModal');
                            const cancelModalBtn = document.getElementById('cancelModalBtn');
                            const confirmModalBtn = document.getElementById('confirmModalBtn');
                            const evaluationForm = document.getElementById('evaluationForm');

                            openConfirmModal.addEventListener('click', function() {
                                // Validar que todos los campos requeridos estén respondidos
                                let valid = true;
                                let missing = [];
                                // Buscar todos los inputs radio requeridos
                                const requiredRadios = evaluationForm.querySelectorAll('input[type="radio"][required]');
                                const questionNames = Array.from(requiredRadios).map(r => r.name);
                                // Eliminar duplicados
                                const uniqueNames = [...new Set(questionNames)];
                                uniqueNames.forEach(name => {
                                    const checked = evaluationForm.querySelector(`input[name='${name}']:checked`);
                                    if (!checked) {
                                        valid = false;
                                        missing.push(name);
                                    }
                                });
                                if (!valid) {
                                    alert('Por favor responde todas las preguntas obligatorias antes de enviar la evaluación.');
                                    return;
                                }
                                confirmModal.classList.remove('hidden');
                            });
                            cancelModalBtn.addEventListener('click', function() {
                                confirmModal.classList.add('hidden');
                            });
                            confirmModalBtn.addEventListener('click', function() {
                                evaluationForm.submit();
                            });
                        });
                    </script>
                    @endpush
                    @else
                        @forelse ($items as $item)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-blue-700 mb-2">{{ $item->title }}</h3>
                                @forelse ($item->questions as $question)
                                    <div class="mb-4 p-4 border rounded-md bg-gray-50">
                                        <label class="block font-medium text-gray-700 mb-2">
                                            {{ $question->text }}
                                        </label>
                                        @php
                                            $response = $responses->has($question->id) ? $responses[$question->id]->value : null;
                                            $optionLabels = [4 => 'Totalmente de acuerdo', 3 => 'De acuerdo', 2 => 'En desacuerdo', 1 => 'Totalmente en desacuerdo'];
                                        @endphp
                                        <div class="mt-2">
                                            <span class="text-green-700 font-bold">Respuesta enviada:</span>
                                            <span class="ml-2 text-blue-700 font-semibold">{{ $optionLabels[$response] ?? '-' }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500">No hay preguntas para este ítem.</p>
                                @endforelse
                            </div>
                        @empty
                            <p class="text-gray-500">No hay ítems para este tema.</p>
                        @endforelse
                    @endif
                </div>

                <div class="mt-4 flex gap-4">
                    <a href="{{ route('evaluations.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md shadow border font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Volver al listado
                    </a>
                    @if($evaluation->status === 'completed')
                        <a href="{{ route('evaluations.results', $evaluation) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
                            Ver resultados
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
