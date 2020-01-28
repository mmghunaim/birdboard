@extends('layouts.app')

@section('content')
<form 
method="POST"
action="{{ $project->path()  }}"
class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow text-default" 
>
<h1 class="text-2xl font-normal mb-10 text-center">
    Edit the project
</h1>
@method('PATCH')
@include('projects._form', ['buttonText'=> 'Update Project'])
</form>
@endsection   