
<div class="card flex flex-col" style="height: 200px">
    <h2 class="py-4 -ml-5 border-l-4 border-blue-200 pl-4 mb-3 font-normal text-xl">
        <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
    </h2>

    <div class="text-gray-600 mb-4 flex-1">{{ Str::limit($project->description, 80) }}</div>

    <footer>
        <form action="{{ $project->path() }}" method="POST" class="text-right">
            @csrf
            @method('DELETE')

            <button 
            class="text-white no-underline rounded-lg py-2 px-5 bg-red-600 text-sm" 
            style="box-shadow:0 2px 7px 0 red" 
            type="submit"
            >
            Delete
            </button>
        </form>
    </footer>
</div>

