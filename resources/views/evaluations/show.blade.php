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
                    @endphp
                    @if($evaluation->status !== 'completed')
                        <form action="{{ route('evaluations.submit', $evaluation) }}" method="POST"
                              onsubmit="return confirm('¿Seguro que deseas enviar esta evaluación?')">
                            @csrf
                            @forelse ($items as $iIndex => $item)
                                <div class="mb-10 pb-6 border-b border-gray-200">
                                    <h3 class="text-xl font-bold text-blue-700 mb-4 flex items-center gap-2">
                                        <span class="text-gray-400">{{ $iIndex+1 }}.</span>
                                        <i class="fa-solid fa-layer-group text-blue-400"></i>
                                        {{ $item->title }}
                                    </h3>
                                    <div class="grid gap-6">
                                    @forelse ($item->questions as $question)
                                        <div class="mb-0 p-4 sm:p-6 border rounded-lg bg-gray-50 shadow-sm">
                                            <label class="block font-medium text-gray-700 mb-3 flex items-center gap-2">
                                                <i class="fa-regular fa-circle-question text-indigo-500"></i>
                                                <span class="break-words">{{ $question->text }}</span>
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
                                <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-bold flex items-center gap-2 w-full sm:w-auto">
                                    <i class="fa-solid fa-paper-plane"></i> Enviar Evaluación
                                </button>
                            </div>
                        </form>
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
