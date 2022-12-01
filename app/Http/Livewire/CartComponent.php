<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Cart;
use App\Models\ProductSku;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class CartComponent extends Component
{
    public $carts;
    public $sub_total = 0;
    public $sub_total_ttl = 0;
    public $wallet_amount = 0;
    public $ttl_amount = 0;
    public $name = '';
    public $email = '';
    public $address = '';
    public $phone = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'phone' => 'required',
    ];

    public function mount(): void
    {

        $response_wallet = Http::get('https://trn.lk/api/wallet', [
            'member_id' => Auth::user()->member_id
        ]);

        $wallet = $response_wallet->json();

        $response_ttl = Http::get('https://trn.lk/api/ttls', [
            'member_id' => Auth::user()->member_id
        ]);

        $ttl = $response_ttl->json();

        $this->wallet_amount = $wallet['data'];
        $this->ttl_amount = $ttl['data'];

        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->address = Auth::user()->address;
        $this->phone = Auth::user()->phone;

        $this->carts = Auth::user()->carts;
    }

    public function decrement($id){
        $cart = Cart::find($id);
        if($cart->qty > 1){
            $cart->update([
                'qty' => $cart->qty-1
            ]);
        }
        $this->carts = Auth::user()->carts;

    }

    public function increment($id){
        $cart = Cart::find($id);
        if($cart->qty < $cart->product_sku->stock){
            $cart->update([
                'qty' => $cart->qty+1
            ]);
        }
        $this->carts = Auth::user()->carts;

    }

    public function checkout($type){

        DB::beginTransaction();

        $this->validate();


        try {   
            $user = Auth::user();
            $total = 0;
            $total_commission = 0;
            $otp = mt_rand(100000,999999);

            $order = $user->orders()->create([
                'reference_id' => time().'-'.$user->id,
                'amount' => 0,
                'payment_type' => $type,
                'otp' => $otp,
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'phone' => $this->phone,
            ]);


            foreach ($user->carts as $cart) {

                if($type == '1'){
                    $price = $cart->product_sku->discount_price;
                    $amount =  $price * $cart->qty;
                    $total += $amount;
                }else {
                    $price = $cart->product_sku->ttl_price;
                    $amount =  $price * $cart->qty;
                    $total += $amount;
                }

                $commission =  $cart->product_sku->commission * $cart->qty;
                $total_commission += $commission;

                $order->order_details()->create([
                    'qty' => $cart->qty,
                    'amount' => $price,
                    'total' => $amount,
                    'commission' => $commission,
                    'status' => '0',
                    'product_id' => $cart->product_id,
                    'product_sku_id' => $cart->product_sku_id,
                ]);

                $sku = ProductSku::find($cart->product_sku_id);
                
                $sku->update([
                    'stock' => $sku->stock - $cart->qty
                ]);
            }

            $order->update([
                'amount' => $total,
                'commission' => $total_commission,
            ]);

            $user->carts()->delete();

            
            $phone_no = intval(Auth::user()->phone);
            $phone_no = '94'.$phone_no;

            $response = Http::get('https://sms.comtrabiz.com/smsAPI?sendsms&apikey=baw05VGyQWfloRJgvlGtrLQa3mhw9Nfq&apitoken=1llK1574162154&type=sms&from=Turtles&to='.$phone_no.'&text=Use '.$otp.' as the OTP for the current Transaction.&route=0');

            DB::commit();

            return redirect('/otp?order='.$order->reference_id);

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Checkout Error ..!');
        }
        
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
