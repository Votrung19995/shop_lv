<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\UserRole;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function goRegister(){
        $err = "";
        $user = new Customer;
        
        return view('register')->with(array('error' =>$err,'user' => $user));
    }

    public function register(){
        $username = Input::get('username');
        $password = Input::get('password');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $address = Input::get('address');
        $name = Input::get('name');

        //hasing password:
        $hasshedPassword = Hash::make($password);
        //set into model:
        $user = new Customer;
        $user->username = $username;
        $user->password = $hasshedPassword;
        $user->phone = $phone;
        $user->email = $email;
        $user->address = $address;
        $user->name = $name;
        error_log('USERNAME: '.$username.'  EMAIL: '.$user->email.'  PHONE: '.$user->phone);
        
        //check after add:
        if($this->checkUserExist($username, $email, $phone)) {
            return view('register')->with(array('error' => $username.' đã tồn tại email, username, SĐT, vui lòng nhập lại','user' => $user));
        }
        else{
            //saving value
            $saved = $user->save();
            if($saved == true){
                //get user by username:
                $userSaved = Customer::where('username', $username)->first();

                if(empty($userSaved)){
                    return view('register')->with(array('error' => 'Lỗi đăng ký!','user' => $user));
                }
                //save user:
                $userrole = new UserRole;
                // $userrole->userid = $userSaved->user_id;
                $userrole->userid = $userSaved->userid;
                $userrole->roleid = 2;
                $userrole->save();
                return view('success')->with('username',$username);
            }
            else{
                return view('register')->with(array('error' => 'Lỗi đăng ký!','user' => $user));
            }
        }
    }

    //get exist user:
    public function checkUserExist($username, $email, $phone){
        $user = null;
        if(($email == null || empty($email))){
            $user =  Customer::where('username', $username)->orWhere('phone', $phone)->first();
        }
        else{
            $user =  Customer::where('username', $username)->orWhere('email', $email)->orWhere('phone', $phone)->first();
        }

        if(!empty($user)){
            return true;
        }

        return false;
    }

    //add user:
    public function addUser(Request $request){

    }
}
