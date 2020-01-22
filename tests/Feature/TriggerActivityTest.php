<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TriggeractivitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function creating_a_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activities);
        $this->assertEquals('created_project', $project->activities[0]->description);
    }

    /** @test **/
    public function updating_a_project()
    {
        $project = ProjectFactory::create();

        {
            // $project->update(['title' => 'changed']); OR

            $this->actingAs($project->owner)->patch($project->path(), ['title'=> 'changed']);
        }

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated_project', $project->activities->last()->description);
    }

    /** @test **/
    public function creating_a_task()
    {
        $project = ProjectFactory::create();

        $task = $project->addTask('Task Created');

        $this->assertCount(2, $project->activities);

        tap($task->activities->last(), function($activities){
            $this->assertEquals('created_task', $activities->description);
            $this->assertInstanceOf(Task::class, $activities->subject);
            $this->assertEquals('Task Created', $activities->subject->body);
        });

        $this->assertEquals('created_task', $project->activities->last()->description);
    }

    /** @test **/
    public function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body'=> 'foobar',
            'completed'=> true
        ]);

        $this->assertCount(4, $project->activities);
        $this->assertEquals('completed_task', $project->activities->last()->description);
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

        $this->assertCount(4, $project->activities);

        $this->patch($task->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $activities = $project->fresh()->activities;

        $this->assertCount(5, $activities);

        $this->assertEquals('incompleted_task', $activities->last()->description);   
    }

    /** @test **/
    public function deleting_a_task()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();

        $task = $project->tasks[0];

        // $this->actingAs($project->owner)
        //     ->delete($task->path(), [
        //         'id' => $task->id
        //     ]);

        $task->delete();

        $this->assertCount(3, $project->fresh()->activities);    

    }
    
}
