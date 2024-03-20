@extends('layouts.admin')
@section('dashboard')
    <div class="p-4 sm:ml-64">
        <div class="p-4  rounded-lg  mt-14">

            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 mt-3">
                <div class="bg-blue-200 p-8 rounded-xl shadow-xl flex items-center justify-between mt-4">
                    <div class="flex space-x-6 items-center">
                        <img src="{{ asset('photos/administrateur.png') }}" class="w-auto h-24 rounded-lg" />
                        <div>
                            <p class="font-bold font-mono  text-xl">250</p>
                            <p class="font-bold font-mono  text-l text-gray-400">Total Admin</p>
                        </div>
                    </div>

                    <div class="flex space-x-2 items-center">
                        <div class="bg-gray-300 rounded-md p-2 flex items-center">
                            <i class="fas fa-chevron-right fa-l text-black"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-red-200 p-8 rounded-xl shadow-xl flex items-center justify-between mt-4">
                    <div class="flex space-x-6 items-center">
                        <img src="https://i.pinimg.com/originals/25/0c/a0/250ca0295215879bd0d53e3a58fa1289.png"
                            class="w-auto h-24 rounded-lg" />
                        <div>
                            <p class="font-bold font-mono  text-xl">250</p>
                            <p class="font-bold font-mono  text-l text-gray-400">Total Teachers</p>
                        </div>
                    </div>

                    <div class="flex space-x-2 items-center">
                        <div class="bg-gray-300 rounded-md p-2 flex items-center">
                            <i class="fas fa-chevron-right fa-l text-black"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-green-200 p-8 rounded-xl shadow-xl flex items-center justify-between mt-4">
                    <div class="flex space-x-6 items-center">
                        <img src="https://i.pinimg.com/originals/25/0c/a0/250ca0295215879bd0d53e3a58fa1289.png"
                            class="w-auto h-24 rounded-lg" />
                        <div>
                            <p class="font-bold font-mono  text-xl">250</p>
                            <p class="font-bold font-mono  text-l text-gray-400">Total Students</p>
                        </div>
                    </div>

                    <div class="flex space-x-2 items-center">
                        <div class="bg-gray-300 rounded-md p-2 flex items-center">
                            <i class="fas fa-chevron-right fa-l text-black"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-200 p-8 rounded-xl shadow-xl flex items-center justify-between mt-4">
                    <div class="flex space-x-6 items-center">
                        <img src="https://i.pinimg.com/originals/25/0c/a0/250ca0295215879bd0d53e3a58fa1289.png"
                            class="w-auto h-24 rounded-lg" />
                        <div>
                            <p class="font-bold font-mono  text-xl">250</p>
                            <p class="font-bold font-mono  text-l text-gray-400">Total Parents</p>
                        </div>
                    </div>

                    <div class="flex space-x-2 items-center">
                        <div class="bg-gray-300 rounded-md p-2 flex items-center">
                            <i class="fas fa-chevron-right fa-l text-black"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-200 p-8 rounded-xl shadow-xl flex items-center justify-between mt-4">
                    <div class="flex space-x-6 items-center">
                        <img src="https://i.pinimg.com/originals/25/0c/a0/250ca0295215879bd0d53e3a58fa1289.png"
                            class="w-auto h-24 rounded-lg" />
                        <div>
                            <p class="font-bold font-mono  text-xl">250</p>
                            <p class="font-bold font-mono  text-l text-gray-400">Total Parents</p>
                        </div>
                    </div>

                    <div class="flex space-x-2 items-center">
                        <div class="bg-gray-300 rounded-md p-2 flex items-center">
                            <i class="fas fa-chevron-right fa-l text-black"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-200 p-8 rounded-xl shadow-xl flex items-center justify-between mt-4">
                    <div class="flex space-x-6 items-center">
                        <img src="https://i.pinimg.com/originals/25/0c/a0/250ca0295215879bd0d53e3a58fa1289.png"
                            class="w-auto h-24 rounded-lg" />
                        <div>
                            <p class="font-bold font-mono  text-xl">250</p>
                            <p class="font-bold font-mono  text-l text-gray-400">Total Parents</p>
                        </div>
                    </div>

                    <div class="flex space-x-2 items-center">
                        <div class="bg-gray-300 rounded-md p-2 flex items-center">
                            <i class="fas fa-chevron-right fa-l text-black"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
