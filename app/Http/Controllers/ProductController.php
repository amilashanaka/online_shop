<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Image;

use App\Models\Seller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $table_data = Product::all();
        return view('admin.products', compact('table_data'));
    }

    function create () {
        $form_data= '';
        $sellers = Seller::all();
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $brands = Brand::all();
        $data_array = array();
        foreach($brands as $brand){
            foreach($brand->sub_categories as $brand_category){
                array_push($data_array, array(
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'sub_category_id' => $brand_category->id,
                ));
            }
        }
        $brands = $data_array;
        return view('admin.products_add', compact('form_data','sellers','categories','sub_categories','brands'));
    }

    function store(Request $request){

        DB::beginTransaction();

        $validate= $request->validate([
            'name' => 'required',
            'description' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'commission' => 'required',
            'stock' => 'required',
            'temp_image' => 'required',
        ]);

        try {

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'seller_id' => $request->seller_id,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'brand_id' => $request->brand_id,
                'status' => '1',
            ]);

            $product->product_sku()->create([
                'sku' => $request->seller_id.'-'.time(),
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'ttl_price' => round(($request->discount_price * 0.9)/120 , 3),
                'commission' => $request->commission,
                'stock' => $request->stock,
            ]);


            foreach ($request->temp_image as $image){
                if($image){
                    $product->product_medias()->create([
                        'image' => $image,
                    ]);
                }
            }

            
            $keywords = $request->keywords;
            array_push($keywords, $product->brand->name, $product->sub_category->name, $product->category->name);
            
            foreach ($keywords as $keyword){
                $product->product_keywords()->create([
                    'name' => $keyword,
                ]);
            }

            DB::commit();

            return redirect('admin/products')->with('success', 'Data Successfuly Saved ..!');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Data Inserting Error ..!');
        }
    }



    function edit ($id) {
        $form_data= Product::find($id);
        $sellers = Seller::all();
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $brands = Brand::all();
        $data_array = array();
        foreach($brands as $brand){
            foreach($brand->sub_categories as $brand_category){
                array_push($data_array, array(
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'sub_category_id' => $brand_category->id,
                ));
            }
        }
        $brands = $data_array;
        return view('admin.products_add', compact('form_data','sellers','categories','sub_categories','brands'));
    }



    function update(Request $request, $id){

        DB::beginTransaction();

        $validate= $request->validate([
            'name' => 'required',
            'description' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'commission' => 'required',
            'stock' => 'required',
            'temp_image' => 'required',
        ]);

        try {
            $product = Product::find($id);

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'seller_id' => $request->seller_id,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'brand_id' => $request->brand_id,
            ]);

            $product->product_sku()->update([
                'sku' => $request->seller_id.'-'.time(),
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'ttl_price' => round(($request->discount_price * 0.9)/120 , 3),
                'commission' => $request->commission,
                'stock' => $request->stock,
            ]);

            $product->product_medias()->delete();
            foreach ($request->temp_image as $image){
                if($image){
                    $product->product_medias()->create([
                        'image' => $image,
                    ]);
                }
            }

            $product->product_keywords()->delete();
            $keywords = $request->keywords;
            
            foreach ($keywords as $keyword){
                $product->product_keywords()->create([
                    'name' => $keyword,
                ]);
            }

            DB::commit();

            return redirect('admin/products')->with('success', 'Data Successfuly Updated ..!');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Data Updating Error ..!');
        }
    }


    public function upload(Request $request){

    // Temporarily increase memory limit to 256MB
        ini_set('memory_limit','256M');

        $image = $request->file('media');
        
        $imagename = time()."-".$image->getClientOriginalName();
        $destinationPath = public_path('/images/products/');
        $img = Image::make($image->move($destinationPath, $imagename))->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
        });
        $img->save();
        $temp_image_1= asset('images/products/'.$imagename);

        echo $temp_image_1;

    }
}
