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
use Illuminate\Support\Facades\Hash;
use App\UserRole;
use Redirect;
use App\Bill;
use App\ShoppingCart;
use App\ProVince;
use App\DisTrict;
use App\Ward;
use App\Village;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function gotoPost(){
        //get all location:
        $locations = Location::all();
        $catalogs = Catalog::all();
        return view('post')->with(array('locations'=>$locations, 'catalogs'=>$catalogs));
    }

    public function postCategory(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        //get user by cookie:
        $username = $request->cookie('username');
        $user  = Customer::where('username', $username)->first();
    
        if(!empty($user)){
            $images = $request->input('editor1');
            $dom = HtmlDomParser::str_get_html($images);
            // Find all images path
            $images = '';
            foreach($dom->find('img') as $element){
                $images = $images.','.$element->src;
                error_log('===>>SRC: '.$element->src);
            }

            //get all atribute
            $title = $request->input('title');
            $cate =  $request->input('category'); 
            $catalog =  $request->input('catalog');
            $location =  $request->input('location');
            $price =  $request->input('price');
            $number =  $request->input('number');
            $content =  $request->input('content');
            error_log('===>>PATHS: '.$dom->find('img')[0]->src);
            //SAVING POST:
            $post = new Post;
            $post->userid = $user->userid;
            $post->title = $title;
            $post->content = $content;
            $post->images = $images;
            $post->locationid = $location;
            $post->number = $number;
            $post->status = false;
            $nowPost = new DateTime();
            $post->created_at = $nowPost;

            if($post->save()){
                //save SP:
                $category = new Category;
                $category->catalogid = $catalog;
                $category->price = $price;
                $category->name = $cate;
                $category->postid = $post->id;
                $category->status = false;
                error_log("POSTT ID:  ".$post->postid);
                $img = $dom->find('img')[0]->src;

                if(!empty($img)){
                   $category->image = $img;
                }

                $category->created = $nowPost;

                if($category->save()){
                    return view('postsucess')->with(array('ms'=>'Đăng tin thành công!!'));
                }
                else {
                    return view('postsucess')->with(array('ms'=>'Lỗi đăng tin, mời bạn kiểm tra lại'));
                }
               
            }
            else {
                return view('postsucess')->with(array('ms'=>'Lỗi đăng tin, mời bạn kiểm tra lại'));
            }
        }
        return view('postsucess')->with(array('ms'=>'Lỗi đăng tin, mời bạn kiểm tra lại'));
    }
    
    //get detail:
    public function goDetail($categoryid, $slug){
         error_log('ÍNTANCT: ');
         //get catalog:
         $category = Category::where('categoryid', $categoryid)->first();
         //get cokkie:
         $username = Cookie::get('username');
         //get Post::
         $postId = $category->postid;
         $post = Post::where('postid',$postId)->first();
         $content = $post->content;
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
            return view('postdetail')->with(array('categoryName'=>$categoryName, 'category'=>$category,'sp'=>$categoryid, 'post'=> $post, 'images'=>$paths, 'user'=>$user, 'location'=>$location, 'allcategorys'=>$allcategorys,'comments'=>$comments, 'content'=> $content));
        }
        else {
            return view('403');
        }
    }

    //go detail:
    public function detail($catalogid){
        //get catalog:
        $catalog = Catalog::where('catalogid', $catalogid)->first();
        $catalogName = $catalog->name;
        //get category:
        $categorys = Category::where('catalogid',$catalogid)->where('status','=',true)->take(4)->orderBy('created', 'desc')->skip(0)->paginate(4);
        
        if(!empty(Category::where('catalogid',$catalogid)->first())){
            return view('catalogdetail')->with(array('catalogName'=>$catalogName, 'categorys'=>$categorys));
        }
        else {
            return view('403');
        }
    }

    //create Slug:
    public function createSlug() {
        $posts = Post::all();
        $categories = category::all();

        foreach ($posts as $index => $post) {
           //create slug:
        //    $slug = SlugService::createSlug(Post::class, 'slug', $post->title, ['unique' => false]);
        //    Post::where('postid', $post->postid)
        //             ->update(['slug' => $slug]);
              if($post->postid = $categories[$index]->postid) {
                 Post::where('postid', $categories[$index]->postid)->update(['created_at' =>$categories[$index]->created]);
              }
        }
        return "All posts from Posts update date!!!";
    }

    public function gotoListPost() {
        $username = Cookie::get('username');
        error_log('USERNAME: '.$username);
        $user = Customer::where('username', $username)->get()->first();
        error_log('USER ID: '.$user->userid);
        $posts = Post::where('userid', $user->userid)->orderBy('created_at','desc')->get();
        return view('listpost')->with(array('posts'=> $posts));
    }

    public function gotoListDH() {
        $username = Cookie::get('username');
        error_log('USERNAME: '.$username);
        $user = Customer::where('username', $username)->get()->first();
        $bills = $user->bills();
        return view('listdh')->with(array('bills'=> $bills));
    }

    public function addToCart(Request $request) {
        $carts = [];
        $username = Cookie::get('username');
        $flag = $request->input('flag');
        error_log('FLAG: '.$flag);
        $categoryid = $request->input('categoryid');
        error_log('CATEGORY ID: '.$categoryid);
        //chek seesion:
        if(!empty(Session::get('cart'))){
            $carts = Session::get('cart');
        }
        //check array exist:
        $cEx = new Cart();
        $cEx->categoryid = $categoryid;
        $cEx->qty = 1;

        if(!$this->checkCart($cEx, $carts)){
            error_log('PUSH CATEGORY: '.$categoryid);
            array_push($carts, $cEx);
            //set session:
            Session::put('cart', $carts);
            
            foreach(Session::get('cart') as $item) {
                error_log('CART: '.$item->categoryid);
            }
        }
        else {
            //set session:
            Session::put('cart', $carts);
            return response()->json(new PostResponse(409,"Category ID: ".$categoryid.' is exist in cart '),409);
        }
        
        if($flag === 'true'){
            return response()->json(new PostResponse(200,"quick"), 200);
        }
        else{
            return response()->json(new PostResponse(200,"add"), 200);
        }
    }

    //go to detail Cart:
    public function detailCart() {
        $carts = Session::get('cart');
        $username = Cookie::get('username');
        $role = null;
        if(!empty($username)){
            $user = Customer::where('username', $username)->get()->first();
            if(!empty($user)){
                $userRole = UserRole::where('userid', $user->userid)->get()->first();
                if(!empty($userRole)){
                    $role = $userRole->roleid;
                }
            }
        }
        $stores = [];
        $allcategorys = [];
        if(empty($carts)){
            $carts = [];
        }
        // foeach to get all Cart:
        foreach($carts as $cart){
            error_log('CART FECTH: '.$cart->categoryid);
            $category = Category::where('categoryid',$cart->categoryid)->get()->first();
            if(!empty($category)){
                $c = new Cart;
                $c->categoryid = $category->categoryid;
                $c->path = $category->image;
                $c->qty = $cart->qty;
                $c->price = $category->price;
                $c->name = $category->name;
                array_push($stores, $c);
                $cates = Category::where('catalogid',$category->catalogid)->where('status','=',true)->take(5)->orderBy('created', 'asc')->skip(0)->get();
                if(count($cates) > 0){
                    foreach($cates as $cate){
                        error_log('REALATED: '.$cate->name);
                        array_push($allcategorys,$cate);
                    }
                }
            }
        }

        return view('detailcart')->with(array('carts'=>$stores, 'allcategorys'=>$allcategorys, 'role'=>$role));
    }

    public function checkCart($cart, $array){
        foreach($array as $c) {
            error_log('CAR 1: '.$cart->categoryid.'  Cart 2: '.$c->categoryid);
            if($cart->categoryid == $c->categoryid) {
                return true;
            }
        }
        return false;
    }

    public function deleteAllCart() {
        Session::forget('cart');
        return response()->json(new PostResponse(200,"delete all cart is success"), 200);
    }
    
    //add number qty
    public function addQty(Request $request){
        $index = $request->input('index');
        $categoryid = $request->input('categoryid');
        $qty = $request->input('qty');
        $carts = Session::get('cart');
        if(!empty($carts)){
            $getIndex = $this->getIndex($carts,$categoryid);
            error_log('INDEX GET: '.$getIndex);
            if($getIndex >= 0){
                $category = Category::where('categoryid', $categoryid)->get()->first();
                $postId = $category->postid;
                $post = Post::where('postid', $postId)->get()->first();
                $number = $post->number;
                if($qty > $number){
                    error_log('SỐ LƯỢNG QTY VƯỢT MỨC');
                    return response()->json(new PostResponse(304,"QTY vượt quá số lượng bán: ".$qty), 304);
                }
                else {
                    $cart = $carts[$getIndex];
                    $cart->qty = $qty;
                    error_log('REMOVE INDEX CART ID: '.$categoryid.' INDEX: '.$index);
                    unset($carts[$getIndex]);
                    array_push($carts, $cart);
                    error_log('SET SESION AGAIN: '.$categoryid.' INDEX: '.$index);
                    Session::put('cart', $carts);
                }
            }
        }
        return response()->json(new PostResponse(200,"QTY: ".$categoryid), 200);
    }

    public function getIndex($carts, $categoryid){
        foreach($carts as $index => $cart){
            if($cart->categoryid == $categoryid){
                return $index;
            }
        }
        return -1;
    }

    //delete cart:
    public function deleteCart(Request $request){
        $categoryid = $request->input('categoryid');
        $carts = Session::get('cart');
        if(!empty($carts)){
            $getIndex = $this->getIndex($carts, $categoryid);
            if($getIndex >= 0){
                error_log('Xóa =====>>>>');
                unset($carts[$getIndex]);
                Session::put('cart', $carts);
                return response()->json(new PostResponse(200,"Đã xóa : ".$categoryid), 200);
            }
        }
        return response()->json(new PostResponse(304,"Can not delete cart by ID ".$categoryid), 304);
    }

    //delete post usser:
    public function deletePostUser(Request $request){
        $postId = $request->input('postid');
        $post = Post::where('postid',$postId)->delete();
        $category = Category::where('postid',$postId)->delete();
        return response()->json(new PostResponse(200,"Đã xóa post ID : ".$postId), 200);
    }

    //add usser:
    public function addUser(Request $request){ 
        $username = $request->input('username');
        $password = $request->input('password');
        $emailOrPhone = $request->input('emailOrPhone');
        $name = $request->input('name');
        $address = $request->input('address');
        $user = new Customer;
        $user->name = $name;
        $user->address = $address;
        $user->username = $username;
        $user->password = Hash::make($password);
        
        if($this->validateEmail($emailOrPhone)){
            $user->email = $emailOrPhone;
        }
        else{
            $user->phone = $emailOrPhone;
        }
        
        $userExist = null;
        //check phone or email:
        if($user->phone == null || empty($user->phone)){
            $userExist = Customer::where('username', $user->username)->orWhere('email', $user->email)->get()->first();
        }
        else{
            $userExist = Customer::where('username', $user->username)->orWhere('phone', $user->phone)->get()->first();
        }
        //save:
        if(!empty($userExist)) {
            return response()->json(new PostResponse(409,"User add to cart conflict"), 409);
        }else {
            if($user->save()) {
                $userSaved = Customer::where('username', $username)->get()->first();
                //save user:
                $userrole = new UserRole;
                $userrole->userid = $userSaved->userid;
                $userrole->roleid = 2;
                $userrole->save();
                 //set cookie:
                return Redirect::to('/bill/addBill')->withCookie(Cookie::make('username',$username,60));
            }
        }
        return response()->json(new PostResponse(304,"Can not add user to cart".$username), 304);
    }

    public function validateEmail($email)
    {
        $emailIsValid = FALSE;
        if (!empty($email)){
            $domain = ltrim(stristr($email, '@'), '@') . '.';
            $user   = stristr($email, '@', TRUE);
                if
                    (
                        !empty($user) &&
                        !empty($domain) &&
                        checkdnsrr($domain)
                    )
                {$emailIsValid = TRUE;}
        }
        return $emailIsValid;
    }

    public function bill(){
        $provinces = ProVince::all();
        $username = Cookie::get('username');
        $address = null;
        if(!empty($username)){
            $user = Customer::where('username', $username)->get()->first();
            $address = $user->address;
        }
        return view('bill1')->with(array('address'=>$address, 'provinces'=>$provinces));
    }

    public function bill2(){
        $carts = Session::get('cart');
        $username = Cookie::get('username');
        $address = null;
        if(!empty($username)){
            $user = Customer::where('username', $username)->get()->first();
            $address = $user->address;
        }
        $stores = [];
        $allcategorys = [];
        if(empty($carts)){
            $carts = [];
        }
        // foeach to get all Cart:
        foreach($carts as $cart){
            error_log('CART FECTH: '.$cart->categoryid);
            $category = Category::where('categoryid',$cart->categoryid)->get()->first();
            if(!empty($category)){
                $c = new Cart;
                $c->categoryid = $category->categoryid;
                $c->path = $category->image;
                $c->qty = $cart->qty;
                $c->price = $category->price;
                $c->name = $category->name;
                array_push($stores, $c);
            }
        }
        return view('bill2')->with(array('address'=>$address, 'carts'=>$stores));
    }

    public function createBill(Request $request){
        $transfer = $request->input('transfer');
        $pay = $request->input('pay');
        //get user from cookie:
        $username = Cookie::get('username');
        $user = Customer::where('username', $username)->get()->first();
        if(!empty($user)){
            $bill = new Bill;
            $bill->userid = $user->userid;
            $bill->status = 1;
            $bill->pay = $pay;
            $bill->transfer = $transfer;
            //get total in category:
            $stores = [];
            $total = 0;
            $carts = Session::get('cart');
            // foeach to get all Cart:
            foreach($carts as $cart){
                error_log('CART FECTH: '.$cart->categoryid);
                $category = Category::where('categoryid',$cart->categoryid)->get()->first();
                if(!empty($category)) {
                    $total += ($cart->qty) * ($category->price);
                    $c = new Cart;
                    $c->categoryid = $category->categoryid;
                    $c->path = $category->image;
                    $c->qty = $cart->qty;
                    $c->price = $category->price;
                    $c->name = $category->name;
                    array_push($stores, $c);
                    error_log('===== UPDATE QUTY CATEGORY=====');
                    //upadte category:
                    $postId = $category->postid;
                    $post =  Post::where('postid', $postId)->get()->first();
                    $number = ($post->number - $cart->qty); 
                    Post::where('postid', $postId)->update(['number' => $number]);
                }

            }
            $bill->total = $total;
            $bill->phase = 1;
            //save shoopping cart
            $isBillSave  = $bill->save();
            $billId = $bill->id;
            if($isBillSave && count($stores) > 0){
                $shoopingCart = null;
                foreach($stores as $cs){
                    $shoopingCart = new ShoppingCart;
                    $shoopingCart->billid = $bill->id;
                    $shoopingCart->categoryid = $cs->categoryid;
                    $shoopingCart->name = $cs->name;
                    $shoopingCart->qty = $cs->qty;
                    $shoopingCart->price = $cs->price;
                    $shoopingCart->image = $cs->path;
                    $shoopingCart->save();
                }
                //send mail:
                Mail::to($user->email)->send(new DemoEmail($bill));
                Session::forget('cart');
                return response()->json(new PostResponse(200,$billId), 200);
            }
            else{
                return response()->json(new PostResponse(304,"Can not created becase cart is empty"), 304);
            }
        }else{
            return response()->json(new PostResponse(401,"Can not created becase user not login".$username), 401);
        }
    }

    public function success(Request $request){
        $billId = $request->query('bill');
        error_log('BILL ID: '.$billId);
        $stores = [];
        $username = Cookie::get('username');
        $address = null;
        $user = null;
        $bill = new Bill;
        if(!empty($username)){
            $user = Customer::where('username', $username)->get()->first();
            $address = $user->address;
        }
        if($billId != null || $billId != ''){
            $bill = Bill::where('id', $billId)->get()->first();
        }else {

        }
        return view('billsuccess')->with(array('address'=>$address, 'carts'=>$stores, 'user'=>$user, 'bill'=>$bill));
    }

    //get districts:
    public function getDistricts(Request $request){
        $provinceid = $request->input('provinceid');
        $province = ProVince::where('provinceid',$provinceid)->get()->first();
        $districts = [];
        if(!empty($province)){
            error_log('============>>>>'.$province->name);
            $districts = $province->districts();
        }
        return response()->json($districts, 200);
    }

    //get wards:
    public function getWards(Request $request){
        $districtid = $request->input('districtid');
        $district = DisTrict::where('districtid',$districtid)->get()->first();
        $wards = [];
        if(!empty($district)){
            error_log('============>>>>'.$district->name);
            $wards = $district->wards();
        }
        return response()->json($wards, 200);
    }

    //get wards:
    public function getVillages(Request $request){
        $wardid = $request->input('wardid');
        $ward = Ward::where('wardid',$wardid)->get()->first();
        $villages = [];
        if(!empty($ward)){
            error_log('============>>>>'.$ward->name);
            $villages = $ward->villages();
        }
        return response()->json($villages, 200);
    }

    public function updateAddress(Request $request){
        $address = $request->input('ad');
        $username = Cookie::get('username');
        if(!empty($address) && !empty($username)){
            Customer::where('username', $username)->update(['address'=>$address]);
            return response()->json(new PostResponse(200,"Updated address: ".$address), 200);
        }
        return response()->json(new PostResponse(304,"Can not update address".$username), 304);
    }
}
