@extends('layouts.app')

@section('content')
<body>
    <form method="POST" action="/projects">
        @csrf
        <h1 class="heading is-1">Create a Project</h1>
        <div class="field">
            <label class="lable" for="title">Title</label>
        
            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>

        <div class="field">
            <label class="lable" for="description">Description</label>
                
            <div class="control">
                <textarea class="textarea" name="description"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create a Projet</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>

    </form>
</body>
@endsection   