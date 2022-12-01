<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $table_data = SubCategory::with('category')->get();
        return view('admin.sub_categories', compact('table_data'));
    }

    function create () {
        $form_data= '';
        $categories = Category::all();
        return view('admin.sub_categories_add', compact('form_data','categories'));
    }

    function store(Request $request) {

        $validate= $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255|unique:sub_categories',
        ]);


        try {

            SubCategory::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
            ]);

            return redirect('admin/sub-categories')->with('success', 'Data Successfuly Saved ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Inserting Error ..!');
        }

    }

    function edit($id){
        $form_data = SubCategory::find($id);
        $categories = Category::all();

        return view('admin.sub_categories_add', compact('form_data','categories'));
    }

    function update(Request $request, $id){

        
        $validate= $request->validate([
            'category_id' => 'required',
            'name' => ['required', 'string', 'max:255', Rule::unique('sub_categories')->ignore($id)],
        ]);

        try {

            SubCategory::find($id)->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
            ]);

            return redirect('admin/sub-categories')->with('success', 'Data successfuly Updated ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Updating Error ..!');
        }
    }
}
