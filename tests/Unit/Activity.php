<?php

namespace Tests\Unit;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Activity extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function activity_has_a_user()
    {
        $user = $this->signIn();
        $project = ProjectFactory::ownedBy($user)->create();

        $this->assertEquals($user->id, $project->activities->first()->user->id);
    }
}
