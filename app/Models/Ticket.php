<?php

namespace App\Models;

use App\Domain\Shared\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, HasUuids,SoftDeletes;

    protected $fillable = ['title', 'capacity', 'available_from', 'available_to', 'price', 'event_id'];

    /**
     * Set to null if empty
     *
     * @param  $input
     */
    // public function setEventIdAttribute($input)
    // {
    //     $this->attributes['event_id'] = $input ? $input : null;
    // }

    /**
     * Set attribute to money format
     *
     * @param  $input
     */
    // public function setAmountAttribute($input)
    // {
    //     $this->attributes['amount'] = $input ? $input : null;
    // }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * The order associated with the ticket.
     *
     * @return BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(
            Order::class,
            'ticket_order',
            'ticket_id',
            'order_id'
        );
    }

    public function closed(): bool
    {
        return $this->status === TicketStatus::CLOSED->value;
    }
}
