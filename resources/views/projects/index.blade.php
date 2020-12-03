@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
			<h2 class="text-gray-500 no-underline">My Projects</h2>

			<a href="{{ url('/projects/create') }}" class="bg-blue-400 text-white no-underline rounded-lg shadow-lg text-sm py-3 px-4">New Project</a>
		</div>
	</header>

	<main class="lg:flex lg:flex-wrap -mx-3">
		@forelse ($projects as $project)
			<div class="lg:w-1/3 px-3 pb-6">
				@include('projects.card')
			</div>
		@empty
			<div>No Projects yet</div>
		@endforelse	
	</main>
@endsection