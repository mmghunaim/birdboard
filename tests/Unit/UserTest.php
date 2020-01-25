<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\User;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function a_user_has_projects()
    {

        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test **/
    public function a_user_has_all_projects()
    {
        $john = $this->signIn();

        ProjectFactory::ownedBy($john)->create();

        $this->assertCount(1, $john->allProjects());

        $sally = factory(User::class)->create();
        $jeff = factory(User::class)->create();

        $sallyProject = ProjectFactory::ownedBy($sally)->create();

        $sallyProject->invite($jeff);

        $this->assertCount(1, $john->allProjects());

        $sallyProject->invite($john);

        $this->assertCount(2, $john->allProjects());
    }
}
