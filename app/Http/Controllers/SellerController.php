<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Seller;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $table_data = Seller::all();
        return view('admin.sellers', compact('table_data'));
    }

    function create () {
        $form_data= '';
        return view('admin.sellers_add', compact('form_data'));
    }

    function store(Request $request) {

        $validate= $request->validate([
            'name' => 'required',
        ]);


        try {

            Seller::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            return redirect('admin/sellers')->with('success', 'Data Successfuly Saved ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Inserting Error ..!');
        }

    }

    function edit($id){
        $form_data = Seller::find($id);

        return view('admin.sellers_add', compact('form_data'));
    }

    function update(Request $request, $id){


        $validate= $request->validate([
            'name' => 'required',
        ]);

        try {

            Seller::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            return redirect('admin/sellers')->with('success', 'Data successfuly Updated ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Updating Error ..!');
        }
    }
}
