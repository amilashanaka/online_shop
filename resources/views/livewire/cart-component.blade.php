<div class="mt-8">
    <div wire:loading wire:target="checkout">
        <x-loader/>
    </div>
    <div class="flow-root">
        <ul role="list" class="-my-6 divide-y divide-gray-200">
            @foreach($carts as $cart)
                @php
                    $total = $cart->product_sku->discount_price * $cart->qty;
                    $total_ttl = $cart->product_sku->ttl_price * $cart->qty;
                    $sub_total += $total;
                    $sub_total_ttl += $total_ttl;
                @endphp 
                  <li class="py-6 flex">
                    <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                      <img src="{{ $cart->product->product_medias()->first()->image }}" alt="img1" class="w-full h-full object-center object-cover">
                    </div>

                    <div class="ml-4 flex-1 flex flex-col">
                      <div>
                        <div class="sm:flex justify-between text-base font-medium text-gray-900">
                          <h3>
                            <a href="#">
                              {{ $cart->product->name }}
                            </a>
                          </h3>
                          <p class="sm:text-right font-bold text-sm">
                              LKR {{ number_format($total, 2) }}<br>
                              TTL {{ number_format($total_ttl, 3) }}<br>
                          </p>
                        </div>
                      </div>
                      <div class="sm:flex items-center justify-between text-sm">
                        <div class="flex space-x-2 mb-4">
                            <button type="button" class="p-2 border hover:bg-gray-100 font-bold text-2xl active:bg-violet-600" wire:click="decrement({{ $cart->id }})">-</button>
                            <input type="text" name="qty" value="{{ $cart->qty }}" class="py-2 border border-gray-200 text-center w-20 focus-none" readonly>
                            <button type="button" class="p-2 border hover:bg-gray-100 font-bold text-2xl active:bg-violet-600" wire:click="increment({{ $cart->id }})">+</button>
                        </div>
                        <a href="{{ url('cart/remove/'.$cart->id) }}" class="font-semibold text-red-600 hover:underline">Remove</a>
                      </div>
                    </div>
                  </li>
            @endforeach
        </ul>
    </div>


    <div class="border-t border-gray-200 py-6 px-4 md:px-12">

      <div class="mx-auto bg-white mx-2">
          <div class="md:flex mx-auto items-center justify-center">
            <div class="w-full p-4 px-5 py-5">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div class="grid md:grid-cols-2 md:gap-2"> 
                  <input type="text" wire:model="name" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" placeholder="Name*" > 
                  <input type="text" wire:model="email" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" placeholder="E-mail*" value="{{ Auth::user()->email }}"> 
                </div> 
                <input type="text" wire:model="address" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" placeholder="Address" value="{{ Auth::user()->address }}"> 
                <input type="text" wire:model="phone" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" placeholder="Phone No" value="{{ Auth::user()->phone }}"> 
            </div>
          </div>
          <div class="flex justify-between text-base font-bold text-gray-900 px-5">
            <p>Subtotal</p>
            <p>LKR {{ number_format($sub_total, 2) }}</p>
          </div>
          <div class="flex justify-between text-base font-bold text-gray-900 px-5">
            <p>Subtotal TTL</p>
            <p>TTL {{ number_format($sub_total_ttl, 3) }}</p>
          </div>
      </div>
      
      <div class="mt-6 flex flex-col space-y-4 sm:flex-row sm:justify-between sm:space-x-4 sm:space-y-0">

        @if($wallet_amount < $sub_total)
          <span class="text-red-600 font-semibold px-6"> You Don't Have Enough Cash To Withdraw</span>
        @else
          <button wire:click="checkout(1)" class="w-full px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">Pay with Cash</button>
        @endif

        @if($ttl_amount < $sub_total_ttl)
          <span class="text-red-600 font-semibold px-6"> You Don't Have Enough TTL To Withdraw</span>
        @else
          <button wire:click="checkout(2)" class="w-full px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-500 hover:bg-green-700">Pay with TTL <span class="text-xs">You will save LKR {{ number_format($sub_total - ($sub_total_ttl * 120), 3) }}</span></button>
        @endif

      </div>
      <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
        <p>
          or <a href="{{ url('shop') }}"  class="text-indigo-600 font-medium hover:text-indigo-500">Continue Shopping<span aria-hidden="true"> &rarr;</span></a>
        </p>
      </div>
    </div>
</div>