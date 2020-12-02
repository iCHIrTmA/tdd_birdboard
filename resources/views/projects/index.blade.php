@extends('layouts.app')

@section('content')
	<div class="flex items">
		<a href="{{ url('/projects/create') }}" class="mb: auto">New Project</a>
	</div>

	<ul>
		@forelse ($projects as $project)
			<li>
				<a href="{{ url($project->path()) }}">{{ $project->title }} </a>
			</li>
		@empty
			<li>No Projects yet</li>
		@endforelse
	</ul>
@endsection