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
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased h-screen flex">
    <div class="hidden md:block" id="sidebar">
        @include('navigation-menu')
    </div>

    <div class="max-h-screen w-full bg-[#F6F8FC] overflow-y-auto">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white border-b-2 border-[#E9EAEB] ">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between">
                        <div class="lg:w-1/3 md:w-10/12 hidden md:block">
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm material-icons">
                                        search
                                    </span>
                                </div>
                                <input type="text" name="search" id="search"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 pl-12 mb-3 border-gray-300 rounded-md"
                                    placeholder="ابحث..." autocomplete="off">
                                <div id="searchresults" class="absolute bg-white border-2 w-full shadow-2xl hidden p-2">

                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between w-full md:w-auto">
                            <a href="#test" id="show_sidebar">
                                <span class="material-icons text-gray-400 px-4 py-2 my-auto">
                                    menu
                                </span>
                            </a>
                            <div class="flex">
                                <a href="">
                                    <span class="material-icons text-gray-400 my-auto px-4 py-2">
                                        settings
                                    </span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="material-icons text-gray-400 my-auto px-4 py-2">
                                        logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

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
</script>
@yield('footerScripts')
@yield('footerScripts2')

</html>
