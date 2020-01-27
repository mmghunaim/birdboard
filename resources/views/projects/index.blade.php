@extends('layouts.app')

@section('content')
<body>
    <header class="flex items-center mb-3 py-4 px-1 ">
        {{-- <h1 class="mr-auto">BirdBoard</h1> --}}
        <div class="flex justify-between w-full items-end">
            <div class="text-gray-600">
                My Projects
            </div>

            <div>
                <a href="/projects/create" class="button">Create New Project</a>
            </div>
        </div>
    </header>

    <main class="lg:flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects._card')
            </div>
        @empty
            <div class="card">No Projcets Yet.</div>
        @endforelse
                
    </main>

    <modal name="create-project" classes="p-12 bg-card rounded-lg" height="auto">
      <h1 class="font-normal mb-16 text-center text-2xl">Let's begin by create a project</h1>

      <div class="flex">
          <div class="flex-1 mr-4">
            <div class="mb-4">
                <label for="title" class="text-sm block mb-2">Title</label>
                <input type="text" id="title" class="border border-muted-light p-2 text-xs block w-full rounded">
            </div>

            <div class="mb-4">
                <label for="description" class="text-sm block mb-2">Title</label>
                <textarea id="description" class="border border-muted-light p-2 text-xs block w-full rounded" rows="8"></textarea>
            </div>
          </div>

          <div class="flex-1 ml-4">
            <div class="mb-4">
                <label class="text-sm block mb-2">Add Some Tasks</label>
                <input type="text" class="border border-muted-light p-2 text-xs block w-full rounded" placeholder="Task 1">
            </div>

            <button type="button" class="inline-flex items-center text-xs" @click="addTask">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="mr-2">
                    <g fill="none" fill-rule="evenodd" opacity=".307">
                        <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                        <path fill="#000" d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"></path>
                    </g>
                </svg>
                <span>Add New Task Field</span>
            </button>

          </div>
      </div>

      <footer class="flex justify-end">
        <button type="button" class="button is-outlined mr-4" @click="$modal.hide('create-project')">Cancel</button>
        <button class="button">Create Project</button>
      </footer>
    </modal>

    <a href="" @click.prevent="$modal.show('create-project')">new project</a>

</body>
@endsection