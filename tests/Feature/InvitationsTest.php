<?php

namespace Tests\Feature;

use App\User;
use Tests\signIn;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function a_project_can_invite_a_user()
    {
        // $this->withoutExceptionHandling();

        //Given I have a Project
        $project =  ProjectFactory::create();

        //And I can invites another user
        $anotherUser = factory(User::class)->create();
        $project->invite($anotherUser);

        //Then, that user will have permission to add tasks
        $this->signIn($anotherUser);
        $this->post(action('ProjectTasksController@store', $project), $task = [
            'body' => 'Test Task'
        ]);

        $this->assertDatabaseHas('tasks', $task);
    }
}
