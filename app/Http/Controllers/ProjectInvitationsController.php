<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use App\Mail\SendInvitaion;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationRequest $request)
    {
        //TODO
        //if a user invite another user with no account in birdboard,
        //we will fire an email with invitaion ... for more details back to ep33

        // $user = User::whereEmail(request('email'));

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

//        Mail::to(request('email'))->send(new SendInvitaion($project));

        return redirect($project->path());
    }
}
