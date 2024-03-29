<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'logo', 'address_latitude', 'address_longitude', 'type',
        'phone', 'start_day', 'close_day', 'start_time', 'close_time', 'slug', 'user_id'];

    /**
     * Get the user that owns the Place
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the promotions for the Place
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function type()
    {
        return $this->belongsTo(placeType::class);
    }

    /**
     * Nearby events
     */
    public function scopeNearby($query, $arg)
    {
        return $query->selectRaw("$arg AS distance")->whereRaw("$arg < ?", [50]);
    }
}
