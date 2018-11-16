<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Category;

class Post extends Model
{
    use Sluggable;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postid', 'id', 'userid', 'title', 'content', 'images', 'locationid', 'number', 'title', 'status', 'comment', 'created_at'
    ];

    public $timestamps = false;


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the user that owns the phone.
     */
    public function category()
    {
        $postID = $this->postid;
        $cate =  Category::where('postid','=',  $postID)->get()->first();
        error_log('CATEGORY NAME: '.$cate->name);
        return $cate;
    }
}
