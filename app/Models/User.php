<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class User extends Authenticatable implements HasName, Searchable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'type',
        'email', 'role', 'username',
        'password', 'settings',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => AsCollection::class,
    ];

    // Default settings
    // private $defaultSettings = [
    //     'theme' => 'light',
    //     'notifications' => [
    //         'email' => true,
    //     ],
    //     'payment_details' => [
    //         'method' => '',
    //         'phone_number' => '',
    //         'bank_details' => [
    //             'account_number' => '',
    //             'bank_name' => '',
    //         ],
    //     ],
    // ];

    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('start_date', 'desc');
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class)->withTimeStamps();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create();
        });
    }

    public function interest()
    {
        return $this->belongsToMany(Event::class, 'interested', 'user_id', 'event_id')->withTimeStamps();
    }

    /**
     * The orders associated with the account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the place associated with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function place()
    {
        return $this->hasOne(Place::class);
    }

    public function getSearchResult(): SearchResult
    {
        // $url = route('blogPost.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->fullname,

        );
    }

    public function getFilamentName(): string
    {
        return $this->fullname;
    }

    // public function getSettingsAttribute($value)
    // {
    //     // Decode the JSON value from the database
    //     $settings = json_decode($value, true) ?? [];

    //     // Merge with default settings
    //     return collect($settings);
    // }
}
