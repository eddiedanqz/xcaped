<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the user) "creating" user).
     *
     * @return void
     */
    public function creating(User $user)
    {
        $user->settings = $user->settings ?? [
            'theme' => 'light',
            'notifications' => [
                'email' => true,
            ],
            'payment_details' => [],
        ];
    }
}
