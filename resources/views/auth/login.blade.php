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
</head>

<body style="background: url('{{ asset('images/Background.svg') }}');background-size:cover;" class="h-screen">
    <div class="flex p-7 ">
        <img src="{{ asset('images/Logo.svg') }}" alt="Logo" class="w-[350px]">
    </div>
    <div class="grid place-items-center place-content-center w-full h-screen absolute top-0 left-0 right-0 bottom-0">
        <x-jet-validation-errors class="mb-4 bg-white bg-opacity-[96%] p-9 rounded-3xl w-[450px] text-white" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}"
            class="bg-white bg-opacity-[18%] p-9 rounded-3xl w-[450px] text-white" autocomplete="off">
            @csrf

            <div class="relative">
                <x-jet-input id="email" class="block mt-1 w-full bg-[#DFD7E3] pr-12 text-gray-700" type="email"
                    name="email" :value="old('email')" required autofocus placeholder="اسم المستخدم" />
                <span
                    class="absolute right-0 my-auto text-gray-400 border-gray-400 px-2 top-0 bottom-0 h-8 border-l-2 flex">
                    <div class="material-icons my-auto">
                        person
                    </div>
                </span>
            </div>

            <div class="mt-8 relative">
                <x-jet-input id="password" class="block mt-1 w-full bg-[#DFD7E3] pr-12 text-gray-700" type="password"
                    name="password" required autocomplete="current-password" placeholder="كلمة المرور" />
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
                @if (Route::has('password.request'))
                    <a class="text-md text-white flex" href="{{ route('password.request') }}">
                        <span class="material-icons my-auto ml-3">mail</span>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex flex-col items-center justify-end mt-8">


                <button class="w-full bg-[#FCB637] text-center text-2xl tracking-tight py-2 rounded-2xl">
                    {{ __('Log in') }}
                </button>
                <p class="mt-2"> جميع الحقوق محفوظة لـ نيتروجين © 2020 </p>
            </div>
        </form>
    </div>
</body>

</html>
