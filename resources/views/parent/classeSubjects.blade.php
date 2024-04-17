@extends('layouts.parent')
@section('myChildrenSubjects')
    <div class="p-4 h-screen sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">

            @if ($classes->count() > 0)
                <div class="bg-blue rounded-lg shadow-xl pb-8">
                    @foreach ($classes as $class)
                        <div class="w-full h-[200px]">
                            <img src="{{ asset('photos/classe.jpg') }}" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                        </div>
                        <div class="flex flex-col items-center mt-4">
                            <p class="text-m text-orange font-mono font-bold">Class Name:</p>
                            <div class="flex items-center space-x-2 mt-2">
                                @if ($class->classe)
                                <p class="text-2xl font-mono font-bold text-white">{{ $class->classe->name }}</p>
                            @else
                                <p class="text-2xl font-mono font-bold text-white">No class associated</p>
                            @endif
                        </div>
                        <div class="flex mx-auto border-2 border-orange-500 rounded overflow-hidden mt-6">
                            <button class="py-1 px-4 bg-orange-500 text-white "
                                onclick="openTab(event, 'subject')">Subjects</button>
                            <button class="py-1 px-4 text-white "
                                onclick="openTab(event, 'time')">Time Table</button>
                        </div>
                             
                        </div>
                </div>
                <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                    <div id="subject" class="tabcontent hidden">
                    <div class="w-full flex flex-col 2xl:w-1/3">
                        <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                            <h4 class="text-xl text-blue font-bold">Subjects</h4>
                            <ul class="mt-2">
                                <li class="flex py-2">
                                    @if ($class->subjectToClass->count() > 0)
                                        <ul>
                                            @foreach ($class->subjectToClass as $subjectToClass)
                                                <li class="font-mono font-bold text-l">
                                                    <i class="fa-solid fa-minus mr-2" style="color: orange;"></i>
                                                    {{ $subjectToClass->subject->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No subjects assigned
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                    <div id="time" class="tabcontent hidden">

<p>date</p>
                </div>




            </div>
            @endforeach
        @else
            <p>No classes available.</p>
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
