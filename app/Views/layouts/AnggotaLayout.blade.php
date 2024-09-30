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
    <div class="bg-slate-100">
        <div class="flex h-screen overflow-hidden">
            @include('components.AnggotaSidebar')
            <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
                <main>
                    <div class="container mx-auto max-w-screen-2xl py-8 px-10 md:px-14 2xl:px-18">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>