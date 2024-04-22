@extends('layouts.admin')
@section('student-parent')
<div class="p-4 h-screen sm:ml-64"
style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
<div class="p-4 rounded-lg mt-14">


            <section class=" p-3 sm:p-5">

                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">



                    <div class="overflow-x-auto">
                        {{-- card start  --}}



                        <div class="flex justify-center items-center scroll">
                            <div
                                class="relative flex flex-col items-center rounded-[20px] w-[800px] mx-auto p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                                <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover">
                                    <img src="{{ asset('photos/classe2.jpg') }}"
                                        class="absolute flex h-32 w-full justify-center rounded-xl bg-cover">


                                </div>
                                @foreach ($children as $child)
                                    <div
                                        class="bg-blue mt-2 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md">
                                        <div>
                                            <span class="text-orange text-l font-mono">Student :</span>
                                            <div class="flex justify-center items-center space-x-4 mt-2">
                                                <img src="{{ asset('users/' . $child->picture) }}"
                                                    class="flex-shrink-0 object-cover rounded-full btn- w-10 h-10" />

                                                <h3 class="font-bold mt-px">
                                                    <p class="text-m font-mono text-white">{{ $child->name }}</p>
                                                </h3>
                                            </div>
                                            <div class="flex items-center gap-3 mt-2"></div>
                                        </div>
                                        <div>
                                            <a href="{{ route('students.show', $child->id) }}">
                                                <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                                <div
                                    class="bg-blue mt-2 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md">
                                    <div>
                                        <span class="text-orange text-l font-mono">Parent :</span>

                                        <div class="flex justify-center items-center space-x-4 mt-2">
                                            <img src="{{ asset('users/' . $parent->picture) }}"
                                                class="flex-shrink-0 object-cover rounded-full btn- w-10 h-10" />

                                            <h3 class="font-bold mt-px">
                                                <p class="text-m font-mono text-white">{{ $parent->name }}</p>
                                            </h3>
                                        </div>
                                        <div class="flex items-center gap-3 mt-2"></div>
                                    </div>
                                    <div>
                                        <a href="{{ route('parents.show', $parent->id) }}">
                                            <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- card end  --}}


                </div>
        </div>
        </section>
    </div>
    </div>
@endsection
