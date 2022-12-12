<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

     protected $dates = [
        'start_date','end_date',

       ];

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
}
