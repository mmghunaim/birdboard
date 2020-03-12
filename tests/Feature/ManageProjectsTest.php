<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    /** @test */
    public function guests_connot_manage_projects()
    {
        $project = factory('App\Project')->create();

        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path().'/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->delete($project->path())->assertRedirect('login');
    }

    /** @test **/
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get('projects/create')->assertStatus(200);

        $attributes = [
            'title'=> $this->faker->sentence,
            'description'=> $this->faker->sentence,
            'notes'=> 'General notes here.',
        ];
        // $attributes= factory(Project::class)->raw(['owner_id' => auth()->id()]);

        // $project= auth()->user()->projects()->create(factory('App\Project')->raw());
        // $attributes= factory('App\\Project')->raw();

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        // $this->post('/projects',$project->toArray())->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        // $this->get('/projects')->assertSee($project['title']);
        $this->get($project->path())
        ->assertSee($project['title'])
        ->assertSee($project['description'])
        ->assertSee($project['notes']);
    }

    /** @test */
    public function tasks_can_be_included_as_part_of_a_new_project_creation()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw();

        $attributes['tasks'] = [
            ['body' => 'Task 1'],
            ['body' => 'Task 2'],
        ];

        $this->post('/projects', $attributes);

        $this->assertCount(2, Project::first()->tasks);
    }

    /** @test **/
    public function a_user_can_update_a_project()
    {
        // $this->signIn();

        // $project= factory('App\Project')->create(['owner_id'=> auth()->id()]);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path().'/edit')->assertOk();

        $this->actingAs($project->owner)
            ->patch($project->path(), $atts = [
                'title'=> 'title changed',
                'description'=> 'description changed',
                'notes'=> 'new notes',
            ])
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $atts);
    }

    /** @test **/
    public function a_user_can_update_a_project_general_note()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $atts = ['notes'=> 'new notes']);

        $this->assertDatabaseMissingseHas('projects', $atts);
    }

    /** @test **/
    public function a_user_can_see_projects_they_have_been_invited_to_on_thier_dashboard()
    {
        $user = $this->signIn();

        $project = tap(ProjectFactory::create())->invite($user);

        $this->get('/projects')->assertSee($project->title);
    }

    /** @test **/
    public function unauthorized_cannot_delete_projects()
    {
        $project = ProjectFactory::create();

        $this->signIn();

        $this->delete($project->path())->assertStatus(403);
    }

    /** @test **/
    public function a_invited_user_cannot_delete_the_project()
    {
        $project = ProjectFactory::create();
        $user = factory('App\User')->create();

        $project->invite($user);

        $this->actingAs($user)
            ->delete($project->path())
            ->assertStatus(403);
    }

    /** @test **/
    public function a_user_can_delete_the_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test **/
    public function a_user_can_view_their_project()
    {
        // $this->signIn();

        // $project= factory('App\Project')->create(['owner_id'=> auth()->id()]);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->get($project->path())->assertSee($project->title);
    }

    /** @test **/
    public function an_authenticated_user_connot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test **/
    public function an_authenticated_user_connot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test **/
    public function a_project_require_a_title()
    {
        $this->signIn();

        $attributes = factory('App\\Project')->raw(['title'=>'']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test **/
    public function a_project_require_a_description()
    {
        $this->signIn();

        $attributes = factory('App\\Project')->raw(['description'=>'']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
