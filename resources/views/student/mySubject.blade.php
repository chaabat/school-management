@extends('layouts.student')

@section('mySubject')
<div class="p-4 h-screen sm:ml-64" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
    <div class="p-4 rounded-lg mt-14">
        @if ($classes->count() > 0)
            <div class="bg-blue rounded-lg shadow-xl pb-8">
                @foreach ($classes as $class)
                    <div class="w-full h-[200px]">
                        <img src="{{ asset('photos/classe.jpg') }}" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                    </div>
                    <div class="flex flex-col items-center mt-4">
                        <p class="text-m text-orange font-mono font-bold">Class Name: </p>
                        <div class="flex items-center space-x-2 mt-2">
                            <p class="text-2xl font-mono font-bold text-white">{{ $class->name }}</p>
                        </div>
                        <div class="flex mx-auto border-2 border-orange-500 rounded overflow-hidden mt-6">
                            <button class="py-1 px-4 bg-orange-500 text-white" onclick="openTab(event, 'subject')">Subjects</button>
                            <button class="py-1 px-4 text-white" onclick="openTab(event, 'exam')">Exams</button>
                        </div>
                    </div>
            </div>

            <div id="subject" class="tabcontent">
                <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                    <div class="w-full flex flex-col 2xl:w-1/3">
                        <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                            <h4 class="text-xl text-blue font-bold">Subjects</h4>
                            <ul class="mt-2">
                                <li class="flex py-2">
                                    @if ($class->subjectToClass->count() > 0)
                                        <ul>
                                            @foreach ($class->subjectToClass as $subjectToClass)
                                                <li class="font-mono font-bold text-l"><i class="fa-solid fa-minus mr-2" style="color: orange;"></i>{{ $subjectToClass->subject->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                    <h4 class="text-l text-black font-bold text-center mt-4">No subjects assigned</h4>
                                        
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="exam" class="tabcontent hidden">
                <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                    <div class="w-full flex flex-col 2xl:w-1/3">
                        <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                            <h4 class="text-xl text-blue mb-4 font-bold">Upcoming Exams :</h4>
                            <div class="w-full overflow-x-auto">
                                @foreach ($classes as $class)
                                    @if ($class->exam->count() > 0)
                                        <table class="w-full text-center border-collapse rounded">
                                            <!-- Table headers -->
                                            <thead>
                                                <tr class="text-md font-mono font-bold text-center tracking-wide text-white bg-blue uppercase">
                                                    <th class="px-4 py-3 border border-white w-1/2">Exam</th>
                                                    <th class="px-4 py-3 border border-white w-1/2">Date</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody class="bg-white">
                                                @foreach ($class->exam as $exam)
                                                    <tr class="text-gray-700">
                                                        <td class="px-4 py-3 text-m text-black font-mono font-bold border border-black">{{ $exam->name }}</td>
                                                        <td class="px-4 py-3 text-m text-green-600 font-mono font-bold border border-black">{{ $exam->date }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <h4 class="text-l text-black font-bold text-center mt-4">No Exams assigned</h4>
                                    @endif
                                @endforeach
                            </div>
                            </div>
                            </div>
                        </div>
                            
                            <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                                <div class="w-full flex flex-col 2xl:w-1/3">
                                    <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                            <h4 class="text-xl text-blue mb-4 font-bold">Previous Exams :</h4>
                            <div class="w-full overflow-x-auto">
                                @if ($previousExams->count() > 0)
                                    <table class="w-full text-center border-collapse rounded">
                                        <!-- Table headers -->
                                        <thead>
                                            <tr class="text-md font-mono font-bold text-center tracking-wide text-white bg-blue uppercase">
                                                <th class="px-4 py-3 border border-white w-1/2">Exam</th>
                                                <th class="px-4 py-3 border border-white w-1/2">Date</th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody class="bg-white">
                                            @foreach ($previousExams as $exam)
                                                <tr class="text-gray-700">
                                                    <td class="px-4 py-3 text-m text-black font-mono font-bold border border-black">{{ $exam->name }}</td>
                                                    <td class="px-4 py-3 text-m text-red-600 font-mono font-bold border border-black">{{ $exam->date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h4 class="text-l text-black font-bold text-center mt-4">No Previous Exams</h4>
                                @endif
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
                        <p class="text-xl text-white font-mono">You are not assigned to any classes yet. Please contact the administrator for assistance.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.add("hidden");
        }
        tablinks = document.getElementsByTagName("button");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("bg-orange-500");
        }
        document.getElementById(tabName).classList.remove("hidden");
        evt.currentTarget.classList.add("bg-orange-500");
    }
</script>
@endsection
