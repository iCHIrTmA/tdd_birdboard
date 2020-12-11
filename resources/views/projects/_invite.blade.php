<div class="bg-white p-4 rounded-lg shadow flex flex-col mt-3">
	<h3 class="font-medium text-lg py-4 -ml-4 mb-3 border-l-4 border-blue-400 pl-3">
		Invite as User
	</h3>

	<form method="POST" action="{{ url($project->path()) . '/invitations' }}">
		@csrf

		<div class="mb-3">
			<input type="email" name="email" class="border border-grey-500 rounded w-full p-3" placeholder="Email address">
		</div>

		<button type="submit" class="button">Invite</button>
	</form>
	@include ('projects._errors', ['bag' => 'invitations'])
</div>