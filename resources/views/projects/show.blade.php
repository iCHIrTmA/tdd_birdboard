@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
			<p class="text-gray-500 no-underline">
				<a href="{{ url('/projects')}}">My Projects</a> / {{ $project->title }}
			</p>

			<a href="{{ url('/projects/create') }}" class="bg-blue-400 text-white no-underline rounded-lg shadow-lg text-sm py-3 px-4">New Project</a>
		</div>
	</header>

	<main>
		<div class="lg:flex -mx-3">
			<div class="lg:w-3/4 px-3 mb-6">
				<div class="mb-8">
					<h2 class="text-lg text-gray-500 font-medium mb-3">Tasks</h2>

					{{-- tasks --}}
					@foreach($project->tasks as $task)
						<div class="bg-white p-4 rounded-lg shadow mb-3">{{ $task->body }}</div>
					@endforeach

					<div class="bg-white p-4 rounded-lg shadow mb-3">
						<form action="{{ url($project->path() . '/tasks')}}" method="POST">
							@csrf
							<input placeholder="Add a new task" class="w-full" name="body">
						</form>
					</div>
				</div>

				<div>
					<h2 class="text-lg text-gray-500 font-medium mb-3">General Notes</h2>

					{{-- general notes --}}
					<textarea class="bg-white p-4 rounded-lg shadow w-full" style="min-height: 200px">Lorem ipsum</textarea>
				</div>
			</div>

			<div class="lg:w-1/4 px-3">
				@include('projects.card')
			</div>
		</div>		
	</main>



@endsection