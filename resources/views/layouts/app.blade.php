<!DOCTYPE html>
<html lang="ar-SA" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased h-screen flex">
    @include('sweetalert::alert')
    <div class="hidden lg:block bg-[#E5E6E7]" id="sidebar">
        @include('navigation-menu')
    </div>

    <div class="max-h-screen w-full bg-[#F6F8FC] overflow-y-auto">


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white border-b-2 border-[#E9EAEB] ">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end">
                        <div class="flex justify-between md:w-auto">
                            <a href="#test" id="show_sidebar" class="lg:hidden">
                                <span class="material-icons text-gray-400 px-4 py-2 my-auto ">
                                    menu
                                </span>
                            </a>
                            <button class="flex text-gray-400  px-4 py-2" onclick="window.history.back();">
                                <p class="ml-4 font-semibold">
                                    الرجوع
                                </p>

                                <span class="material-icons  my-auto">
                                    keyboard_backspace
                                </span>


                            </button>
                        </div>
                    </div>
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="___class_+?17___">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script>
        let progress = null;
        $('#search').on('propertychange input', function(e) {
            var valueChanged = false;
            if (e.type == 'propertychange') {
                valueChanged = e.originalEvent.propertyName == 'value';
            } else {
                valueChanged = true;
            }
            if (valueChanged && e.target.value.trim() != '') {
                try {
                    progress.abort();
                } catch {}
                progress = $.ajax({
                    type: "GET",
                    url: "{{ route('search') }}?text=" + e.target.value,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let html = ``;
                        response.forEach(element => {
                            html += `<li><a>
                            ${element.name}
                        </a></li>`;
                        });
                        $('#searchresults').html(html);
                        $('#searchresults').fadeIn();

                    }
                });
            }
        });
        $('#search').focusout(function() {
            try {
                progress.abort();
            } catch (error) {

            }
            $('#searchresults').html(``);
            $('#searchresults').fadeOut();
        });
        $('#show_sidebar').click(function(e) {
            $('#sidebar').fadeIn();
            $('#sidebar').toggleClass('hidden');
        });
        $('#hide_sidebar').click(function(e) {
            $('#sidebar').fadeOut();
        });
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register(window.location.origin + '/sw.js');
        }
    </script>
    @yield('footerScripts')
    @yield('footerScripts2')
    @stack('custom-scripts')

</body>



</html>
