<x-app-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">

            <div class="mt-6 grid grid-cols-1 gap-x-12 gap-y-8 md:grid-cols-3 lg:grid-cols-4">
               
               @foreach($categories as $category)
                    <div class="text-gray-800">
                        <h5 class="font-bold text-xl underline underline-offset-4 mb-4">{{ $category->name }}</h5>
                        <div class="">
                            @foreach($category->sub_categories as $sub_category)
                                <a href="{{ url('shop?category='.$sub_category->name) }}" class="hover:underline cursor-pointer"> 
                                    <p class="font-semibold mb-2">{{ $sub_category->name }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
               @endforeach
                  
            </div>

        </div>
    </div>
</x-app-layout>
