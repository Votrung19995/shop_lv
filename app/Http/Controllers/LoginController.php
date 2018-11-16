<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Redirect;
use Cookie;;
use App\Customer;
use App\UserRole;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   public function goLogin(Request $request){
       $case = $request->query('case');
       error_log('CASE: '.$case);
       $err = "";
       $user = new Customer;

       return view('login')->with(array('error'=>$err, 'user'=>$user, 'case'=>$case));
   }

   public function login(){
       $username = Input::get('username');
       $password = Input::get('password');
       $case = Input::get('casetext');
       //get user from password and username:
       $user = $this->getUserFromUserName($username);

       if(!empty($user)){
          //check password match:
          if (Hash::check($password, $user->password)) {
             //check role:
             $role = UserRole::where('userid',$user->userid)->get()->first();
             if(!empty($role)){
                 error_log('ROLE ID: '.$role->roleid);
                 if($role->roleid == 1){
                    Session::forget('cart');
                    return Redirect::to('/admin/quan-ly-bai-dang')->withCookie(Cookie::make('username',$user->username,60));
                 }
             }
             if(!empty($case) && strlen($case) > 0){
                 if($case == 'bill'){
                     //set cookie:
                     return Redirect::to('/bill/addBill')->withCookie(Cookie::make('username',$user->username,60));
                 }
             }
             //set cookie:
             return Redirect::to('/')->withCookie(Cookie::make('username',$user->username,60));
          }
          else {
             //set into model:
             $user = new Customer;
             $user->username = $username;
             $user->password = $password;

            if(!empty($case) && strlen($case) > 0){
                if($case == 'bill'){
                    //set cookie:
                    return Redirect::to('/dangnhap?case=bill')->with(array('error' => 'Tên đăng nhập hoặc mật khẩu không đúng !', 'user'=>$user, 'case'=>$case));
                }
            }

             return view('login')->with(array('error' => 'Tên đăng nhập hoặc mật khẩu không đúng !', 'user'=>$user, 'case'=>$case));
          }
       }
       else {
             //set into model:
             $user = new Customer;
             $user->username = $username;
             $user->password = $password;
             
             if(!empty($case) && strlen($case) > 0){
                if($case == 'bill'){
                    //set cookie:
                    return Redirect::to('/dangnhap?case=bill')->with(array('error' => 'Tên đăng nhập hoặc mật khẩu không đúng !', 'user'=>$user, 'case'=>$case));
                }
             }
             return view('login')->with(array('error' => 'Tên đăng nhập hoặc mật khẩu không đúng !', 'user'=>$user, 'case'=>$case));
       }
       
   }

   public function getUserFromUserName($username){
      $user = Customer::where('username', $username)->orWhere('email',$username)->orWhere('phone', $username)->get()->first();

      if(!empty($user)){
         return $user;
      }
      return null;
   }

   //Log out user
   public function logOut(){
       //set cookie:
       sleep(1);
       return Redirect::to('/')->withCookie(Cookie::forget('username'));
   }

}
