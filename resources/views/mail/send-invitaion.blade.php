@component('mail::message')
# Invitation Send

you have me invited to {{ $project->title }} by {{ $project->owner->name }}
## You must have birdboard account to view the project

<a href="birdboard.test/login"></a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
