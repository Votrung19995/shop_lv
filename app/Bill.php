<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShoppingCart;

class Bill extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bill';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','userid','status', 'phase', 'total', 'transfer', 'pay', 'created_at'
    ];

    public $timestamps = false;

    public function shoppingcarts(){
        $shoppingcarts = ShoppingCart::where('billid',$this->id)->get();
        return $shoppingcarts;
    }
}
