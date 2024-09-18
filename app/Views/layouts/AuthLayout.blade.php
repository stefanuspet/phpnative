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
    <div class="w-full h-dvh bg-slate-100 ">
        <div class="w-full h-full flex justify-center items-center">
            <div class="bg-white w-[24rem] py-6 px-8 rounded-md shadow-lg">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>