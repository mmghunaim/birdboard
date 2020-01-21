<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('update', $project);
        
        request()->validate([
            'body'=> 'required'
        ]);

        //There is two ways to add tasks to specific Project
        //First one through the relation between proejct and tasks BUT we must passed an array
        //$project->tasks()->create(request('body'));
        
        //Last one by use a created method
        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $task->project);

        request()->validate(['body'=> 'required']);
        
        $task->update([
            'body'=> request('body'),
            'completed'=> request()->has('completed')
        ]);

        return redirect($project->path());
    }
}
