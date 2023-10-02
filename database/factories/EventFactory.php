<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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

        $centerLatitude = 5.5547;
        $centerLongitude = -0.1835;

        // Generate random numbers between -0.01 and +0.01 for the latitude and longitude coordinates
        $latitude = $this->faker->randomFloat(6, $centerLatitude - 0.5, $centerLatitude + 0.5);
        $longitude = $this->faker->randomFloat(6, $centerLongitude - 0.5, $centerLongitude + 0.5);

        return [
            'title' => $title,
            'slug' => Str::slug($title).time(),
            'description' => $this->faker->text(),
            'category_id' => rand(1, 2),
            'start_date' => $startDate,
            'start_time' => $this->faker->time('H:i'),
            'end_date' => $endDate,
            'end_time' => $this->faker->time('H:i'),
            'venue' => $this->faker->name(),
            'banner' => $this->faker->imageUrl(900, 580, 'animals', true),
            'address' => $this->faker->address(),
            'address_latitude' => $latitude,
            'address_longitude' => $longitude,
            'author' => $this->faker->unique()->name(),
            'type' => 'public',
            'status' => 'published',
            'user_id' => rand(1, 2),
        ];
    }
}
