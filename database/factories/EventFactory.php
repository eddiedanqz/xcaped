<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Enums\EventStatus;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $endDate = Carbon::parse(strtotime('+1 day', $startDate->getTimestamp()));
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
            'category_id' => Category::factory()->create(),
            'start_date' => $startDate,
            'start_time' => $this->faker->time('H:i'),
            'end_date' => $endDate,
            'end_time' => $this->faker->time('H:i'),
            'venue' => $this->faker->name(),
            'address' => $this->faker->address(),
            'address_latitude' => $latitude,
            'address_longitude' => $longitude,
            'type' => 'public',
            'status' => EventStatus::PUBLISHED,
            'user_id' => User::factory()->create(),
        ];
    }
}
