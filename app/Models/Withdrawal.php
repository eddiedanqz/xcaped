<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory,HasUuids,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_no', 'event_id', 'status_id', 'status', 'method',
        'details', 'commission', 'amount', 'actual_amount', 'ended_at'];


    protected $casts = [
        'details' => AsCollection::class,
    ];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
