<!DOCTYPE html>
<html>
<head>
    <title>BirdBoard</title>
</head>
<body>
    <h1>BirdBoard</h1>
    <ul>
        @forelse($projects as $project)
            <a href="{{ $project->path() }}"><li>{{ $project->title }}</li></a>
        @empty
            <li>No Products Yet.</li>
        @endforelse
    </ul>
</body>
</html>