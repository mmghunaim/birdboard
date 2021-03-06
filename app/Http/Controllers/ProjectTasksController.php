<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate([
            'body'=> 'required',
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

        $task->update(request()->validate(['body'=> 'required']));

        // $method = request('completed') ? 'complete' : 'incomplete';

        // $task->$method();
        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($project->path());
    }

    public function delete(Project $project, Task $task)
    {
        $this->authorize('update', $task->project);
        $task->delete();
    }
}
