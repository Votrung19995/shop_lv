<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProVince extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'province';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provinceid', 'name'
    ];

     /**
     * Get the comments for the blog post.
     */
    public function districts()
    {
        return District::where('provinceid',$this->provinceid)->get();
    }

    public $timestamps = false;
}
