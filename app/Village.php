<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'village';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'villageid', 'name', 'wardid'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function ward()
    {
        return $this->belongsTo('App\Ward');
    }

    public $timestamps = false;
}
