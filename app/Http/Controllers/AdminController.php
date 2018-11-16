<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Textarea;
use App\Location;
use App\Catalog;
use App\Customer;
use App\Category;
use App\Post;
use App\Comment;
use Cookie;
use DateTime;
use Illuminate\Support\Facades\Log;
use Sunra\PhpSimple\HtmlDomParser;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\PostResponse;
use Illuminate\Support\Facades\Session;
use App\Cart;
use App\UserRole;

class AdminController extends Controller
{
    public function gotoAdmin (Request $request) {
        $users = [];
        $customers = Customer::all();
        $firstUser = '';
        foreach($customers as $customer){
            $userId = $customer->userid;
            $role = UserRole::where('userid','=',$userId)->get()->first();
            if($role->roleid != 1) {
                array_push($users, $customer);
            }
        }
        $query = $request->query('username');
        $posts = [];
        error_log('QUERY: '.$query);
        if(strlen($query) > 0){
            $userQuery = Customer::where('username', $query)->get()->first();
            error_log('USER ID QUERY: '.$userQuery->userid);
            $posts = Post::where('userid', $userQuery->userid)->orderBy('created_at','desc')->get();
            $firstUser = $query;
        }
        else {
            if(count($users) > 0){
                $username = $users[0]->username;
                $firstUser = $username;
                error_log('NOT QUERY: '.$username);
                $userFind = Customer::where('username', $username)->get()->first();
                error_log('USER ID FIND: '.$userFind->userid);
                $posts = Post::where('userid', $userFind->userid)->orderBy('created_at','desc')->get();
            }
        }

        return view('admin')->with(array('users'=>$users, 'posts'=>$posts, 'firstUser'=>$firstUser));
    }

    public function goSetting() {
        $username = request()->cookie('username');
        $user = Customer::where('username', '=', $username)->get()->first();
        //chck is admin:
        $userId = $user->userid;
        $userrole = UserRole::where('userid', $userId)->get()->first();
        $roleID = $userrole->roleid;
        error_log('ID: '.$roleID);
        if($roleID != 1) {
            return redirect('/user/quan-ly-dang-tin');
        }
        return  redirect('/admin/quan-ly-bai-dang');
    }

    public function getPostByID($postID) {
        error_log('POST ID: '.$postID);
        $post = Post::where('postid','=',$postID)->get()->first();
        $comment = $post->comment;
        $category = Category::where('postid','=',$postID)->get()->first();
        $sta = $category->status;
        error_log('STATUS: '.$sta);
        return response()->json(new PostResponse($sta,$comment), 200);
    }

    public function updateStatus(Request $request) {
        $postId = $request->input('postid');
        $comment = $request->input('comment');
        $status = $request->input('status');
        error_log('Post: '.$postId);
        error_log('Comment: '.$comment);
        error_log('Status: '.$status);
        //update:
        Post::where('postid', $postId)->update(['comment' => $comment]);
        Category::where('postid', $postId)->update(['status' => $status]);
        return response()->json(new PostResponse(200,"Upadate status ok"), 200);
     }

    //get preview:
    public function goPreview($categoryid, $slug){
        error_log('ÍNTANCT: ');
        //get catalog:
        $category = Category::where('categoryid', $categoryid)->first();
        //get cokkie:
        $username = Cookie::get('username');
        //get Post::
        $postId = $category->postid;
        $post = Post::where('postid',$postId)->first();
        if(!empty($category) && !empty($post)){
           //get all content of comment:
           $userComment = Customer::where('username',$username)->first();
           $comments = Comment::where('postid', $postId)->orderBy('created', 'desc')->paginate(10);
           $categoryName = $category->name;
           $images = explode(",",$post->images);
           $paths = array();
           foreach($images as $img){
              if(strlen($img) > 0 ){
                  array_push($paths,$img);
              }
           }
           // $user = Customer::where('user_id',$post->userid)->first();
           $user = Customer::where('userid',$post->userid)->first();
           $location = Location::where('locationid',$post->locationid)->first();
           //get all category related:
           $allcategorys = Category::where('catalogid',$category->catalogid)->where('status','=',true)->take(7)->orderBy('created', 'asc')->skip(0)->get();
           return view('preview')->with(array('categoryName'=>$categoryName, 'category'=>$category,'sp'=>$categoryid, 'post'=> $post, 'images'=>$paths, 'user'=>$user, 'location'=>$location, 'allcategorys'=>$allcategorys,'comments'=>$comments));
       }
       else {
           return view('403');
       }
   }

   public function phpInfo(){
       $php = phpinfo();
       echo $php;
   }
}
