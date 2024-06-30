<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory,HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name','user_email','status','order_no','user_id','grand_total',
        'isPaid','payment_method','quantity','event_id',
        'message',
    ];

    protected $dateFormat = 'Y-m-d';

    /**
     * The roles that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Ticket::class, 'order_items', 'order_id', 'ticket_id');
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * The attendees associated with the order.
     *
     * @return HasMany
     */
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

      /**
     * The event associated with the order.
     *
     * @return BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * The tickets associated with the order.
     * @return BelongsToMany
     */
    // public function tickets()
    // {
    //     return $this->belongsToMany(
    //         Ticket::class,
    //         'ticket_order',
    //         'order_id',
    //         'ticket_id'
    //     );
    // }
}
