<?php

namespace App\Models;

use App\Traits\UserSettings;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Qirolab\Laravel\Reactions\Traits\Reacts;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class User extends Authenticatable implements HasName, Searchable
{
    use HasApiTokens, HasFactory, Notifiable, Reacts ,UserSettings;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'type',
        'email', 'role', 'username',
        'password',
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
    ];

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
        return  $this->belongsToMany(Event::class, 'interested', 'user_id', 'event_id')->withTimeStamps();
    }
//    public function photo(){
//     $imagePath = ($this->logo) ? 'vendors/'.$this->logo : 'user-placeholder.jpg';

//     return '/uploads/'.$imagePath;
//   }

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

    public function settings()
    {
        return $this->hasMany(UserSetting::class);
    }
}
