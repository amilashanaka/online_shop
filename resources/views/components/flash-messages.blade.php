
@if ($message = Session::get('error'))
<div class="my-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
  <strong class="font-bold">Error!</strong>
  <span class="block sm:inline">{{$message}}</span>
</div>
@endif


@if ($message = Session::get('success'))
<div class="my-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
  <strong class="font-bold">Success!</strong>
  <span class="block sm:inline">{{$message}}</span>
</div>
@endif
