<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test **/
    public function guests_connot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks', ['body'=> 'Task Test'])->assertRedirect('login');
    }
    /** @test **/
    public function only_the_owner_of_the_project_may_add_tasks()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks', ['body'=>'Test Task'])
        ->assertStatus(403);

        $this->assertDatabaseMissing('tasks',['body'=> 'Test Task']);
    }

    /** @test **/
    public function only_the_owner_of_the_project_may_update_tasks()
    {

        //you signed in
        $this->signIn();

        //we have a project you did not created
        // $project= factory('App\Project')->create();
        //and that project has a task
        // $task= $project->addTask('Test Update');

        //optimize the above
        $project = ProjectFactory::withTasks(1)->create();

        //and you want to edit that task
        $this->patch($project->tasks->first()->path(),
            [
                'body'=>'changed',
                'completed'=> true
            ])->assertStatus(403);
    }

    /** @test **/
    public function a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        // $project= auth()->user()->projects()
        // ->create(factory('App\Project')->raw());

        //optimize it 
        $project = ProjectFactory::create();
        // $project = factory('App\Project')->create(['owner_id'=> auth()->id()]);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body'=> 'Task Test']);

        // ->assertRedirect($project->path());
        $this->get($project->path())->assertSee('Task Test');
    }

    /** @test **/
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();
        // OR
        // $project = app(ProjectFactory::class)
        // ->ownedBy($this->signIn())
        // ->withTasks(1)
        // ->create();
        //OR
        //$project = new ProjectFactory;
        //$project =$project->ownedBy($this->signIn())->withTasks()->create();

        // $this->signIn();
        // $project= auth()->user()->projects()
        // ->create(factory('App\Project')->raw());
        // $task= $project->addTask('test task');

        $this->actingAs($project->owner)
        ->patch($project->tasks->first()->path(),[
            'body'=>'changed'
        ]);

        $this->assertDatabaseHas('tasks',
            [
                'body'=>'changed'
            ]);
    }

    /** @test **/
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
        ->patch($project->tasks->first()->path(),[
            'body'=>'changed',
            'completed'=> true
        ]);

        $this->assertDatabaseHas('tasks',
            [
                'body'=>'changed',
                'completed'=>true
            ]);
    }

    /** @test **/
    public function a_task_can_be_incompleted()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
        ->patch($project->tasks->first()->path(),[
            'body'=>'changed',
            'completed'=> true
        ]);

        $this->actingAs($project->owner)
        ->patch($project->tasks->first()->path(),[
            'body'=>'changed',
            'completed'=> false
        ]);

        $this->assertDatabaseHas('tasks',
            [
                'body'=>'changed',
                'completed'=>false
            ]);
    }

    /** @test **/
    public function a_taks_require_a_body()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $attributes = factory('App\Task')->raw(['body'=>'']);

        $this->actingAs($project->owner)->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
    

}
