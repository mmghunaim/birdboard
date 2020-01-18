
<div class="card" style="height: 200px">
    <h2 class="py-4 -ml-5 border-l-4 border-blue-200 pl-4 mb-3 font-normal text-xl">
        <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
    </h2>

    <div class="text-gray-600">{{ Str::limit($project->description, 80) }}</div>
</div>

