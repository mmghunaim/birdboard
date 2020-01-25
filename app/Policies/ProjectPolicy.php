<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Project $project)
    {
        //abort_if(auth()->user()->isNot($project->owner), 403); OR
        return $user->is($project->owner) || $project->members->contains($user);
    }
}
