<?php

namespace App;

use Illuminate\Support\Arr;

trait RecordsActivity
{
    /**
     * The project's old attributes
     *
     * @var array
     */
    public $old = [];

    /**
     * Boot the trait.
     */
    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event){
                $model->createActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function($model){
                    $model->old = $model->getOriginal();
                });
            }
        }
    }

    /**
     * The project's old attributes
     *
     * @var string $description
     */
    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * Fetch the model events that should trigger activity.
     *
     * @return array
     */
    public static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return $recordableEvents = static::$recordableEvents;
        }
        return $recordableEvents = ['created', 'updated', 'deleted'];
    }

    /**
     * Record activity for a project.
     *
     * @param string $description
     */
    public function createActivity($description)
    {        
        $this->activities()->create([
            'user_id' => ($this->project ?? $this)->owner->id,
            'description' => $description,
            'changes' => $this->activityChnages(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
    }

    /**
     * Fetch the changes to the model.
     *
     * @return array|null
     */
    public function activityChnages()
    {
        if ($this->wasChanged()){
            return [
                'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at')
            ];
        }
    }

}