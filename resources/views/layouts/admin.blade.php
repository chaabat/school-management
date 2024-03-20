<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/84d5a42f8d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    @include('include.sideAdmin')

    @yield('dashboard')
    @yield('admin')


    @yield('parent')
    @yield('addParent')
    @yield('updateParent')


    @yield('teacher')
    @yield('addTeacher')
    @yield('updateTeacher')

    @yield('student')
    @yield('addStudent')
    @yield('updateStudent')



    <script src="{{ asset('js/pictureInput.js') }}"></script>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
</body>

</html>
