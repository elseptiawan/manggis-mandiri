<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" name="description">
    <meta content="AdminKit" name="author">
    <meta
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"
        name="keywords">

    <link href="https://fonts.gstatic.com" rel="preconnect">

    <link href="https://demo-basic.adminkit.io/pages-blank.html" rel="canonical" />

    <title>Dashboard</title>

    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper">
        @include('Layout.sidebar')

        <div class="main">
            @include('Layout.bar')

            <main class="content">
                @yield('content')
            </main>

            @yield('footer')
        </div>
    </div>

    <script src="{{ asset('dist/js/app.js') }}"></script>

</body>

</html>
