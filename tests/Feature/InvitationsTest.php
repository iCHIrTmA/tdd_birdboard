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

    public function test_a_project_can_invite_a_user()
    {
    
    $project = ProjectTestFactory::create();

    $project->invite($newUser = factory(User::class)->create());

    $this->signIn($newUser);
    $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);
        
    $this->assertDatabaseHas('tasks', $task);       
    }
}
