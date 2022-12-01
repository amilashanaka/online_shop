<x-app-layout>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">


        <div class="mt-12 w-full max-w-4xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <div>
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">Add Investment</h2>
                </header>
                
                <div class="mt-5 md:mt-0 md:col-span-2">

                <!-- Validation Errors & Flash messages -->
                 <x-auth-validation-errors class="mb-4" :errors="$errors" />
                 <x-flash-messages class="mb-4"/>

                 <form action="{{url('investment')}}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="shadow overflow-hidden sm:rounded-md">
                      <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 lg:col-span-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700">Amount ($)</label>
                                <input type="number" name="amount" id="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('amount') }}">
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
                                    src="{{asset('images/no-preview.png') }}">
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
                       
                      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Submit
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

         <!-- Table -->
        <div class="mt-12 w-full max-w-4xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Investment History</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Amount</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Actions</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse(Auth::user()->invesments as $investment)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $investment->created_at->toDateString() }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-bold text-green-500">$ {{ $investment->amount }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $investment->status == '1'?'Approved' : ($investment->status == '2'?'Rejected' : 'Pending') }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        @if($investment->status != '1')
                                            <a href="{{ url('investment/delete/'.$investment->id) }}" class="px-4 py-1 bg-red-500 hover:bg-red-600 cursor-pointer text-white rounded-md">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                        <span class="text-sm font-medium text-gray-900">No Records found ...</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
