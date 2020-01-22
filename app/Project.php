<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title','description','owner_id','notes'];

    protected $guarded=[];

    public $old = [];

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

    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function createActivity($description)
    {        
        $this->activities()->create([
            'description' => $description,
            'changes' => $this->activityChnages($description)
        ]);
    }

    public function activityChnages($description)
    {
        return $description === 'updated_project' ? [
                'before' => array_diff($this->old, $this->getAttributes()),
                'after' => $this->getChanges()
            ] : null ;
    }

}
