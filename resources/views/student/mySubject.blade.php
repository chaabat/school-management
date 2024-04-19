@extends('layouts.student')

@section('mySubject')
    <div class="p-4 h-screen sm:ml-64"
        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
        <div class="p-4 rounded-lg mt-14">
            @if ($classes->count() > 0)
                <div class="bg-blue rounded-lg shadow-xl pb-8">
                    @foreach ($classes as $class)
                        <div class="w-full h-[200px]">
                            <img src="{{ asset('photos/classe.jpg') }}" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                        </div>
                        <div class="flex flex-col items-center mt-4">

                            <p class="text-m text-orange font-mono font-bold">classe Name : </p>
                            <div class="flex items-center space-x-2 mt-2">
                                <p class="text-2xl font-mono font-bold text-white">{{ $class->name }}</p>

                            </div>
                            <div class="flex mx-auto border-2 border-orange-500 rounded overflow-hidden mt-6">
                                <button class="py-1 px-4 bg-orange-500 text-white "
                                    onclick="openTab(event, 'subject')">Subjects</button>
                                <button class="py-1 px-4 text-white " onclick="openTab(event, 'exam')">Exams</button>
                            </div>
                        </div>
                </div>

                <div id="subject" class="tabcontent ">
                    <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                        <div class="w-full flex flex-col 2xl:w-1/3">
                            <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                                <h4 class="text-xl text-blue font-bold">Subjects</h4>
                                <ul class="mt-2 ">
                                    <li class="flex  py-2">
                                        @if ($class->subjectToClass->count() > 0)
                                            <ul>
                                                @foreach ($class->subjectToClass as $subjectToClass)
                                                    <li class="font-mono font-bold text-l"><i class="fa-solid fa-minus mr-2"
                                                            style="color: orange;"></i>{{ $subjectToClass->subject->name }}
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
            @endif
        </div>
        <div id="exam" class="tabcontent hidden">

            <div class="flex flex-wrap -mx-4">
                <!-- Pricing Table 1 -->
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-semibold text-gray-800">Basic Plan</h2>
                        <div class="mt-4">
                            <span class="text-5xl font-bold text-gray-900">$19</span>
                            <span class="text-gray-600">/month</span>
                        </div>
                        <ul class="mt-6 space-y-2">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Unlimited Access
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                24/7 Customer Support
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Premium Features
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="#"
                                class="block w-full bg-indigo-500 hover:bg-indigo-400 text-white font-semibold text-center py-2 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">Get
                                Started</a>
                        </div>
                    </div>
                </div>

                <!-- Pricing Table 2 -->
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-semibold text-gray-800">Pro Plan</h2>
                        <div class="mt-4">
                            <span class="text-5xl font-bold text-gray-900">$39</span>
                            <span class="text-gray-600">/month</span>
                        </div>
                        <ul class="mt-6 space-y-2">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Unlimited Access
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                24/7 Customer Support
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Premium Features
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="#"
                                class="block w-full bg-indigo-500 hover:bg-indigo-400 text-white font-semibold text-center py-2 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">Get
                                Started</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
