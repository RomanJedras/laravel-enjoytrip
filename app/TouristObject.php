<?php
/*
|--------------------------------------------------------------------------
| app/TouristObject.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

namespace App; /* Lecture 12 */

use Illuminate\Database\Eloquent\Model; /* Lecture 12 */

/* Lecture 12 */
class TouristObject extends Model
{

    protected $table = 'objects';

    /* Lecture 14 */
    public function city() 
    {
        return $this->belongsTo('App\City');
    }
    
    /* Lecture 14 */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }


     public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'asc');
    }

    public function users()
    {
        return $this->morphToMany('App\User', 'likeable');
    }

     public function address()
    {
        return $this->hasOne('App\Address','object_id');
    }

    public function rooms()
    {
        return $this->hasMany('App\Room','object_id');
    }

     public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

     public function articles()
    {
        return $this->hasMany('App\Article','object_id');
    }
    
    
}

