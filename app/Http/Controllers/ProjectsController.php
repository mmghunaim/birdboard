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
        // if (auth()->user()->isNot($project->owner)) {
        //     abort(403);
        // }

        abort_if(auth()->user()->isNot($project->owner), 403);

        return view('projects.show',['project'=> $project]);
    }

    public function store()
    {
        $attributes= request()->validate(
            [
                'title'=>'required',
                'description'=> 'required'
            ]);

        // $attributes['owner_id'] = auth()->id();

        auth()->user()->projects()->create($attributes);

        return redirect('/projects');
    }

    public function create()
    {
        return view('projects.create');
    }

}
