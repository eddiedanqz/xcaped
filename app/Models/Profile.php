<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Profile extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profilePhoto', 'bio', 'location', 'user_id', 'phone',
    ];

    protected $appends = ['avatar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('avatar')
                ?: "https://ui-avatars.com/api/?name={$this->user->fullname}&background=random&size=50&rounded=true"
        );
    }
}
