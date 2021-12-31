<?php

namespace Database\Factories;

use App\Models\TimeEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeEntry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attender_id' => $this->faker->unique()->numberBetween(1, 20),
            'temperature' => $this->faker->randomFloat(2, 34.0, 38.0),
            // 'time_start' => $this->faker->dateTimeBetween('-2 hours', '-1 hours', 'Asia/Jakarta'),
            // 'time_end' => $this->faker->dateTimeBetween('+8 hours', '+9 hours', 'Asia/Jakarta')
            'time_start' => $this->faker->dateTimeBetween('-25 hours', '-24 hours', 'Asia/Jakarta'),
            'time_end' => $this->faker->dateTimeBetween('-17 hours', '-16 hours', 'Asia/Jakarta')
            // 'time_start' => $this->faker->dateTimeBetween('-49 hours', '-48 hours', 'Asia/Jakarta'),
            // 'time_end' => $this->faker->dateTimeBetween('-41 hours', '-40 hours', 'Asia/Jakarta')
        ];
    }
}
