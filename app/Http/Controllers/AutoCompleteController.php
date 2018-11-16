<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class AutoCompleteController extends Controller
{
    public function autoComplete(Request $request) {
        $query = $request->get('term','');
        
        $products=Category::where('name','LIKE','%'.$query.'%')->where('status','=',true)->get();
        
        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->name,'id'=>$product->categoryid,'slug'=>$product->getSlug());
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>'', 'slug'=>''];
    }

    public function searchCategory(Request $request){
        $value = $request->input('search_text');
        $categorys = Category::where('name','LIKE','%'.$value.'%')->where('status','=',true)->take(12)->orderBy('created', 'desc')->skip(0)->paginate(12);
        return view('search')->with(array('categorys' => $categorys, 'value'=>$value ));
    }
}
