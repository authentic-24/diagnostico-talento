<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			Crear Pregunta
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white shadow-sm sm:rounded-lg p-6">
				<form action="{{ route('admin.questions.store') }}" method="POST">
					@csrf
					<div>
						<label class="block text-sm font-medium text-gray-700">Ítem al que pertenece</label>
						<select name="item_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
							<option value="">-- Selecciona --</option>
							@foreach($items as $item)
								<option value="{{ $item->id }}">{{ $item->title }}</option>
							@endforeach
						</select>
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Texto de la pregunta</label>
						<input type="text" name="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Tipo</label>
						<select name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
							<option value="">-- Selecciona --</option>
							<option value="text">Texto</option>
							<option value="select">Selección</option>
							<option value="radio">Opción única</option>
							<option value="checkbox">Múltiple</option>
						</select>
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Opciones (separadas por coma, solo para select/radio/checkbox)</label>
						<input type="text" name="options" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
					</div>
					<div class="mt-4">
						<label class="block text-sm font-medium text-gray-700">Orden</label>
						<input type="number" name="order" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="1" required>
					</div>
					<div class="mt-4">
						<label class="inline-flex items-center">
							<input type="checkbox" name="required" value="1" class="rounded">
							<span class="ml-2 text-sm text-gray-700">¿Requerida?</span>
						</label>
					</div>
					<div class="mt-4 flex justify-end gap-2">
						<a href="{{ route('admin.questions.index') }}" class="text-gray-600">Cancelar</a>
						<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
							Guardar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</x-app-layout>
