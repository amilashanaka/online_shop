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

use App\Models\User;
use App\Models\Order;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $orders = Auth::user()->orders;
        return view('dashboard', compact('orders'));
    }

    public function order($id){
        $order = Order::where('reference_id', $id)->first();
        if($order->user_id == Auth::user()->id){
            return view('order_view', compact('order'));
        }
        return redirect('/');
    }
}
