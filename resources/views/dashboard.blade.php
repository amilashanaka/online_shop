<x-app-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="text-gray-600 text-sm font-semibold">
                My Orders History
            </div>
            <hr>


            <table class="table-auto w-full">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                      <th class="p-2 whitespace-nowrap text-left">Order ID</th>
                      <th class="p-2 whitespace-nowrap text-left">Date</th>
                      <th class="p-2 whitespace-nowrap text-left">Amount</th>
                      <th class="p-2 whitespace-nowrap text-left">Status</th>
                      <th class="p-2 whitespace-nowrap text-left">Actions</th>
                    </tr>
                    </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach($orders as $order)        
                        <tr>
                          <td class="p-2 whitespace-nowrap text-left">{{ $order->reference_id }}</td>
                          <td class="p-2 whitespace-nowrap text-left">{{ $order->created_at->toDateString() }}</td>
                          <td class="p-2 whitespace-nowrap text-left font-bold">{{ $order->payment_type == 1?'LKR ':'TTL ' }}{{number_format($order->amount, 2) }}</td>
                          <td class="p-2 whitespace-nowrap text-left">{{$order->status == 1?'Paid':'Pending' }}</td>
                          <td class="p-2 whitespace-nowrap text-left">
                            <a href="{{ url('order/'.$order->reference_id) }}" class="px-4 py-1 bg-purple-500 hover:bg-purple-600 text-white font-semibold text-xs rounded-lg">View</a>

                            @if(!$order->status)
                                <a href="{{ url('otp?order='.$order->reference_id) }}" class="px-4 py-1 bg-sky-500 hover:bg-sky-600 text-white font-semibold text-xs rounded-lg">OTP</a>
                            @endif
                          </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

        </div>
    </div>
</x-app-layout>
