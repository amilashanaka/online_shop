<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Network;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        DB::beginTransaction();


        $letters= substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,3);
        $member_id= $letters.''.str_pad((mt_rand(1,999)), 3, '0', STR_PAD_LEFT);
        $request['member_id'] = $member_id;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'member_id' => ['required', 'string', 'max:255', 'unique:users'],
            'wallet_id' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required',
            'user_id' => 'sometimes|exists:users,member_id'
        ], [
            'member_id' => 'Registration failed please try again..',
            'user_id.exists' => 'Introducer id is not valid please try again..',
            'user_id.required' => 'Introducer id is required..',
        ]);


        try{

            
            $member = $request->user_id?User::where('member_id', $request->user_id)->first(): null;

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'member_id' => $request->member_id,
                'wallet_id' => $request->wallet_id,
                'user_id' => $member?$member->id:null,
                'status' => 0,
                'is_child' => $member?'1':'0',
                'rank' => 0,

            ]);

            Network::insert([
                'parent_id' => $user->id,
                'child_id' => $user->id,
                'level' => '0'
            ]);

            if($member){
                $networks = Network::where('child_id', $member->id)->get();

                foreach($networks as $key => $value){
                        
                    Network::insert([
                        'parent_id' => $value->parent_id,
                        'child_id' => $user->id,
                        'level' => ++$key
                    ]);
                }

            }



            DB::commit();

            event(new Registered($user));

            return redirect('/');

        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Member Saving Error..!');
        }
    }
}
