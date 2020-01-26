@extends('layouts.app') 

@section('content')

<header class="flex items-center mb-3 py-4 px-1 ">

    <div class="flex justify-between w-full items-end">

        <p class="text-gray-600 text-sm font-normal">
            <a href="/projects" class="no-underline text-gray-600 font-normal">My Projects</a> / {{ $project->title }}
        </p>

        <div class="flex items-center">
            @foreach ($project->members as $member)
            <img 
            src="{{ gravatar_url($member->email) }}"
            alt="{{ $member->name }}'s avatar"
            class="rounded-full w-8 mr-2">
            @endforeach

            <img 
            src="{{ gravatar_url($project->owner->email) }}?s=60"
            alt="{{ $project->owner->name }}'s avatar"
            class="rounded-full w-8 mr-2">

            <a href="{{ $project->path() . '/edit' }}" class="button ml-4">Edit Project</a>
        </div>

    </div>

</header>

<main>

    <div class="lg:flex -mx-3">

        <div class="lg:w-3/4 px-3 mb-6">
            {{-- tasks --}}
            <div class="mb-8">
                <h2 class="text-gray-600 text-lg mb-3">Tasks</h2>
                @foreach($project->tasks as $task)
                <div class="card mb-3">
                    <form method="POST" action="{{ $task->path() }}">
                        @method('PATCH')
                        @csrf
                        <div class="flex justify-between">
                            <input type="text" name="body" class="w-full {{ $task->completed ? 'text-gray-600': ''}}"
                            value="{{ $task->body }}">
                            <input type="checkbox" name="completed" onChange="this.form.submit()" 
                            {{ $task->completed ? 'checked': '' }}>
                        </div>
                    </form>

                </div>
                @endforeach

                <form method="POST" action="{{ $project->path() .'/tasks' }}">
                    @csrf
                    <div class="card">
                        <input type="text" name="body" placeholder="Add tasks now..." class="w-full">
                    </div>
                </form>
            </div>
            {{--general notes--}}
            <div>
                <h2 class="text-gray-600 text-lg mb-3" >General Notes</h2>
                <form method="POST" action="{{ $project->path() }}">
                    @method('PATCH')
                    @csrf

                    <textarea 
                    name="notes" 
                    class="card w-full mb-4" 
                    style="min-height: 200px" 
                    placeholder="Anything special that you want to make a note of">
                    {{ $project->notes }}
                </textarea>
                <button type="submit" class="button">Save</button>
            </form>

            @include('projects._errors')
        </div>
    </div>

    <div class="lg:w-1/4 px-3">
        @include('projects._card')
        @include('projects.activity._activity')
        @can ('manage', $project)
            @include('projects._invite')
        @endcan
    </div>

</div>

</main>


@endsection