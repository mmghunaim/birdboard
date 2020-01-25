<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use RecordsActivity;
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

    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function invite(User $user)
    {
        $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members');
    }

}
