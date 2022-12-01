<x-app-layout>
   

    <div class="py-12 container mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8  place-content-center mb-24 px-4">
            <div class="h-32 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg grid place-items-center content-center">
                <div class="text-white text-xl font-bold">LKR {{ number_format(Auth::user()->commissions->sum('amount')) }}</div>
                <div class="text-white">Availabe Balance</div>
            </div>
            <div class="h-32 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg grid place-items-center content-center">
                <div class="text-white text-xl font-bold">$ {{ number_format(Auth::user()->sales->sum('amount')) }}</div>
                <div class="text-white">Total Sales</div>
            </div>
            <div class="h-32 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg grid place-items-center content-center">
                <div class="text-white text-xl font-bold">$ {{ number_format(Auth::user()->team_sales->sum('amount')) }}</div>
                <div class="text-white">Team Sales</div>
            </div>
        </div>
        <!-- Table -->
        <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Wallet Transactions</h2>
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
                                    <div class="font-semibold text-left">Description</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Amount</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr>
                                @forelse(Auth::user()->commissions as $wallet)
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $wallet->created_at->toDateString() }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $wallet->description }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-bold text-green-500">LKR {{ number_format($wallet->amount , 2) }}</div>
                                    </td>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                            <span class="text-sm font-medium text-gray-900">No Records found ...</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
