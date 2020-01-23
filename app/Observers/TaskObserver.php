<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    // public function created(Task $task)
    // {
    //     $task->createActivity('created_task');
    // }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    // public function updated(Task $task)
    // {
    //     if (! $task->completed) {
    //         $task->createActivity('incompleted_task');
    //     }else{
    //         $task->createActivity('completed_task');
    //     }
    // }

    /**
     * Handle the project "updating" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    // public function updating(Task $task)
    // {
    //     $task->old = $task->getOriginal();
    // }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    // public function deleted(Task $task)
    // {
    //     $task->createActivity('deleted_task');
    // }

    /**
     * Handle the task "restored" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
