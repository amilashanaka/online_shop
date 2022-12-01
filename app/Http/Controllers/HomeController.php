<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Order;

class HomeController extends Controller
{
   
    public function index()
    {

        $products = Product::all();
        if(request('category')){
            $category = SubCategory::where('name',request('category'))->first();
            $products = $category->products;
        }
        return view('shop', compact('products'));
    }

    public function product($id)
    {
        $product  = Product::find($id);
        return view('product', compact('product'));

    }

    public function categories()
    {
        $categories  = Category::all();
        return view('categories', compact('categories'));

    }

    public function setCookie(Request $request){
      $minutes = 60;
      $response = new Response('Set Cookie');
      $response->withCookie(cookie('refferel_id', 'ABC123', $minutes));
      return $response;
    }

    public function getCookie(Request $request){
      $value = $request->cookie('refferel_id');
      echo $value;
    }
    
}
