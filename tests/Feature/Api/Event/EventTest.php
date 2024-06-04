<?php

use App\Http\Controllers\Api\V1\Event\EventController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\UploadedFile;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can create an event', function () {
    Storage::fake();

    $user = User::factory()->create();

    $data = [
        'title' => 'Event 1',
        // 'slug' => Str::slug('Event 1').time(),
        'description' => 'Hello world',
        'category_id' => Category::factory()->create(),
        'start_date' => '2024-05-11',
        'start_time' => '4:00',
        'end_date' => '2024-05-14',
        'end_time' => '6:00',
        'venue' => 'Palace Garden',
        'banner' => UploadedFile::fake()->image('banner.png'),
        'address' => 'my address street',
        'address_latitude' => -5.093,
        'address_longitude' => 0.129,
        'type' => 'public',
        // 'status_id' => EventStatus::factory()->create(),
        'user_id' => $user->id,
    ];

    post(
        action([EventController::class, 'store']),
        $data
    )->assertCreated();

});
