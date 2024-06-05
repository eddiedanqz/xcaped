<?php

use App\Http\Controllers\Api\V1\Event\EventController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can create an event', function () {
    Storage::fake();

    $category = Category::factory()->create();

    $requestData = [
        'title' => 'Event 1',
        'description' => 'Hello world',
        'category_id' => $category->id,
        'start_date' => '2024-05-11',
        'start_time' => '04:00',
        'end_date' => '2024-05-14',
        'end_time' => '06:00',
        'venue' => 'Palace Garden',
        'banner' => UploadedFile::fake()->image('banner.png'),
        'address' => 'my address street',
        'address_latitude' => -5.093,
        'address_longitude' => 0.129,
        'type' => 'public',
        'user_id' => $this->user->id,
    ];

    post(
        action([EventController::class, 'store']),
        $requestData
    )->assertCreated();
});
