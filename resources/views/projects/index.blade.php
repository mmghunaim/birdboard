@extends('layouts.app')

@section('content')
<body>
    <header class="flex items-center mb-3 py-4 px-1 ">
        {{-- <h1 class="mr-auto">BirdBoard</h1> --}}
        <div class="flex justify-between w-full items-center">
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
                <div class="bg-white p-5 rounded-lg shadow" style="height: 200px">
                    <h2 class="py-4 -ml-5 border-l-4 border-blue-200 pl-4 mb-3">
                        <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
                    </h2>

                    <div class="text-gray-600">{{ Str::limit($project->description, 100) }}</div>
                </div>
            </div>
        @empty
            <div>No Projcets Yet.</div>
        @endforelse
                
    </main>

</body>
</html>
@endsection