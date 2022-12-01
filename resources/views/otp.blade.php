<x-app-layout>
    <div class="bg-white">
      <div class="-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="h-full flex flex-col bg-white shadow-xl">
          <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
            <div class="flex items-start justify-between">
              <h2 class="text-lg font-medium text-gray-900">
                Confirm OTP
              </h2>
            
            </div>

            <div class="mx-auto w-full mt-12" x-data="{show : 0, timer: 60 }" 
              x-init="
                setInterval(() => {
                  timer--;
                }, 1000);
                setInterval(function() {
                  show = 1;
                }, 60000);"
            >
              <form method="post" action="{{ url('otp') }}">
              @csrf
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <input type="hidden" name="order" value="{{ request('order') }}">
                <input type="number" name="otp" placeholder="OTP" class="border rounded h-12 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm">
                <button class="bg-indigo-600 hover:bg-indigo-700 px-12 py-3 text-white mt-8">Confirm</button>
                <span x-show="!show" class="text-green-500 font-semibold  px-12 py-3">Resend OTP in <span x-text="timer"></span> Seconds</span>
                <a x-show="show" href="{{ url('resend-otp?order='.request('order')) }}" class="text-green-500 hover:underline font-semibold  px-12 py-3 cursor-pointer">Resend OTP</a>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
</x-app-layout>
