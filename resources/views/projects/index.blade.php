@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-center w-full">
			<h2 class="text-gray-500 no-underline">My Projects</h2>

			<a href="{{ url('/projects/create') }}" class="bg-blue-400 text-white no-underline rounded-lg shadow-lg text-sm py-3 px-4">New Project</a>
		</div>
	</header>

	<main class="lg:flex lg:flex-wrap -mx-3">
		@forelse ($projects as $project)
			<div class="lg:w-1/3 px-3 pb-6">
				<div class="bg-white p-4 rounded-lg shadow" style="height: 200px">
					<h3 class="font-medium text-lg py-4 -ml-4 mb-3 border-l-4 border-blue-400 pl-3">
						<a href="{{ url($project->path()) }}">{{ $project->title }}</a>
					</h3>

					<div class="text-gray-700">{{ Illuminate\Support\Str::limit($project->description, 50) }}</div>
				</div>
			</div>
		@empty
			<div>No Projects yet</div>
		@endforelse	
	</main>
@endsection