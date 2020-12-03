@extends('layouts.app')

@section('content')
	<div class="flex items-center mb-3">
		<a href="{{ url('/projects/create') }}">New Project</a>
	</div>

	<div class="flex">
		@forelse ($projects as $project)
			<div class="bg-white mr-4 p-4 rounded shadow w-1/3" style="height: 200px">
				<h1 class="font-semibold text-lg mb-4 py-4">{{ $project->title }}</h1>

				<div class="text-gray-700">{{ Illuminate\Support\Str::limit($project->description, 200) }}</div>
			</div>
		@empty
			<div>No Projects yet</div>
		@endforelse	
	</div>
@endsection