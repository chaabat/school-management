@extends('layouts.teacher')
@section('myClasse')
    <div class="p-4 h-full sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">

            @if ($teacherClasses->count() > 0)
                @foreach ($teacherClasses as $teacherClass)
                    <div class="bg-blue rounded-lg shadow-xl pb-8">
                        <div class="w-full h-[200px]">
                            <img src="{{ asset('photos/classe.jpg') }}" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                        </div>
                        <div class="flex flex-col items-center mt-4">
                            <p class="text-m text-orange font-mono font-bold">Class Name:</p>
                            <div class="flex items-center space-x-2 mt-2">
                                @if ($teacherClass->classe)
                                    <p class="text-2xl font-mono font-bold text-white">{{ $teacherClass->classe->name }}</p>
                                @else
                                    <p class="text-2xl font-mono font-bold text-white">No class associated</p>
                                @endif
                            </div>
                            <div class="flex mx-auto border-2 border-orange-500 rounded overflow-hidden mt-6">
                                <button class="py-1 px-4 bg-orange-500 text-white "
                                    onclick="openTab(event, 'subject')">Subjects</button>
                                <button class="py-1 px-4 text-white "
                                    onclick="openTab(event, 'student')">Students</button>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">

                        <div id="subject" class="tabcontent  ">
                            <div class="w-full flex flex-col 2xl:w-1/3">
                                <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                                    <h4 class="text-xl text-blue font-bold">Subjects</h4>
                                    <ul class="mt-2"  >
                                        @if ($teacherClass->classe && $teacherClass->classe->subjectToClass->count() > 0)
                                            <ul>
                                                @foreach ($teacherClass->classe->subjectToClass as $subjectToClass)
                                                    <li class="font-mono font-bold text-l">
                                                        <i class="fa-solid fa-minus mr-2"
                                                            style="color: orange;"></i>{{ $subjectToClass->subject->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No subjects assigned</p>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div id="student" class="tabcontent hidden">
                            <div class="w-full flex flex-col 2xl:w-1/3">
                                <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                                    <h4 class="text-xl text-blue font-bold">Students</h4>
                                    <ul class="mt-2">
                                        @if ($teacherClass->classe && $teacherClass->classe->user->count() > 0)
                                         
                                            @foreach ($teacherClass->classe->user as $student)
                                            
                                                <div class="flex items-center space-x-4">
                                                    <img src="{{ asset('users/' . $student->picture) }}" class="rounded-full h-14 w-14" alt="">
                                                    <div class="flex flex-col space-y-2">
                                                        <span class="text-m text-black font-mono font-bold">{{ $student->name }}</span>
                                                    
                                                    </div>
                                                
                                                </div>
                                            @endforeach
                                        @else
                                        
                                            <p>No students in this class</p>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No classes available.</p>
            @endif
        </div>
    </div>


    <script src="js/myClasseTeacher.js"></script>

@endsection
