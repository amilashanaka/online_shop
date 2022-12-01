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

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCart(Request $request){
        $product = Product::find($request->product_id);

        $cart = Cart::firstOrNew(['user_id' =>  Auth::user()->id, 'product_id' => $request->product_id]);
        $cart->qty = ($cart->qty + $request->qty);
        $cart->product_sku_id = $product->product_sku->id;
        $cart->save();

        return redirect()->back()->with('success', 'Cart Updated..');
    }

    public function cart(){
        $carts  = Auth::user()->carts;
        if(count($carts)){
            return view('cart', compact('carts'));
        }
        return redirect('shop');

    }

    public function cartRemove($id){
        Cart::find($id)->delete();
        return redirect()->back();
    }

    public function checkout(){

        DB::beginTransaction();


        try {   
            $user = Auth::user();
            $total = 0;
            $otp = mt_rand(100000,999999);

            $order = $user->orders()->create([
                'reference_id' => time().'-'.$user->id,
                'amount' => 0,
                'payment_type' => 1,
                'otp' => $otp,
            ]);


            foreach ($user->carts as $cart) {
                $price = $cart->product_sku->discount_price;
                $amount =  $price * $cart->qty;
                $total += $amount;

                $order->order_details()->create([
                    'qty' => $cart->qty,
                    'amount' => $price,
                    'total' => $amount,
                    'status' => '0',
                    'product_id' => $cart->product_id,
                    'product_sku_id' => $cart->product_sku_id,
                ]);
            }

            $order->update([
                'amount' => $total
            ]);

            $user->carts()->delete();

            $phone = intval(Auth::user()->phone);
            $phone = '94'.$phone;

            $response = Http::get('https://sms.comtrabiz.com/smsAPI?sendsms&apikey=baw05VGyQWfloRJgvlGtrLQa3mhw9Nfq&apitoken=1llK1574162154&type=sms&from=Turtles&to='.$phone.'&text=Use '.$otp.'as the OTP for the current Transaction.&route=0');

            // $response = Http::post('https://trn.lk/api/invoice', [
            //     'member_id' => Auth::user()->member_id,
            //     'reference_id' => $order->reference_id,
            //     'amount' => $order->amount,
            //     'payment_type' => $order->payment_type,
            // ]);

            DB::commit();

            return redirect('/otp')->with('success', 'Checkout Successfuly Saved ..!');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Checkout Error ..!');
        }


    }

    public function checkoutTTL(){

        DB::beginTransaction();

        $response = Http::get('https://trn.lk/api/ttls', [
            'member_id' => Auth::user()->member_id
        ]);

        $data = $response->json();

        if(!$data['success']){
            return redirect()->back()->with('error', "You don't have enough TTL ...!");
        }

        try {   
            $user = Auth::user();
            $total = 0;

            $order = $user->orders()->create([
                'reference_id' => time().'-'.$user->id,
                'amount' => 0,
                'payment_type' => 2,
            ]);


            foreach ($user->carts as $cart) {
                $price = $cart->product_sku->ttl_price;
                $amount =  $price * $cart->qty;
                $total += $amount;

                $order->order_details()->create([
                    'qty' => $cart->qty,
                    'amount' => $price,
                    'total' => $amount,
                    'status' => '0',
                    'product_id' => $cart->product_id,
                    'product_sku_id' => $cart->product_sku_id,
                ]);
            }

            $order->update([
                'amount' => $total
            ]);
            
            if($data['data'] < $total){
                DB::rollback();
                return redirect()->back()->with('error', "You don't have enough TTL ...!");
            }

            $user->carts()->delete();

            DB::commit();

            return redirect('/')->with('success', 'Checkout Successfuly Saved ..!');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Checkout Error ..!');
        }
        
    }

    function otp(){
        return view('otp');
    }

    function otpConfirm(Request $request){
        $validate= $request->validate([
            'otp' => 'required',
        ]);

        try {

            $order = Order::where('reference_id', $request->order)->first();

            if($order->otp != $request->otp){
                throw ValidationException::withMessages([
                    'otp' => 'OTP not matched'
                ]);
            }

            $url = $order->payment_type == 2 ? 'https://trn.lk/api/ttls' : 'https://trn.lk/api/wallet';
            
            $response = Http::get($url, [
                'member_id' => Auth::user()->member_id
            ]);

            $data = $response->json();

            if(!$data['success'] || $data['data'] < $order->amount){
                throw ValidationException::withMessages([
                    'otp' => "You don't have enough Balance ...!"
                ]);
            }

            $order->update([
                'status' => 1
            ]);
            
            $response = Http::post('https://trn.lk/api/invoice', [
                'member_id' => Auth::user()->member_id,
                'reference_id' => $order->reference_id,
                'amount' => $order->amount,
                'payment_type' => $order->payment_type,
                'commission' => $order->commission,
            ]);

            return redirect('/')->with('success', 'Checkout Successfuly Saved ..!');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Checkout Error ..!');
        }
    }

    function otpResend(){
        $order = Order::where('reference_id', request('order'))->first();
        $otp = mt_rand(100000,999999);

        $order->update([
            'otp' => $otp
        ]);

        $phone_no = intval(Auth::user()->phone);
        $phone_no = '94'.$phone_no;

        $response = Http::get('https://sms.comtrabiz.com/smsAPI?sendsms&apikey=baw05VGyQWfloRJgvlGtrLQa3mhw9Nfq&apitoken=1llK1574162154&type=sms&from=Turtles&to='.$phone_no.'&text=Use '.$otp.' as the OTP for the current Transaction.&route=0');

        return redirect()->back();
    }
}
