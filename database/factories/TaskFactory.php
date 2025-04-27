<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => Str::limit($this->faker->paragraph(5), 100),
            'category' => $this->faker->randomElement(['Trabalho', 'Pessoal', 'Estudo']),
            'priority' => $this->faker->numberBetween(1, 3),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'is_completed' => $this->faker->boolean(30),
            'arquivo' => null,
            'user_id' => 1
        ];
    }
}
