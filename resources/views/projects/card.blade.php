<div class="bg-white p-4 rounded-lg shadow" style="height: 200px">
	<h3 class="font-medium text-lg py-4 -ml-4 mb-3 border-l-4 border-blue-400 pl-3">
		<a href="{{ url($project->path()) }}">{{ $project->title }}</a>
	</h3>

	<div class="text-gray-500">{{ Illuminate\Support\Str::limit($project->description, 50) }}</div>
</div>
