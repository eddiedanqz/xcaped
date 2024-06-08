<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profilePhoto', 'bio', 'location', 'user_id', 'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
    // public function banner(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => $this->getFirstMediaUrl('avatar')
    //             ?: "https://ui-avatars.com/api/?name={$this->title}&background=random&size=150"
    //     );
    // }
}
