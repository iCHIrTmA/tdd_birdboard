@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
			<p class="text-gray-500 no-underline">
				<a href="{{ url('/projects')}}">My Projects</a> / {{ $project->title }}
			</p>

			<div class="flex items-center">
				@foreach($project->members as $member)
					<img 
						src="{{ asset('images/default-dog-avatar.png')}}" 
						alt="{{ $member->name }}'s avatar"
						class="rounded-full w-10 mr-1">
				@endforeach
						<img src="{{ asset('images/custom-cat-avatar.jpeg')}}" 
						alt="{{ $project->owner->name }}'s avatar"
						class="rounded-full w-10 mr-1">
						
			<a href="{{ url($project->path() . '/edit') }}" class="bg-blue-400 text-white no-underline rounded-lg shadow-lg text-sm py-3 px-4 ml-4">Edit Project</a>
			</div>
		</div>
	</header>

	<main>
		<div class="lg:flex -mx-3">
			<div class="lg:w-3/4 px-3 mb-6">
				<div class="mb-8">
					<h2 class="text-lg text-gray-500 font-medium mb-3">Tasks</h2>

					{{-- tasks --}}
					@foreach($project->tasks as $task)
						<div class="bg-white p-4 rounded-lg shadow mb-3">
							<form action="{{ url($task->path()) }}" method="POST">
								@method('PATCH')
								@csrf
								<div class="flex">
									<input name="body" value="{{ $task->body }}" class="font-medium w-full 
									{{ $task->completed ? 'text-gray-500' : '' }}">
									<input name="completed" type="checkbox" onChange="this.form.submit()" 
									{{ $task->completed ? 'checked' : '' }}>
								</div>
							</form>
						</div>
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
					<form method="POST" action="{{ url($project->path()) }}">
						@csrf
						@method('PATCH')

						<textarea
							name="notes" 
							class="bg-white p-4 rounded-lg shadow w-full mb-4 font-medium" 
							style="min-height: 200px"
							placeholder="Anything special you want to make note of?">
							{{ $project->notes}}
						</textarea>

						<button type="submit" class="bg-blue-400 text-white no-underline rounded-lg shadow-lg text-sm py-3 px-4">Save</button>
					</form>
					@include('projects._errors')
				</div>
			</div>

			<div class="lg:w-1/4 px-3 mt-6">
				@include('projects._card')
				@include('projects.activity._card')

				@can ('manage', $project)
					@include('projects._invite')
				@endcan
			</div>
		</div>		
	</main>
@endsection