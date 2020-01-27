<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectInvitationRequest;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project,  ProjectInvitationRequest $request)
    {
        //TODO
        //if a user invite another user with no account in birdboard, 
        //we will fire an email with invitaion ... for more details back to ep33

        // $user = User::whereEmail(request('email'));

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}