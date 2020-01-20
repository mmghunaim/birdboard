<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_task_belongs_to_a_project()
    {
        $task= factory('App\Task')->create();
        $this->assertInstanceOf(Project::class, $task->project);

    }
    /** @test **/
    public function a_task_has_a_path()
    {
        $this->withoutExceptionHandling();
        // $this->signIn();
        // $project= auth()->user()->projects()->create(factory('App\Project')->raw());
        // $this->post($project->path() . '/tasks', ['body'=> 'Task Test']);

        // $task= $project->tasks;

        $task= factory('App\Task')->create();

        // $this->assertEquals(
        //     '/projects/' . $task->project_id . '/tasks/' . $task->id , $task->path()
        // );

        $this->assertEquals(
            '/projects/' . $task->project->id . '/tasks/' . $task->id , $task->path()
        );
    }
}