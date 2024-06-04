<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;

use function Pest\Laravel\post;

it('can register a user', function () {
    $requestData = [
        'fullname' => 'Test User',
        'username' => 'User1',
        'email' => 'test12@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    post(
        action([AuthController::class, 'register']),
        $requestData
    )->assertCreated();
});
