@extends('layouts.admin')
@section('parentDetails')
    <div class="p-4 h-full sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">

            <div class="bg-white rounded-lg shadow-xl pb-8">

                <div class="w-full h-[250px]">
                    <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg"
                        class="w-full h-full rounded-tl-lg rounded-tr-lg">
                </div>
                <div class="flex flex-col items-center -mt-20">
                    <img src="{{ asset('users/' . $parent->picture) }}"
                        class="w-40 h-40 border-4 border-white rounded-full">
                    <div class="flex items-center space-x-2 mt-2">
                        <p class="text-2xl font-mono ">{{ $parent->name }}</p>
                        <span class="bg-blue-500 rounded-full p-1" title="Verified">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                    <p class="text-m text-black font-mono font-bold">parent</p>
                </div>
                <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                    <div class="flex items-center space-x-4 mt-2">
                        <a href="{{ route('parents.edit', $parent->id) }}"><img src="{{ asset('photos/update.png') }}"
                                class="h-6" alt=""></a>
                        <a href="#"
                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this parent?')) { document.getElementById('delete-form-{{ $parent->id }}').submit(); }">
                            <img src="{{ asset('photos/delete.png') }}" class="h-6" alt="">
                        </a>

                        <form id="delete-form-{{ $parent->id }}" action="{{ route('parents.destroy', $parent->id) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>

            {{-- information perssonelle --}}
            <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                <div class="w-full flex flex-col 2xl:w-1/3">
                    <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                        <h4 class="text-xl text-gray-900 font-bold">Personal Info</h4>
                        <ul class="mt-2 text-gray-700">
                            <li class="flex border-y py-2">
                                <span class="font-bold w-24">Full name:</span>
                                <span class="text-gray-700">{{ $parent->name }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Birthday:</span>
                                <span class="text-gray-700">{{ $parent->date }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Email:</span>
                                <span class="text-gray-700">{{ $parent->email }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Genre:</span>
                                <span class="text-gray-700">{{ $parent->genre }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Mobile:</span>
                                <span class="text-gray-700">{{ $parent->phone }}</span>
                            </li>
                            {{-- <li class="flex border-b py-2">
                                <span class="font-bold w-24">Child:</span>
                                <span class="text-blue hover:text-orange font-mono font-bold underline"> <a href="{{ route('students.show', $child->id) }}">
                                        {{ $child->name }}
                                    </a></span>
                            </li> --}}
                        </ul>
                    </div>

                    {{-- Description --}}

                    <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">

                        <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                            <h4 class="text-xl text-gray-900 font-bold">Description</h4>
                            <p class="mt-2 text-gray-700">{{ $parent->description }}</p>
                        </div>
                    </div>

                </div>
            </div>
        @endsection
