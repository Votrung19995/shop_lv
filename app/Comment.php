<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'postid', 'content', 'created', 'userid', 'username'
    ];

    public $timestamps = false;
}
