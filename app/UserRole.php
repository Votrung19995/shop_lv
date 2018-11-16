<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userrole';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid', 'roleid'
    ];

    public $timestamps = false;
}
