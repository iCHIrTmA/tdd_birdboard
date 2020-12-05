<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectTestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;
    public function test_creating_a_project_records_activity()
    {
        $project = ProjectTestFactory::create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    public function test_updating_a_project_records_activity()
    {
        $project = ProjectTestFactory::create();
        
        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);        
        $this->assertEquals('updated', $project->activity->last()->description);        
    }

    public function test_creating_a_new_task_records_project_activity()
    {
        $project = ProjectTestFactory::create();

        $project->addTask('Some task');

        $this->assertCount(2, $project->activity);        
        $this->assertEquals('created_task', $project->activity->last()->description);        
    }

    public function test_completing_a_new_task_records_project_activity()
    {
        $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body'      => 'foobar',
            'completed' => true, 
        ]);

        $this->assertCount(3, $project->activity);        
        $this->assertEquals('completed_task', $project->activity->last()->description);        
    }
}
