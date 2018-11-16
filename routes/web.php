<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

//go register:
Route::get('dangky', 'RegisterController@goRegister');

//go login:
Route::get('dangnhap', 'LoginController@goLogin');

//register:
Route::post('register', 'RegisterController@register');

//login
Route::post('dangnhap', 'LoginController@login');

//logout:
Route::get('dangxuat', 'LoginController@logOut');

//goto posst:
Route::group(['prefix' => 'user',  'middleware' => 'userlogin'],function () {
    Route::get('/quan-ly-dang-tin', 'PostController@gotoPost');
    Route::get('/list-bai-dang', 'PostController@gotoListPost');
    Route::get('/list-don-hang', 'PostController@gotoListDH');
    Route::post('/deletePostUser', 'PostController@deletePostUser');
});

Route::group(['prefix' => 'cart'], function () {
    Route::post('/addToCart', 'PostController@addToCart');
    Route::get('/detailCart', 'PostController@detailCart');
    Route::post('/deleteAllCart', 'PostController@deleteAllCart');
    Route::post('/addQty', 'PostController@addQty');
    Route::post('/deleteCart', 'PostController@deleteCart');
    Route::post('/addUser', 'PostController@addUser');
});

//goto quan ly:
Route::get('/redirect/setting', 'AdminController@goSetting');

//goto admin:
Route::group(['prefix' => 'admin',  'middleware' => 'userrole'],function () {
    Route::get('/quan-ly-bai-dang', 'AdminController@gotoAdmin');
    Route::get('/post/{postID}', 'AdminController@getPostByID');
    Route::post('/post/updateStatus', 'AdminController@updateStatus');
    Route::get('preview/{categoryid}/{slug}', 'AdminController@goPreview');
});

Route::group(['prefix' => 'bill',  'middleware' => 'userlogin'],function () {
    Route::get('/addBill', 'PostController@bill');
    Route::get('/addBill2', 'PostController@bill2');
    Route::get('/success', 'PostController@success');
    Route::post('/createBill', 'PostController@createBill');
    Route::post('/getDistricts', 'PostController@getDistricts');
    Route::post('/getWards', 'PostController@getWards');
    Route::post('/getVillages', 'PostController@getVillages');
    Route::post('/updateAddress', 'PostController@updateAddress');
});

//goto posst:
Route::post('postCategory', 'PostController@postCategory');

//access deny:
Route::get('403', function(){
    return view('403');
});

//post detail:
Route::get('test/phpinfo', 'AdminController@phpInfo');

//post detail:
Route::get('detail/{categoryid}/{slug}', 'PostController@goDetail');

//post detail:
Route::get('detailsp/{catalogid}', 'PostController@detail');

//autocomplete:
Route::post('test/autocomplete', 'PostController@postAutocomplete')->name('test.post.autocomplete');

//comment:
Route::post('comment', 'CommentController@comment')->middleware('userlogin');

//autocomplete:
Route::get('searchajax',array('as'=>'searchajax','uses'=>'AutoCompleteController@autoComplete'));
Route::post('search','AutoCompleteController@searchCategory');

Route::get('slug/createSlug', 'PostController@createSlug');

