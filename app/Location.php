<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'location';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locationid', 'name'
    ];

    public $timestamps = false;
}
