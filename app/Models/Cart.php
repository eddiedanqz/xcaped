<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id','ticket_id','quantity','event_id'
        ];


       protected $with = ['ticket'];

        /**
         * Get the tickets that owns the Cart
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function ticket()
        {
            return $this->belongsTo(Ticket::class, 'ticket_id');
        }
}
