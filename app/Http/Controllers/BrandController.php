<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Image;

use App\Models\SubCategory;
use App\Models\Brand;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $table_data = Brand::all();
        return view('admin.brands', compact('table_data'));
    }

    function create () {
        $form_data= '';
        $categories = SubCategory::all();

        return view('admin.brands_add', compact('form_data', 'categories'));
    }

    function store(Request $request) {

    // Temporarily increase memory limit to 256MB
        ini_set('memory_limit','256M');

        $validate= $request->validate([
            'name' => 'required|string|max:255|unique:brands',
            'sub_category_id' => 'required',
            'logo' => ['required', 'file', 'max:2500'],
        ]);

        try {

            $image = $request->file('logo');

            $imagename = time()."-".$image->getClientOriginalName();
            $destinationPath = public_path('/images/brands/');
            $img = Image::make($image->move($destinationPath, $imagename))->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
            });
            $img->save();
            $temp_image = asset('images/brands/'.$imagename);

            $brand = Brand::create([
                'name' => $request->name,
                'logo' => $temp_image,
            ]);

            $brand->save();

            $brand->sub_categories()->attach($request->sub_category_id);

            return redirect('admin/brands')->with('success', 'Data Successfuly Saved ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Inserting Error ..!');
        }

    }

    function edit($id){
        $form_data = Brand::find($id);
        $categories = SubCategory::all();

        return view('admin.brands_add', compact('form_data','categories'));
    }

    function update(Request $request, $id){

    // Temporarily increase memory limit to 256MB
        ini_set('memory_limit','256M');

        $validate= $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('brands')->ignore($id)],
            'sub_category_id' => 'required',
        ]);

        try {


            $image = $request->file('logo');
            $temp_image= $request->img_temp;

            if(!empty($image)){

                $imagename = time()."-".$image->getClientOriginalName();
                $destinationPath = public_path('/images/brands/');
                $img = Image::make($image->move($destinationPath, $imagename))->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                });
                $img->save();
                $temp_image = asset('images/brands/'.$imagename);
            }

            $brand = Brand::find($id);

            $brand->update([
                'name' => $request->name,
                'logo' => $temp_image,
            ]);

            $brand->sub_categories()->sync($request->sub_category_id);
            return redirect('admin/brands')->with('success', 'Data successfuly Updated ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Updating Error ..!');
        }
    }
}
