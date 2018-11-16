<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Village;

class Ward extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ward';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wardid', 'name', 'districtid'
    ];

     /**
     * Get the comments for the blog post.
     */
    public function villages()
    {
        return Village::where('wardid', $this->wardid)->get();
    }

    public $timestamps = false;
}
