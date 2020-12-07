<div class="bg-white p-4 rounded-lg shadow mt-3">
	<ul class="text-sm">
		@foreach ($project->activity as $activity)
			<li class="{{ $loop->last ? '' : 'mb-2' }}"> 
				@include ("projects.activity._{$activity->description}")
				<span class="text-gray-500">{{ $activity->created_at->diffForHumans(null, true) }}</span>
			</li>
		@endforeach
	</ul>
</div>