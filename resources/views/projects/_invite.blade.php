<div class="card flex flex-col mt-4">
    <h2 class="py-4 -ml-5 border-l-4 border-blue-200 pl-4 mb-3 font-normal text-xl">
        <a href="{{ $project->path() }}" class="text-default no-underline">Invite a User</a>
    </h2>
    <form action="{{ $project->path() . '/invitations'}}" method="POST">
        @csrf
        <div class="mb-2">
            <input 
            type="email" 
            name="email" 
            class="border-blue-200 border rounded-full p-1 w-full" 
            placeholder="Email Address">
        </div>
        <button class="text-sm button rounded-full">Invite</button>
    </form>
    @include('projects._errors', ['bag' => 'invitations'])
</div>