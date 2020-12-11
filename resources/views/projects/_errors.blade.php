@if ($errors->{ $bag ?? 'default' }->any())
	<ul class="field mt-4 list-reset">
			@foreach ($errors->{ $bag ?? 'default' }->all() as $error)
				<li class="text-sm font-medium text-red-700">{{ $error }}</li>
			@endforeach
	</ul>
@endif