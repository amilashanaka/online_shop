<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect('/');
    }

    function create(){
        $table_data = User::where('is_admin', '1')->get();
        $form_data = '';

        return view('admin.users', compact('table_data', 'form_data'));
    }

    function store(Request $request) {

        $validate= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;

        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->password  =  Hash::make($request->password);
        $user->status  = '1';
        $user->is_admin = '1';

        try {

            $user->save();
            return redirect()->back()->with('success', 'Data Successfuly Saved ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Inserting Error ..!');
        }

    }

    function edit($id){
        
        $table_data = User::where('is_admin', '1')->get();
        $form_data = User::find($id);
        return view('admin.users_edit', compact('table_data', 'form_data'));
    }

    function update(Request $request, $id){

        $validate= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        $user = User::find($id);

        $user->name  = $request->name;
        $user->email  = $request->email;

        try {

            $user->save();
            return redirect()->back()->with('success', 'Data successfuly Updated ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Updating Error ..!');
        }
    }

    function updatePassword(Request $request, $id){

        $validate= $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::find($id);

        $user->password  =  Hash::make($request->password);

        try {

            $user->save();
            return redirect()->back()->with('success', 'Data successfuly Updated ..!');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Data Updating Error ..!');
        }

    }
}
