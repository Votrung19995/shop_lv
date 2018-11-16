<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryid', 'catalogid', 'price', 'name', 'created', 'image', 'postid', 'status'
    ];

    public $timestamps = false;

    public function getSlug() {
        $postID = $this->postid;
        $post = Post::where('postid', '=', $postID)->get()->first();
        if(empty($post)){
            $post = new Post;
            $post->slug = $this->name;
        }
        return $post->slug;
    }
}
