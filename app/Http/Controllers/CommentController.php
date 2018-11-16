<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Textarea;
use App\Location;
use App\Customer;
use App\Comment;
use App\Category;
use DateTime;
use App\Post;
use Redirect;
use Cookie;

class CommentController extends Controller
{
    //get comment:
    public function comment(Request $request){
         $content = $request->input('content');
         $postid = $request->input('cateid');
         $username = Cookie::get('username');
         //save comment:
         if(!empty($username)){
            $user = Customer::where('username', $username)->first();
            $category = Category::where('categoryid', $postid)->first();

            if(!empty($user) && !empty($category) ){
                $post = Post::where('postid', $category->postid)->first();
                $comment = new Comment;
                $comment->postid = $post->postid;
                $comment->content = $content;
                // $comment->user_id = $user->user_id;
                $comment->userid = $user->userid;
                $now = new DateTime();
                $comment->username = $user->username;
                $comment->created = $now;
                $comment->save();

                return Redirect::to('detail/'.$postid);
            }else {
                return Redirect::to('detail/'.$postid);
            }
         }
         else {
            return Redirect::to('detail/'.$postid);
         }
    }
}
