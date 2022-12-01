<x-app-layout>

    <div class="py-12 max-w-6xl mx-auto sm:px-6 lg:px-8">


        <div class="mt-8 p-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg mx-2">
            <div>
              <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                  <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-600">
                      add your personal information here...
                    </p>
                  </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">

                <!-- Validation Errors & Flash messages -->
                 <x-auth-validation-errors class="mb-4" :errors="$errors" />
                 <x-flash-messages class="mb-4"/>

                 <form action="{{url('profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="shadow overflow-hidden sm:rounded-md">
                      <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                          <div class="col-span-6 lg:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{Auth::user()->name}}">
                          </div>

                          <div class="col-span-6 lg:col-span-4">
                            <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="text" name="email" id="email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"  value="{{Auth::user()->email}}">
                          </div>

                          <div class="col-span-6 lg:col-span-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{Auth::user()->phone}}">
                          </div>

                          <div class="col-span-6 lg:col-span-4">
                            <label for="wallet_id" class="block text-sm font-medium text-gray-700">Wallet ID</label>
                            <input type="text" name="wallet_id" id="wallet_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{Auth::user()->wallet_id}}">
                          </div>

                          
                        </div>
                      </div>
                      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Save
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
              <div class="py-5">
                <div class="border-t border-gray-200"></div>
              </div>
            </div>

            <div class="mt-10 sm:mt-0">
              <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                  <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Update Password</h3>
                    <p class="mt-1 text-sm text-gray-600">
                      change your account password here.
                    </p>
                  </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                  <form action="{{url('profile/password')}}" method="post">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                      <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                          <div class="col-span-6 lg:col-span-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>

                          <div class="col-span-6 lg:col-span-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>

                        </div>
                      </div>
                      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Save
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
