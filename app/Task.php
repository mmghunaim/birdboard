<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected static $recordableEvents = ['created', 'deleted'];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::created(function($task){
    //         App\Activity::create([
    //         'project_id'=> $task->project->id,
    //         'description'=> 'created_task'
    //         ]);
    //     });
    // }

    protected function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function complete()
    {
        $this->update(['completed' => true]);
        $this->save();
        $this->createActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->createActivity('incompleted_task');
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
