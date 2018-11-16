<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
use App\SubCatalog;
use App\Category;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //go to index:
    public function index(){
        //get all catalog:
        $catalogs = Catalog::all();
        //get all sub:
        $subscatalogs = SubCatalog::all();
        //get all category:
        $categorys = Category::where('status','=',true)->take(6)->orderBy('created', 'desc')->skip(0)->get();
        //get catalog1:
        $sp1s = Category::where('catalogid',1)->where('status','=',true)->take(4)->orderBy('created', 'asc')->skip(0)->get();
        //get catalog2:
        $sp2s = Category::where('catalogid',2)->take(4)->orderBy('created', 'desc')->skip(0)->get();
        //get catalog3:
        $sp3s = Category::where('catalogid',3)->where('status','=',true)->take(4)->orderBy('created', 'desc')->skip(0)->get();
        $sp4s = Category::where('catalogid',4)->where('status','=',true)->take(4)->orderBy('created', 'desc')->skip(0)->get();
        $sp5s = Category::where('catalogid',5)->where('status','=',true)->take(4)->orderBy('created', 'desc')->skip(0)->get();
        $sp6s = Category::where('catalogid',6)->where('status','=',true)->take(4)->orderBy('created', 'desc')->skip(0)->get();
        $sp7s = Category::where('catalogid',7)->where('status','=',true)->take(4)->orderBy('created', 'desc')->skip(0)->get();
        $sp8s = Category::where('catalogid',8)->where('status','=',true)->take(4)->orderBy('created', 'desc')->skip(0)->get();
        return view('welcome')->with(array('catalogs'=>$catalogs,'subcatalogs'=>$subscatalogs, 'categorys'=>$categorys,'sp1s'=>$sp1s, 'sp2s'=>$sp2s, 'sp3s'=>$sp3s, 'sp4s'=>$sp4s, 'sp5s'=>$sp5s, 'sp6s'=>$sp6s, 'sp7s'=>$sp7s, 'sp8s'=>$sp8s));
    }
}
