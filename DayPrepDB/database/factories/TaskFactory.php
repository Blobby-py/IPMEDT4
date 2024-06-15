<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(5),
            'start_date' => $this->faker->date('d_m_Y'),
            'end_date' => $this->faker->date('d_M_Y'),
            'finished' => $this->faker->boolean(),
            'user_id' => $this->faker->randomNumber(2),
        ];
    }
}
