<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    use HasFactory;

    protected $table = 'place_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * Get all of the comments for the PlaceType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function place(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
