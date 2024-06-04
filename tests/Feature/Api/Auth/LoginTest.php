<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Models\User;

use function Pest\Laravel\post;

it('can log in with email', function () {
    $user = User::factory()->create();

    $requestData = [
        'user' => $user->email,
        'password' => 'password',
    ];

    post(
        action([AuthController::class, 'login']),
        $requestData
    )->assertStatus(200);

});

it('can log in with username', function () {
    $user = User::factory()->create();

    $requestData = [
        'user' => $user->username,
        'password' => 'password',
    ];

    post(
        action([AuthController::class, 'login']),
        $requestData
    )->assertStatus(200);

});
