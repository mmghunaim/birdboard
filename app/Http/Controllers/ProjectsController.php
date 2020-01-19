<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
class ProjectsController extends Controller
{
    public function index()
    {
        // $projects= Project::all();
        $projects = auth()->user()->projects;
        // ->skip(2)->take(3);

        return view('projects.index', ['projects'=> $projects]);
    }

    public function show(Project $project)
    {
        // abort_if(auth()->user()->isNot($project->owner), 403);
        $this->authorize('update', $project);
        return view('projects.show',['project'=> $project]);
    }

    public function store()
    {
        // $attributes= $this->validateRequest();
        // dd($attributes);
        // $attributes['owner_id'] = auth()->id();
        $project= auth()->user()->projects()->create($this->validateRequest());
        return redirect($project->path());
    }

    public function create()
    {
        return view('projects.create');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', ['project' => $project]);
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $attributes= $this->validateRequest();

        $project->update($attributes);

        return redirect($project->path());
    }


    public function validateRequest()
    {
        return request()->validate(
            [
                'title'=>'required',
                'description'=> 'required|max:80',
                'notes'=>'min:3|max:255'
            ]
        );
    }

}
