<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectTestFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_has_projects()
	{
		$user = factory('App\User')->create();

		$this->assertInstanceOf(Collection::class, $user->projects);
	}

	public function test_a_user_has_accessible_projects()
	{
		$john = $this->signIn();

		ProjectTestFactory::ownedBy($john)->create();

		$this->assertCount(1, $john->accessibleProjects());

		$sally = factory(User::class)->create();
		$nick = factory(User::class)->create();

		$project = tap(ProjectTestFactory::ownedBy($sally)->create())->invite($nick);

		$this->assertCount(1, $john->accessibleProjects());

		$project->invite($john);

		$this->assertCount(2, $john->accessibleProjects());		
	}
}
