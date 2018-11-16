<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shoppingcart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','billid','categoryid', 'name', 'qty', 'price', 'image'
    ];

    public $timestamps = false;
}
