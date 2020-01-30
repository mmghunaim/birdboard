<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'body'=> $faker->sentence,
        'completed'=> false,
        'project_id'=> function () {
            return factory(Project::class)->create()->id;
        },
    ];
});
