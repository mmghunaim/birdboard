<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title','description','owner_id','notes'];
    protected $guarded=[];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
