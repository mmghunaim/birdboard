@if (count($activity->changes['after']) == 1)
    {{ $activity->user->name }} Updated The {{ key($activity->changes['after']) }} of The Project
@else
    {{ $activity->user->name }} Updated The Project
@endif