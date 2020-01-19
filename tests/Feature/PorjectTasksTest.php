<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PorjectTasksTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test **/
    public function a_project_can_have_tasks()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();

        $project= auth()->user()->projects()
                ->create(factory('App\Project')->raw());

        // $project = factory('App\Project')->create(['owner_id'=> auth()->id()]);

        $this->post($project->path() . '/tasks', ['body'=> 'Test Task']);

        $this->get($project->path())->assertSee('Task Test');
    }

    /** @test **/
    public function a_taks_require_a_body()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id'=> auth()->id()]);

        $attributes = factory('App\Task')->raw(['body'=>'']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
    
}
