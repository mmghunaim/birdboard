<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
class ProjectsController extends Controller
{
    public function index()
    {
        // $projects= Project::all();
        $projects = auth()->user()->allProjects();
        // ->skip(2)->take(3);

        return view('projects.index', ['projects'=> $projects]);
    }

    public function show(Project $project)
    {
        // abort_if(auth()->user()->isNot($project->owner), 403);
        $this->authorize('update', $project);
        return view('projects.show',['project'=> $project]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        // $attributes= $this->validateRequest();
        // dd($attributes);
        // $attributes['owner_id'] = auth()->id();
        $project= auth()->user()->projects()->create($this->validateRequest());
        if (request()->wantsJson()) {
            return ['message' => $project->path()];
        }
        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', ['project' => $project]);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('manage', $project);

        $project->delete();

        return redirect('/projects');
    }

    public function validateRequest()
    {
        return request()->validate(
            [
                'title'=>'sometimes|required',
                'description'=> 'sometimes|required|max:80',
                'notes'=>'nullable|max:255'
            ]
        );
    }
}
