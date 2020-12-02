@extends('layouts.app')
@section('content')
	<div style="display: flex; align-items: center;">
		<h1 style="margin-right: auto;">Birdboard</h1>
		<a href="{{ url('/projects/create') }}">New Project</a>
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