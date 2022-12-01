<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                         <img src="https://trn.lk/images/logo.png" class="h-20 sm:h-28 w-auto" />
                    </a>
                </div>
              
            </div>
            <div class="hidden sm:flex items-center">
                 <a href="{{ url('shop') }}" class="mx-2 text-gray-800 hover:underline px-5 py-1 font-semibold">Shop</a>
                 <a href="{{ url('categories') }}" class="mx-2 hover:underline text-gray-800 px-5 py-1 font-semibold">Categories</a>
                 <a href="{{ url('cart') }}" class="text-gray-800 mx-2 px-5 py-1 font-semibold"><i class="fas fa-shopping-cart"></i> {{ Auth::user()?Auth::user()->carts->count():0 }} </a>
            </div>

            
            <div class="hidden sm:flex items-center">
                 <a href="{{ url('/dashboard') }}" class="mx-2 border border-gray-800 text-gray-800 hover:bg-gray-100 px-5 py-1 font-semibold">My Account</a>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            

            <div class="mt-3 space-y-2">
                <x-responsive-nav-link :href="url('shop')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('categories')">
                    {{ __('Categories') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="url('cart')">
                    <i class="fas fa-shopping-cart"></i> {{ Auth::user()?Auth::user()->carts->count():0 }}
                </x-responsive-nav-link>
                <hr>
                <div class="mt-4 mx-4">
                    <a href="{{ url('/dashboard') }}" class="mt-2 border border-gray-800 text-gray-800 hover:bg-gray-100 px-5 py-1 font-semibold">My Account</a>
                </div>
                
                
            </div>
        </div>
    </div>
</nav>
