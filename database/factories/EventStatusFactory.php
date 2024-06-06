<?php

namespace Database\Factories;

use App\Models\EventStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventStatus>
 */
class EventStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->word();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'color' => $this->faker->word(),
            'bg_color' => $this->faker->word(),
        ];
    }
}
