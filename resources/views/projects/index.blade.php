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
                @include('projects.card')
            </div>
        @empty
            <div class="card">No Projcets Yet.</div>
        @endforelse
                
    </main>

</body>
</html>
@endsection