<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{   
    /**
     * Fillable fields for a flyer
     * @var array 
     */
    protected $fillable = [
        'street',
        'city',
        'zip',
        'state',
        'country',
        'price',
        'description'
    ];

    /**
     * Scope query to those located at a given address.
     * @param  Builder $query
     * @param  string $zip    
     * @param  string $street 
     * @return Builder
     */
    public function scopeLocatedAt($query, $zip, $street)
    {
        $street = str_replace('-', ' ', $street);
        //return $street;
        return $query->where(compact('zip', 'street'));
    }

    /**
     * [getPriceAttribute description]
     * @param  [type] $price [description]
     * @return [type]        [description]
     */
    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }

    /**
     * A flyer is composed of many photos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
