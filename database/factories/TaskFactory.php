<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'type' => $this->faker->randomElement([1, 2]),
            'description' => $this->faker->paragraph,
            'creator_id' => function () {
                return User::factory()->create()->id;
            },
            'assignee_id' => function () {
                return User::factory()->create()->id;
            },
            'tester_id' => function () {
                return User::factory()->create()->id;
            },
            'status_id' => 1,
        ];
    }
}

