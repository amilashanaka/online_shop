<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $member = User::where('email', $request->email)->orWhere('phone', $request->email)->first();
        
        if(!$member){

            $response = Http::get('https://trn.lk/api/signin', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $data = $response->json();

            if(!$data['success']){
                throw ValidationException::withMessages([
                    'email' => $data['error']
                ]);
            }

            $user = $data['data'];

            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($request->password),
                'phone' => $user['phone'],
                'address' => $user['address'],
                'member_id' => $user['member_id'],
                'status' => $user['status'],
            ]);

        }

        $request->authenticate();

        $request->session()->regenerate();
        
        if(Auth::user()->is_admin){
            return redirect('admin');
        }

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
