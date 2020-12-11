<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectTestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_owners_may_not_invite_users()
    {    	
    	$this->actingAs(factory(User::class)->create())
    		->post(ProjectTestFactory::create()->path() . '/invitations')
    		->assertStatus(403);
    }

    public function test_a_project_owner_can_invite_a_user()
    {	
    	$project = ProjectTestFactory::create();

    	$userToInvite = factory(User::class)->create();

    	$this->actingAs($project->owner)
    		->post($project->path() . '/invitations', [
    			'email' => $userToInvite->email
    		])
    		->assertRedirect($project->path());

    	$this->assertTrue($project->members->contains($userToInvite));
    }

    public function test_the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
    	$project = ProjectTestFactory::create();

    	$this->actingAs($project->owner)
    		->post($project->path() . '/invitations', [
    			'email' => 'notauser@example.com',
    		])
    		->assertSessionHasErrors([
    			'email' => 'The user you are inviting must have a Birdboard account.',
    		]);
    }

    public function test_invited_users_may_update_project_details()
    {    
	    $project = ProjectTestFactory::create();

	    $project->invite($newUser = factory(User::class)->create());

	    $this
	    	->actingAs($newUser)
	    	->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);
	        
	    $this->assertDatabaseHas('tasks', $task);       
    }
}
