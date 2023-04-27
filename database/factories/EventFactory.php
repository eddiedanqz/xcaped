<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeThisYear('+1 month.');
        $endDate = strtotime('+1 day', $startDate->getTimestamp());
        $title = $this->faker->name();

        return [
        'title'=> $title,
        'slug' => Str::slug($title).time(),
        'description' => $this->faker->text(),
        'category_id' => $this->faker->bigInteger(),
        'start_date' => $startDate,
        'start_time' => $this->faker->time('H:i'),
        'end_date' => $endDate,
        'end_time' => $this->faker->time('H:i'),
        'venue' => $this->faker->name(),
        'banner' => $this->faker->imageUrl(900,580,'animals',true),
        'address' => $this->faker->address(),
        'address_latitude' => $this->faker->latitude(),
        'address_longitude' => $this->faker->longitude(),
        'author' => $this->faker->unique()->name(),
         'type' => 'public',
        'user_id' => rand(1,2)
        ];
    }
}
