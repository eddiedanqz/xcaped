<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Event extends Model implements Searchable
{
    use HasFactory;

    //
    protected $fillable = [
        'title', 'description', 'category_id', 'banner', 'start_date', 'start_time', 'end_date', 'end_time',
        'venue', 'city', 'country', 'address', 'address_latitude', 'address_longitude', 'ticket_url', 'status_id', 'author',
        'slug', 'type', 'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    //  protected $dates = [
    //     'start_date','end_date',

    //    ];

     //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

      //
    //   public function getRouteKeyName()
    //   {
    //      return 'slug';
    //   }

     public function category()
     {
         return $this->belongsTo(Category::class);
     }

     public function status()
     {
         return $this->belongsTo(EventStatus::class);
     }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function banner()
    {
        $imagePath = ($this->banner) ? 'user/uploads/'.$this->banner : 'imageonline-co-placeholder-image.jpg';

        return '/uploads/'.$imagePath;
    }

    /**
     * The orders associated with the event.
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * The attendees associated with the event.
     *
     * @return HasMany
     */
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    /**
     * Get all of the invitations for the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Published events
     */
    public function scopeStatus($query, $arg)
    {
        return $query->where('status_id', '=', $arg);
    }

    /**
     * Upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', Carbon::today()->format('Y-m-d'));
    }

    /**
     * Nearby events
     */
    public function scopeNearby($query, $arg)
    {
        return $query->selectRaw("$arg AS distance")->whereRaw("$arg < ?", [50]);
    }

    public function scopeOngoing($query)
    {
        $now = now();

        $query->where('start_date', '<=', $now)
            ->where(function (Builder $query) use ($now) {
                $query->where('end_date', '>=', $now)
                    ->orWhereNull('end_date');
            });
    }

    public function scopeHasEnded($query)
    {
        $currentDateTime = Carbon::now();
        $eventEndDateTime = $this->end_date->setTimeFromTimeString($this->end_time);

        return false;
    }

    /**
     * Nearby events
     */
    public function scopeDateFilter($query, $arg)
    {
        if (isset($arg)) {
            // Apply the date range filter
            $query->whereDate('start_date', $arg);
        }
    }

    public function scopeWithEventCount(Builder $query, $followerIds)
    {
        return $query
            ->select('user_id', DB::raw('COUNT(*) as event_count'))
            ->whereIn('user_id', $followerIds)
            ->groupBy('user_id');
    }

    public function getSearchResult(): SearchResult
    {
        //  $url = route('blogPost.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            // $url
        );
    }
}
