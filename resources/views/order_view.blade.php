<x-app-layout>
    <div class="bg-white">
      <div class="-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="h-full flex flex-col bg-white shadow-xl">
          <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
            <div class="flex items-start justify-between">
              <h2 class="text-lg font-medium text-gray-900">
                Order - {{ $order->reference_id }}
              </h2>
            
            </div>

            <div class="mt-8">
              <div class="flow-root">
                  <ul role="list" class="-my-6 divide-y divide-gray-200">
                      @foreach($order->order_details as $cart)
                            <li class="py-6 flex">
                              <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                <img src="{{ $cart->product->product_medias()->first()->image }}" alt="img1" class="w-full h-full object-center object-cover">
                              </div>

                              <div class="ml-4 flex-1 flex flex-col">
                                <div>
                                  <div class="sm:flex justify-between text-base font-medium text-gray-900">
                                    <h3>
                                        {{ $cart->product->name }}<br>
                                        {{ 'Qty - '.$cart->qty }}
                                    </h3>
                                    <p class="sm:text-right font-bold text-sm">
                                      {{ $order->payment_type == 1?'LKR ':'TTL ' }}{{ number_format($cart->total, 2) }}
                                    </p>
                                  </div>
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
                          <div class="grid md:grid-cols-2 md:gap-2"> 
                            <input type="text" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" readonly  value="{{ $order->name }}"> 
                            <input type="text" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" readonly value="{{ $order->email }}"> 
                          </div> 
                          <input type="text" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" readonly value="{{ $order->address }}"> 
                          <input type="text" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm" readonly value="{{ $order->phone }}"> 
                      </div>
                    </div>
                    <div class="flex justify-between text-base font-bold text-gray-900 px-5">
                      <p>Subtotal</p>
                      <p>{{ $order->payment_type == 1?'LKR ':'TTL ' }} {{ number_format($order->amount, 2) }}</p>
                    </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
</x-app-layout>
