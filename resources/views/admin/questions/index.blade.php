<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			Preguntas
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white shadow-sm sm:rounded-lg p-6">
				<div class="flex justify-between mb-4">
					<h3 class="text-lg font-bold">Listado de Preguntas</h3>
					<a href="{{ route('admin.questions.create') }}"
						class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow border">
						<span class="material-icons text-white"></span>
						Crear Pregunta
					</a>
				</div>

				<table class="w-full border-collapse border">
					<thead>
						<tr class="bg-gray-100">
							<th class="px-4 py-2 border">ID</th>
							<th class="px-4 py-2 border">Texto</th>
							<th class="px-4 py-2 border">Tipo</th>
							<th class="px-4 py-2 border">Opciones</th>
							<th class="px-4 py-2 border">Orden</th>
							<th class="px-4 py-2 border">Requerida</th>
							<th class="px-4 py-2 border">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($questions as $question)
							<tr>
								<td class="px-4 py-2 border">{{ $question->id }}</td>
								<td class="px-4 py-2 border">{{ $question->text }}</td>
								<td class="px-4 py-2 border">{{ ucfirst($question->type) }}</td>
								<td class="px-4 py-2 border">{{ is_array($question->options) ? implode(', ', $question->options) : $question->options }}</td>
								<td class="px-4 py-2 border">{{ $question->order }}</td>
								<td class="px-4 py-2 border">
									@if ($question->required)
										<span class="text-green-600 font-semibold">Sí</span>
									@else
										<span class="text-gray-500">No</span>
									@endif
								</td>
								<td class="px-4 py-2 border">
									<a href="{{ route('admin.questions.edit', $question) }}" class="text-yellow-600 ml-2" title="Editar"><i class="fas fa-edit"></i></a>
									<form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="inline">
										@csrf
										@method('DELETE')
										<button type="submit" class="text-red-600 ml-2" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta pregunta?')"><i class="fas fa-trash"></i></button>
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="7" class="text-center py-4">No hay preguntas registradas</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</x-app-layout>
