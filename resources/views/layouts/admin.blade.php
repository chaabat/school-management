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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    

    <title>Document</title>
</head>

<body>
    @include('include.sideAdmin')

    @yield('dashboard')
    @yield('admin')
    @yield('absence')

    @yield('exam')
    @yield('updateExam')


    @yield('subject')
    @yield('updateSubject')

    @yield('subjectToClass')
    @yield('updateSubjectToClasse')
    
    
    @yield('teacherToClass')
    @yield('updateTeacherToClasse')
    

    @yield('class')
    @yield('updateClasse')

    


    @yield('timeTable')
    @yield('timeTable.create')
    @yield('timeTable.update')
    
  

    @yield('admin')
    @yield('addAdmin')
    @yield('updateAdmin')


    @yield('parent')
    @yield('addParent')
    @yield('updateParent')
    @yield('parentDetails')
    @yield('parent-student')


    @yield('teacher')
    @yield('addTeacher')
    @yield('updateTeacher')
    @yield('teacherDetails')
    

    @yield('student')
    @yield('addStudent')
    @yield('updateStudent')
    @yield('studentDetails')
    @yield('student-parent')




    <script src="{{ asset('js/pictureInput.js') }}"></script>

</body>

</html>
