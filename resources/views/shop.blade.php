<x-app-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="text-gray-600 text-sm font-semibold">
                Shop / {{ request('category') ? request('category') : 'All Products' }}
            </div>
            <hr>
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
              @forelse($products as $product)  
                  <div class="group relative">
                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                      <img src="{{ $product->product_medias()->first()->image }}" alt="product img" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                    </div>
                    <div class="mt-4">
                        <div>
                            <h3 class="font-bold  text-sm text-gray-700 hover:underline">
                              <a href="{{ url('product/'.$product->id) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $product->name }}
                              </a>
                            </h3>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">{{ $product->brand->name }}</p>
                        <div class="flex space-x-4 text-sm font-semibold text-gray-900">
                            <p>LKR {{ number_format($product->product_sku->discount_price, 2) }}</p>
                            <p>TTL {{ number_format($product->product_sku->ttl_price, 3) }}</p>
                        </div>
                    </div>
                  </div>
                @empty
                    <div class="font-semibold text-gray-600">
                        No Products to Display ...
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
