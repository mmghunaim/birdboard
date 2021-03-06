<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        // $this->withoutExceptionHandling();
        $project = factory('App\\Project')->create();

        $this->assertEquals('/projects/'.$project->id, $project->path());
    }

    /** @test **/
    public function it_belongs_to_an_owner()
    {
        $project = factory('App\Project')->create();

        $this->assertInstanceOf('App\User', $project->owner);
    }

    /** @test **/
    public function it_can_add_task()
    {
        // $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $task = $project->addTask('Test Task');

        $this->assertTrue($project->tasks->contains($task));
    }

    /** @test **/
    public function it_can_invite_a_user()
    {
        $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $project->invite($user = factory('App\User')->create());

        $this->assertTrue($project->members->contains($user));
    }
}
