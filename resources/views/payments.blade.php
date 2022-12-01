<x-app-layout>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">


        <div class="mt-12 w-full max-w-4xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <div>
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">Add Payments</h2>
                </header>
                
                <div class="mt-5 md:mt-0 md:col-span-2">

                <!-- Validation Errors & Flash messages -->
                 <x-auth-validation-errors class="mb-4" :errors="$errors" />
                 <x-flash-messages class="mb-4"/>

                 <form action="{{url('payments')}}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="shadow overflow-hidden sm:rounded-md">
                      <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 lg:col-span-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                                <input type="text" name="amount" id="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="1800" readonly>
                            </div>

                            <div class="col-span-6">
                              <label class="block text-sm font-medium text-gray-700">
                                Payment Slip
                              </label>
                              <div class="mt-1 flex items-center">
                                <span class="inline-block h-32 w-32 rounded-md overflow-hidden bg-gray-100">
                                  <img 
                                    id="image_preview"  
                                    class="h-full w-full text-gray-300" 
                                    src="{{Auth::user()->payment->payment_slip ?? asset('images/no-preview.png') }}">
                                </span>
                                <label for="img">
                                    <p class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                                      Change
                                    </p>
                                </label>
                                <input id="img" type="file" style="display: none;" name="payment_slip" />
                              </div>
                            </div>

                          
                        </div>
                      </div>
                        @if(!Auth::user()->payment || !Auth::user()->payment->status)
                          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              Submit
                            </button>
                          </div>
                        @endif
                    </div>
                  </form>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
