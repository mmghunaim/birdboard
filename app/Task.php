<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

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

    protected function project(){
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function complete()
    {
        $this->update(['completed' => true]);
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
    }
}
