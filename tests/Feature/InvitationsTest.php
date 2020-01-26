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
    public function non_owners_connot_invite_a_user()
    {
        $project =  ProjectFactory::create();
        $user = factory(User::class)->create();

        $assertInvitaionForbidden = function() use ($user, $project)
        {
            $this->actingAs($user)
            ->post(action('ProjectInvitationsController@store', $project))
            ->assertStatus(403);
        };

        $assertInvitaionForbidden();

        $project->invite($user);

        $assertInvitaionForbidden(); 
    }

    /** @test **/
    public function a_project_owner_can_invite_a_user()
    {
        // $this->withoutExceptionHandling();
        $project =  ProjectFactory::create();

        $invitedUser = factory(User::class)->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $invitedUser->email
            ])->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($invitedUser));
    }

    /** @test **/
    public function the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        // $this->withoutExceptionHandling();
        $project =  ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notvalidemail@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a Birdboard account.'
            ], null, 'invitations');
    }

    /** @test **/
    public function invited_users_can_invite_a_user()
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
