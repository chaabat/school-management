@extends('layouts.admin')
@section('parent')
    <div class="p-2 h-screen sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">
{{-- 
            <div>
                <div class="inline-block relative py-1 text-md w-24">
                    <div class="absolute inset-0 text-[#fb5607] flex">
                        <svg height="100%" viewBox="0 0 50 100">
                            <path
                                d="M49.9,0a17.1,17.1,0,0,0-12,5L5,37.9A17,17,0,0,0,5,62L37.9,94.9a17.1,17.1,0,0,0,12,5ZM25.4,59.4a9.5,9.5,0,1,1,9.5-9.5A9.5,9.5,0,0,1,25.4,59.4Z"
                                fill="currentColor" />
                        </svg>
                        <div class="flex-grow h-full -ml-px bg-[#03045e]   rounded-md rounded-l-none"></div>
                    </div>
                    <span class="relative flex items-center justify-center text-white font-semibold">
                        Parents
                    </span>
                </div>
            </div> --}}

            <section class=" p-3 sm:p-5">

                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-72 md:w-1/2">
                                <form class="flex items-center">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Search" required="">
                                    </div>

                                </form>
                            </div>

                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <a href="{{ route('parents.create') }}"
                                    class="flex items-center justify-center text-white  bg-[#03045e] hover:bg-[#fb5607] focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">

                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Parent
                                </a>
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <button
                                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                        type="button">

                                        Actions
                                    </button>



                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            {{-- card start  --}}
                            <div
                                class="grid max-w-6xl grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                @foreach ($parents as $parent)
                                    <div
                                        class="parent-card bg-[#03045e] hover:bg-[#fb5607] flex flex-col items-center p-4  rounded-xl">
                                        <img class="object-cover w-14 h-14 rounded-full ring-4 ring-white"
                                            src="{{ asset('users/' . $parent->picture) }}" alt="">

                                        <h1
                                            class="mt-4 text-xl font-semibold font-mono text-white capitalize dark:text-white group-hover:text-white">
                                            {{ $parent->name }}</h1>

                                        <div class="flex mt-3 -mx-2 space-x-4">
                                            <a href="{{ route('parents.show', $parent->id) }}"><img
                                                    src="{{ asset('photos/show.png') }}" class="h-6" alt=""></a>


                                            <a href="{{ route('parents.edit', $parent->id) }}"><img
                                                    src="{{ asset('photos/update.png') }}" class="h-6"
                                                    alt=""></a>

                                            <a href="#"
                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this parent?')) { document.getElementById('delete-form-{{ $parent->id }}').submit(); }">
                                                <img src="{{ asset('photos/delete.png') }}" class="h-6" alt="">
                                            </a>

                                            <form id="delete-form-{{ $parent->id }}"
                                                action="{{ route('parents.destroy', $parent->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- card end  --}}
                        </div>
                        {{-- Search not found  --}}
                        <div style="display: none;" class="search-not-found bg-white flex flex-col items-center justify-center px-4 md:px-8 lg:px-24 py-8 rounded-lg  ">
                            <p class="text-6xl md:text-7xl lg:text-9xl font-bold font-mono text-[#fb5607]">4<span class="text-[#03045e]">0</span>4</p>
                            <p class="text-2xl md:text-3xl lg:text-5xl font-bold font-mono text-[#03045e] mt-4">Recherche introuvable</p>
                              
                        </div>

                        {{-- Pagination  --}}
                        <nav class="flex flex-col md:flex-row justify-end items-end md:items-center space-y-3 md:space-y-0 p-4"
                            aria-label="Table navigation">

                            <div class="mt-8 flex justify-center bg-white font-mono">
                                {{ $parents->links('pagination::tailwind') }}
                            </div>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <script src="js/searchParent.js"></script>

    

    
    
@endsection
