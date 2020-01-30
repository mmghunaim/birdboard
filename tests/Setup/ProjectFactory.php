<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $tasksCount = 0;

    protected $user;

    //Using of Fluent APIs, What a magic is this!!

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function create()
    {
        $project = factory(Project::class)->create([
            // factory(User::class)->create()->id is equivalent to factory(User::class)
            'owner_id' => $this->user ?? factory(User::class),
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id,
        ]);

        return $project;
    }
}
