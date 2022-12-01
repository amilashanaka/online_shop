<x-app-layout>
    <div class="bg-white">
      <div class="-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="h-full flex flex-col bg-white shadow-xl">
          <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
            <div class="flex items-start justify-between">
              <h2 class="text-lg font-medium text-gray-900">
                Shopping cart
              </h2>
            
            </div>

            @livewire('cart-component')

          </div>
        </div>
      </div>
    </div>
</x-app-layout>
