<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School-M</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/84d5a42f8d.js" crossorigin="anonymous"></script>

</head>

<body class="bg-white font-family-karla h-screen">

    @yield('home')
    @yield('login')
    @yield('forget')
    @yield('reset')
    @yield('waitPage')
    @yield('email')

</body>

</html>
