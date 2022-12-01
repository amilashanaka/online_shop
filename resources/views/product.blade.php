<x-app-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8" x-data="{count:1, stock:{{ $product->product_sku->stock }}, imagepath: '{{ $product->product_medias()->first()->image }}'}">
            
            <div class="mt-6 grid grid-cols-1 gap-x-12 gap-y-8 md:grid-cols-2">
                <template x-if="imagepath">
                    <div>
                            <div class="w-full bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden">
                                  <img :src="imagepath" alt="product img" class="w-full h-full object-center object-cover">
                            </div>
                            <div class="w-full grid grid-cols-5 gap-x-2 mt-6">
                                @foreach($product->product_medias as $media)
                                    <div class="w-full rounded-md overflow-hidden cursor-pointer">
                                        <img x-on:click="imagepath = '{{ $media->image }}'" src="{{ $media->image }}" alt="product img" class="w-full h-full object-center object-cover">
                                    </div>
                                @endforeach
                            </div>
                    </div>
                </template>

                <div class="flex-col space-y-4 items-center">
                    <h4 class="text-2xl font-black uppercase">{{ $product->name }}</h4>
                    <div class="lg:flex justify-start lg:space-x-8 text-xl font-[Nunito]">
                        <p>LKR 
                            @if($product->product_sku->discount_price < $product->product_sku->price)
                                <span class="line-through text-indigo-600">{{ number_format($product->product_sku->price, 2) }}</span>
                            @endif 
                            {{ number_format($product->product_sku->discount_price, 2) }}</p>
                        <p>TTL {{ number_format($product->product_sku->ttl_price, 3) }}</p>
                    </div>
                    <hr>
                    <div class="w-full my-8 ">
                        {!! $product->description !!}
                    </div>
                    <br>
                    <form method="post" action="{{ url('add-to-cart') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="xl:flex xl:space-x-4 items-center">
                        <div class="flex space-x-2 mb-4 xl:mb-0">
                            <button type="button" class="p-3 border hover:bg-gray-100 font-bold text-2xl active:bg-violet-600" @click=" count > 1 && count--">-</button>
                            <input type="text" name="qty" x-model="count" class=" border-gray-200 py-3 text-center w-32 focus-none" readonly>
                            <button type="button" class="p-3 border hover:bg-gray-100 font-bold text-2xl active:bg-violet-600" @click="stock > count && count++">+</button>
                        </div>
                        <button class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold text-center px-24 py-4 rounded-sm">
                        Add to Cart <i class="fas fa-shopping-cart"></i></button>
                    </div>
                    </form>
                </div>
                
            </div>

        </div>
    </div>
</x-app-layout>
