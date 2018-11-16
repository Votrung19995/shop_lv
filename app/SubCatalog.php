<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCatalog extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subcatalog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subid', 'name', 'catalogid'
    ];

    public $timestamps = false;
}
