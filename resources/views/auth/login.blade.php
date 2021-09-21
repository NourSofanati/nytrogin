<!DOCTYPE html>
<html lang="ar-SA" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول الى نيتروجين</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body style="background: url('{{ asset('images/Background.svg') }}');background-size:cover;" class="h-screen">
    <div class="flex p-7 ">
        <img src="{{ asset('images/Logo.svg') }}" alt="Logo" class="w-[350px]">
    </div>
    <div class="grid place-items-center place-content-center w-full h-screen absolute top-0 left-0 right-0 bottom-0">
        @if (Session::has('message'))
            <div class="mb-4 bg-white bg-opacity-[96%] p-9 rounded-3xl w-[450px] text-white">
                <div class="font-medium text-red-600">{{ __('رمز الدخول خاطئ, يرجى المحاولة مرة اخرى') }}</div>
            </div>
        @endif
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}"
            class="bg-white bg-opacity-[18%] p-9 rounded-3xl w-[450px] text-white" autocomplete="off" id="loginForm">
            @csrf

            <div class="relative">
                <x-jet-input id="identifier" class="block mt-1 w-full bg-[#DFD7E3] pr-12 text-gray-700" type="text"
                    name="identifier" :value="old('identifier')" required autofocus placeholder="اسم المستخدم" />
                <span
                    class="absolute right-0 my-auto text-gray-400 border-gray-400 px-2 top-0 bottom-0 h-8 border-l-2 flex">
                    <div class="material-icons my-auto">
                        person
                    </div>
                </span>
            </div>
            <div class="relative">
                <x-jet-input id="password" class="block mt-1 w-full bg-[#DFD7E3] pr-12 text-gray-700" type="password"
                    name="password" :value="old('password')" required autofocus placeholder="{{ __('Password') }}" />
                <span
                    class="absolute right-0 my-auto text-gray-400 border-gray-400 px-2 top-0 bottom-0 h-8 border-l-2 flex">
                    <div class="material-icons my-auto">
                        lock
                    </div>
                </span>
            </div>
            <div class="grid w-full grid-cols-2 mt-8">
                <label for="remember_me" class="flex items-center text-white">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="mr-2 text-md text-white">{{ __('Remember me') }}</span>
                </label>
                {{-- @if (Route::has('password.request'))
                    <a class="text-md text-white flex" href="{{ route('password.request') }}">
                        <span class="material-icons my-auto ml-3">mail</span>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}
            </div>

            <div class="flex flex-col items-center justify-end mt-8">


                <button class="w-full bg-[#FCB637] text-center text-2xl tracking-tight py-2 rounded-2xl">
                    {{ __('طلب رمز الدخول') }}
                </button>
                <p class="mt-2"> {{ __('copyrights') }} </p>
            </div>
        </form>
        <form action="{{ route('loginOtp') }}"
            class="bg-white bg-opacity-[18%] p-9 rounded-3xl w-[450px] text-white hidden" autocomplete="off"
            id="otpForm" method="post">
            @csrf
            <input type="hidden" name="user_id" id="user_id" required>
            <h1 class="text-xl font-white">
                تم إرسال رمز الدخول لجوالك
            </h1>
            <div class="relative">
                <x-jet-input id="otp" class="block mt-1 w-full bg-[#DFD7E3] pr-12 text-gray-700" type="text" name="otp"
                    :value="old('otp')" required autofocus placeholder="رمز الدخول" />
                <span
                    class="absolute right-0 my-auto text-gray-400 border-gray-400 px-2 top-0 bottom-0 h-8 border-l-2 flex">
                    <div class="material-icons my-auto">
                        lock
                    </div>
                </span>
            </div>
            <div class="flex flex-col items-center justify-end mt-8">


                <button class="w-full bg-[#FCB637] text-center text-2xl tracking-tight py-2 rounded-2xl">
                    {{ __('Log in') }}
                </button>
                <p class="mt-2"> {{ __('copyrights') }} </p>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script>
        let user_id;
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('attemptLogin') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        user_id = response.user_id;
                        $('#loginForm').fadeOut();
                        $('#otpForm').delay(400).fadeIn();
                        document.querySelector('#user_id').value = user_id;
                    }
                }
            });
        });
    </script>
</body>

</html>
