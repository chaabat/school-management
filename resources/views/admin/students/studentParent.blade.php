@extends('layouts.admin')
@section('student-parent')
<div class="p-4 h-screen sm:ml-64"
style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
<div class="p-4 rounded-lg mt-14">


            <section class=" p-3 sm:p-5">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <div class="overflow-x-auto">
                     
                        <div class="flex justify-center items-center mt-20  ">

                            @if ($parent)
                                <div
                                    class=" relative flex flex-col items-center rounded-[20px] w-[800px] mx-auto p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                                    <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover">
                                        <img src="{{asset('photos/classe2.jpg')}}"
                                            class="absolute flex h-32 w-full justify-center rounded-xl bg-cover">
                                        <div
                                            class="absolute -bottom-12 flex h-[87px] w-[87px] items-center justify-center ">
                                            <img class="h-full w-full rounded-full"
                                                src="{{ asset('users/' . $child->picture) }}" alt="">
                                            <img class="h-14 w-14 rounded-full"
                                                src="{{ asset('users/' . $parent->picture) }}" alt="">
                                        </div>

                                    </div>
                                    <div
                                        class="bg-blue mt-4 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center  justify-between px-5 py-4 rounded-md">
                                        <div>
                                            <span class="text-orange text-l font-mono ">Student :</span>
                                            <h3 class="font-bold mt-px">
                                                <p class="text-m font-mono text-white">{{ $child->name }}</p>
                                            </h3>
                                            <div class="flex items-center gap-3 mt-2">

                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ route('students.show', $child->id) }}">
                                                <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-blue mt-2 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center  justify-between px-5 py-4 rounded-md">
                                        <div>
                                            <span class="text-orange text-l font-mono">Parent :</span>
                                            <h3 class="font-bold mt-px">
                                                <p class="text-m font-mono text-white">{{ $parent->name }}</p>

                                            </h3>
                                            <div class="flex items-center gap-3 mt-2">

                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ route('parents.show', $parent->id) }}">
                                                <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                            </a>
                                        </div>
                                    </div>


                                </div>

                        </div>
                    @else
                        <div
                            class="relative flex flex-col items-center rounded-[20px] w-[400px] mx-auto p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 ">
                            <p>No parent found for this child.</p>
                        </div>
                        @endif
                    </div>

                    {{-- card end  --}}


                </div>
        </div>
        </section>
    </div>
    </div>


    <script src="js/searchParent.js"></script>
@endsection
