<?php

namespace Database\Factories;

use App\Models\TimeWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeWorkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeWork::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => date('Y-m-d', time()),
            'start_at' => $this->faker->time('07:00:00'),
            'end_at' => $this->faker->time('15:30:00')
            // 'time_start' => $this->faker->dateTimeBetween('-25 hours', '-24 hours', 'Asia/Jakarta'),
            // 'time_end' => $this->faker->dateTimeBetween('-17 hours', '-16 hours', 'Asia/Jakarta')
            // 'time_start' => $this->faker->dateTimeBetween('-49 hours', '-48 hours', 'Asia/Jakarta'),
            // 'time_end' => $this->faker->dateTimeBetween('-41 hours', '-40 hours', 'Asia/Jakarta')
        ];
    }
}
