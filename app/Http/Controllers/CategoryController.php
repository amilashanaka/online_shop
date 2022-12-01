<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Image;

use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $table_data = Category::all();
        return view('admin.categories', compact('table_data'));
    }

    function create () {
        $form_data= '';
        return view('admin.categories_add', compact('form_data'));
    }

    function store(Request $request) {

        $validate= $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);


        try {

            Category::create([
                'name' => $request->name,
            ]);

            return redirect('admin/categories')->with('success', 'Data Successfuly Saved ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Inserting Error ..!');
        }

    }

    function edit($id){
        $form_data = Category::find($id);

        return view('admin.categories_add', compact('form_data'));
    }

    function update(Request $request, $id){

        
        $validate= $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($id)],
        ]);

        try {

            Category::find($id)->update([
                'name' => $request->name,
            ]);

            return redirect('admin/categories')->with('success', 'Data successfuly Updated ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Updating Error ..!');
        }
    }
}
