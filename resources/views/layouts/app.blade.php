<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TRN</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <style>
          .loader {
            border-top-color: #3498db;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
          }

          @-webkit-keyframes spinner {
            0% {
              -webkit-transform: rotate(0deg);
            }
            100% {
              -webkit-transform: rotate(360deg);
            }
          }

          @keyframes spinner {
            0% {
              transform: rotate(0deg);
            }
            100% {
              transform: rotate(360deg);
            }
          }
        </style>


    </head>
    <body class="font-[Nunito] antialiased">
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>



        @if (session('success'))
          <div id="popup-msg" class="fixed bottom-10 md:right-20 bg-green-500 text-white px-12 py-2 rounded-md">{{ session('success') }}</div>  
        @elseif(session('error'))
          <div id="popup-msg" class="fixed bottom-10 md:right-20 bg-red-500 text-white px-12 py-2 rounded-md">{{ session('error') }}</div>  
        @endif

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireScripts
        <script>
            $(document).ready(function(){ 

                $("#popup-msg").delay(3200).fadeOut(300);

                $("#img").change(function() {
                  if (this.files) {
                    var files = event.target.files;
                    var reader = new FileReader();
                    reader.onload = function(e) {
                      $('#image_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                  }
                });
            });
        </script>
    </body>
</html>
