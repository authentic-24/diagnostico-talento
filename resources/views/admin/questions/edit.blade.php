<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			Editar Pregunta
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white shadow-sm sm:rounded-lg p-6">
				<form action="{{ route('admin.questions.update', $question) }}" method="POST">
					@csrf
					@method('PUT')
					<div>
						<label class="block text-sm font-medium text-gray-700">Ítem al que pertenece</label>
						<select name="item_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
							<option value="">-- Selecciona --</option>
							@foreach($items as $item)
								<option value="{{ $item->id }}" @if($question->item_id == $item->id) selected @endif>{{ $item->title }}</option>
							@endforeach
						</select>
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Texto de la pregunta</label>
						<input type="text" name="text" value="{{ old('text', $question->text) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Tipo</label>
						<select name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
							<option value="">-- Selecciona --</option>
							<option value="text" @if($question->type == 'text') selected @endif>Texto</option>
							<option value="select" @if($question->type == 'select') selected @endif>Selección</option>
							<option value="radio" @if($question->type == 'radio') selected @endif>Opción única</option>
							<option value="checkbox" @if($question->type == 'checkbox') selected @endif>Múltiple</option>
						</select>
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Opciones (separadas por coma, solo para select/radio/checkbox)</label>
						<input type="text" name="options" value="{{ old('options', is_array($question->options) ? implode(', ', $question->options) : $question->options) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Orden</label>
						<input type="number" name="order" value="{{ old('order', $question->order) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="1" required>
					</div>
					<div class="mt-4">
						<label class="inline-flex items-center">
							<input type="checkbox" name="required" value="1" class="rounded" @if($question->required) checked @endif>
							<span class="ml-2 text-sm text-gray-700">¿Requerida?</span>
						</label>
					</div>
					<div class="mt-4 flex justify-end gap-2">
						<a href="{{ route('admin.questions.index') }}" class="text-gray-600">Cancelar</a>
						<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
							Guardar Cambios
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</x-app-layout>
