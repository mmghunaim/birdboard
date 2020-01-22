<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function creating_a_project_records_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    /** @test **/
    public function updating_a_project_records_activity()
    {
        $project = ProjectFactory::create();

        {
            // $project->update(['title' => 'changed']); OR

            $this->actingAs($project->owner)->patch($project->path(), ['title'=> 'changed']);
        }

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }

    /** @test **/
public function creating_a_task_records_activity()
{
    $project = ProjectFactory::create();

    $task = $project->addTask('Task Created');

    $this->assertCount(2, $project->activity);
    $this->assertEquals('created_task', $project->activity->last()->description);
}

    /** @test **/
    public function complete_a_task_records_activity()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body'=> 'foobar',
            'completed'=> true
        ]);

        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }

    
}
