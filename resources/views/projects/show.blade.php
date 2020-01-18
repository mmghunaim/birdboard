@extends('layouts.app') 

@section('content')

<header class="flex items-center mb-3 py-4 px-1 ">

    <div class="flex justify-between w-full items-end">

        <div class="text-gray-600">
            <a href="/projects" class="no-underline text-gray-600 font-normal">My Projects</a> / {{ $project->title }}
        </div>

        <div>
            <a href="/projects/create" class="button">Create New Project</a>
        </div>

    </div>

</header>

<main>

    <div class="lg:flex -mx-3">

        <div class="lg:w-3/4 px-3 mb-6">
            {{-- tasks --}}
            <div class="mb-8">
                <h2 class="text-gray-600 text-lg mb-3">Tasks</h2>
                <div class="card mb-3">Lorem ipsum.</div>
                <div class="card mb-3">Lorem ipsum.</div>
                <div class="card mb-3">Lorem ipsum.</div>
                <div class="card mb-3">Lorem ipsum.</div>
                <div class="card">Lorem ipsum.</div>
            </div>
            {{--general notes--}}
            <div>
                <h2 class="text-gray-600 text-lg mb-3">General Notes</h2>
                <textarea class="card w-full" style="min-height: 200px">Lorem ipsum.</textarea>
            </div>
        </div>

        <div class="lg:w-1/4 px-3">
            @include('projects.card')
        </div>

    </div>

</main>


@endsection