<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
<<<<<<< HEAD
use App\Models\Attendee;
use App\Policies\AttendeePolicy;
=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
<<<<<<< HEAD
        'App\Models\Attendee' => 'App\Policies\AttendeePolicy',
=======
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
