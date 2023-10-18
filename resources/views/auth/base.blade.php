<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <title>@yield('title') | FOXDIGIA</title>
</head>

<body class="flex flex-col lg:flex-row bg-gray-50">
    <main class="w-full h-screen container mx-auto p-4">
        <section class="w-full h-full flex items-center justify-center">
            <div class="w-full grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                @yield('content')
            </div>
        </section>
    </main>
    <script src="{{ asset('js/index.js') }}"></script>
    @if (Session::has('message'))
        <script>
            const info = {!! json_encode(Session::all()) !!};
            const message = (Array.isArray(info.message) ? info.message : [info.message]).join("<br />");
            const type = info.type;
            (new Toaster({
                positionX: "right",
                positionY: "bottom",
                width: 500
            }))[type](message);
        </script>
    @endif
    <script>
        Program
            .ucfirst()
            .toggle()
            .password();
    </script>
    @yield('script')
</body>

</html>
