<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <div class="w-full h-dvh" style="background-image: url('/assets/bg_auth.png'); background-size: cover; background-position: center;">
        <div class="w-full h-full grid grid-rows-3 place-items-center bg-[#2A508A] bg-opacity-70">
            <div class="flex items-center gap-x-10">
                <img src="/assets/logo_1.png" alt="logo_bandung_karate_club">
                <h1 class="font-bold text-white text-2xl text-center">Bandung <br> Karate Club</h1>
                <img src="/assets/logo_2.png" alt="logo_forki">
            </div>
            <div class="bg-white w-[24rem] py-6 px-8 rounded-md shadow-lg">
                @yield('content')
            </div>
        </div>
    </div>
</body>


</html>