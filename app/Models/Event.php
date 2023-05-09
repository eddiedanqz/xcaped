<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Carbon\Carbon;
=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

use Qirolab\Laravel\Reactions\Traits\Reactable;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;


class Event extends Model implements ReactableInterface
{
    use HasFactory ,Reactable;

    //
    protected $fillable = [
        'title','description','category_id','banner','start_date','start_time','end_date','end_time',
        'venue','city','country', 'address','address_latitude','address_longitude','ticket_url','status','author',
        'slug', 'type','user_id'
    ];

      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
     ];

<<<<<<< HEAD
    //  protected $dates = [
    //     'start_date','end_date',

    //    ];
=======
     protected $dates = [
        'start_date','end_date',

       ];
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4

     //
     public function user (){
        return $this-> belongsTo(User::class);
      }

      //
    //   public function getRouteKeyName()
    //   {
    //      return 'slug';
    //   }

      public function category()
    {
        return $this-> belongsTo(Category::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function banner(){
        $imagePath = ($this->banner) ? 'user/uploads/'.$this->banner : 'imageonline-co-placeholder-image.jpg';

        return '/uploads/'.$imagePath;
    }
<<<<<<< HEAD

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
     * Published events
     */
    public function scopePublished($query)
    {
       return $query->where('status','=','published');
    }

    /**
     * Upcoming events
     */
    public function scopeUpcoming($query)
    {
       return $query->where('start_date','>=', Carbon::today()->format('Y-m-d'));
    }

    /**
     * Nearby events
     */
    public function scopeNearby($query,$arg)
    {
       return $query->selectRaw("$arg AS distance")->whereRaw("$arg < ?",[50]);
    }

=======
>>>>>>> be6ea65c8c62721b1860ad20ee80d24752cb36d4
}
