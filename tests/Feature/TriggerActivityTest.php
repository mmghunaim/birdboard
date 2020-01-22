<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function creating_a_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    /** @test **/
    public function updating_a_project()
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
    public function creating_a_task()
    {
        $project = ProjectFactory::create();

        $task = $project->addTask('Task Created');

        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    /** @test **/
    public function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body'=> 'foobar',
            'completed'=> true
        ]);

        $this->assertCount(4, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }


    /** @test **/
    public function incompleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $task = $project->tasks[0];

        $this->actingAs($project->owner)
        ->patch($task->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(4, $project->activity);

        $this->patch($task->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $activities = $project->fresh()->activity;

        $this->assertCount(5, $activities);

        $this->assertEquals('incompleted_task', $activities->last()->description);   
    }

    /** @test **/
    public function deleting_a_task()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();

        $task = $project->tasks[0];

        $this->assertCount(2, $project->activity);

        $this->assertEquals('created_task', $project->activity->last()->description);

        $this->actingAs($project->owner)
            ->delete($task->path(), [
                'id' => $task->id
            ]);

        $this->assertCount(3, $project->fresh()->activity);    

    }
    
}
