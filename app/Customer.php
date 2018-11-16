<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bill;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid', 'username', 'name', 'email', 'phone', 'address', 'password', 'firstname', 'lastname', 'created',
    ];

    public $timestamps = false;

    public function bills(){
        $bills = Bill::where('userid', $this->userid)->get();
        return $bills;
    }
}
