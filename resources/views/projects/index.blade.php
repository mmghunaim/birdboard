@extends('layouts.app')

@section('content')
<body>
    <div class="flex items-center mb-3">
        {{-- <h1 class="mr-auto">BirdBoard</h1> --}}
        <a href="/projects/create">Create New Project</a>
    </div>

    <div class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="w-1/3 px-3 pb-6">
                <div class="bg-white p-5 rounded shadow" style="height: 200px">
                    <h2 class="py-4">{{ $project->title }}</h2>

                    <div class="text-gray-600">{{ Str::limit($project->description, 100) }}</div>
                </div>
            </div>
        @empty
            <div>No Projcets Yet.</div>
        @endforelse
                
    </div>

</body>
</html>
@endsection