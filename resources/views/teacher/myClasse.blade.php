@extends('layouts.teacher')
@section('myClasse')
<div class="p-4 h-screen sm:ml-64"
style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
<div class="p-4 rounded-lg mt-14">

            @if ($teacherClasses->count() > 0)
                @foreach ($teacherClasses as $teacherClasses)
                    <div class="bg-blue rounded-lg shadow-xl pb-8">
                        <div class="w-full h-[200px]">
                            <img src="{{ asset('photos/classe.jpg') }}" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                        </div>
                        <div class="flex flex-col items-center mt-4">
                            <p class="text-m text-orange font-mono font-bold">Class Name:</p>
                            <div class="flex items-center space-x-2 mt-2">
                                @if ($teacherClasses->classe)
                                    <p class="text-2xl font-mono font-bold text-white">{{ $teacherClasses->classe->name }}
                                    </p>
                                @else
                                    <p class="text-2xl font-mono font-bold text-white">No class associated</p>
                                @endif
                            </div>
                            <div class="flex mx-auto border-2 border-orange-500 rounded overflow-hidden mt-6">
                                <button class="py-1 px-4 text-white " onclick="openTab(event, 'student')">Students</button>
                                <button class="py-1 px-4 bg-orange-500 text-white "
                                    onclick="openTab(event, 'subject')">Subjects</button>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">

                        <div id="subject" class="tabcontent hidden ">
                            <div class="w-full flex flex-col 2xl:w-1/3">
                                <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                                    <h4 class="text-xl text-blue font-bold">Subjects</h4>
                                    <ul class="mt-2">
                                        @if ($teacherClasses->classe && $teacherClasses->classe->subjectToClass->count() > 0)
                                            <ul>
                                                @foreach ($teacherClasses->classe->subjectToClass as $subjectToClass)
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

                        <div id="student" class="tabcontent ">
                            <div class="w-full flex flex-col 2xl:w-1/3">
                                <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                                        <div class="w-full overflow-x-auto">
                                            <table class="w-full">
                                                <thead>
                                                    <tr
                                                        class="text-md font-bold tracking-wide font-mono text-center text-white bg-blue uppercase border-b border-white">
                                                        <th class="px-4 py-3 ">Student Name</th>
                                                        <th class="px-4 py-3 ">Date</th>
                                                        <th class="px-4 py-3 ">Statut</th>
                                                        <th class="px-4 py-3 ">Actions</th>
                                                </thead>
                                                <tbody class="bg-white">
                                                    @foreach ($teacherClasses->classe->user as $student)
                                                        <tr class="text-gray-700">
                                                            <td class="px-4 py-3 font-mono text-center  border">
                                                                <div class="flex items-center text-sm">
                                                                    <div
                                                                        class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                                        <img class="object-cover w-full h-full rounded-full"
                                                                            src="{{ asset('users/' . $student->picture) }}"
                                                                            alt="Student Image"  />
                                                                        <div class="absolute inset-0 rounded-full shadow-inner"
                                                                            aria-hidden="true"></div>
                                                                    </div>
                                                                    <div>
                                                                        <p class="font-semibold text-black">
                                                                            {{ $student->name }}</p>

                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="px-4 py-3 font-mono text-center  text-sm border">{{ now()->toDateString() }}
                                                            </td>

                                                            <td class="px-4 py-3 font-mono text-center  text-xs border absence-status" id="absence-status-{{ $student->id }}">
                                                                @php
                                                                    $absence = $student->absences()->whereDate('date', now()->toDateString())->first();
                                                                @endphp
                                                                @if ($absence)
                                                                    @if ($absence->statut === 'absent')
                                                                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm">Absent</span>
                                                                    @else
                                                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">Present</span>
                                                                    @endif
                                                                @else
                                                                    <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-sm">No record</span>
                                                                @endif
                                                            </td>
                                                            
                                                            


                                                            <td class="px-4 py-3 font-mono text-center  text-sm border">
                                                                <form class="absence-form" action="{{ route('addAbsence') }}" method="POST" data-absence-id="{{ $student->absence_id }}">
                                                                    @csrf
                                                                    <input type="hidden" name="user_id" value="{{ $student->id }}">
                                                                    <input type="hidden" name="date" value="{{ now()->toDateString() }}">
                                                                    <input type="hidden" name="absence_id" value="{{ $student->absence_id }}">
                                                                    <div class="flex items-center justify-center space-x-4">
                                                                        <button type="button" class="absence-btn" data-statut="present"><img src="{{asset('photos/present.png')}}" class="h-8" alt=""></button>
                                                                        <button type="button" class="absence-btn" data-statut="absent"><img src="{{asset('photos/absent.png')}}" class="h-8" alt=""></button>
                                                                    </div>
                                                                </form>
                                                                
                                                            </td>
                                                       
                                                            
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                @endforeach
            @else
                <div class="bg-blue rounded-lg shadow-xl pb-8">
                    <div class="w-full h-[200px]">
                        <img src="{{ asset('photos/classe.jpg') }}" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                    </div>
                    <div class="flex flex-col items-center mt-4">

                        <div class="flex items-center space-x-2 mt-2">
                            <p class="text-xl text-white font-mono">You are not assigned to any classes yet. Please contact
                                the administrator for assistance.</p>

                        </div>

                    </div>
                </div>
        </div>
        @endif

    </div>
    </div>
    <script src="js/absenceTeacher.js"></script>
    <script src="js/buttonSwitcher.js"></script>

@endsection
