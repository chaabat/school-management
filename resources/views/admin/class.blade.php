@extends('layouts.admin')
@section('class')
    <div class="p-4 h-screen sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "{{ session('success') }}",

                    });
                </script>
            @endif
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
                        Classes
                    </span>
                </div>
            </div>
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
                                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                                <button id="defaultModalButton" data-modal-target="defaultModal"
                                    data-modal-toggle="defaultModal"
                                    class="flex items-center justify-center text-white bg-[#03045e] hover:bg-[#fb5607]   font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Class
                                </button>
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
                            <div class="mx-auto max-w-screen-xl px-4 w-full mt-12 mb-12">
                                <div class="grid w-full sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                    @foreach ($classes as $class)
                                     
                                        <div
                                        class=" class-card border-4 border-[#fb5607] relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
            
                                        <div class="bg-white py-4 px-3"  style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/classe1.jpg') }}') no-repeat center;background-size:cover">
                                            <h1 class="text-3xl text-white text-center mb-2 font-bold font-mono">{{ $class->name }}
                                            </h1>
                                            <div class="flex justify-between">
            
                                                <span data-modal-target="update-modal" data-modal-toggle="update-modal">

                                                    <a href="#" id="defaultModalButton" data-modal-target="update"
                                                        data-modal-toggle="update" class="edit-class"
                                                        data-class-id="{{ $class->id }}"
                                                        data-class-name="{{ $class->name }}"><img
                                                            src="{{ asset('photos/update.png') }}"
                                                            class="h-6"alt=""></a>
                                                </span>




                                                <a href="#"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this Class ?')) { document.getElementById('delete-form-{{ $class->id }}').submit(); }">
                                                    <img src="{{ asset('photos/delete.png') }}" class="h-6"
                                                        alt="">
                                                </a>

                                                <form id="delete-form-{{ $class->id }}"
                                                    action="{{ route('delete.class', $class->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                        <!-- "Nothing found" message -->
                        <div style="display: none;"
                            class="search-not-found bg-white flex flex-col items-center justify-center px-4 md:px-8 lg:px-24 py-8 rounded-lg">
                            <p class="text-6xl md:text-7xl lg:text-9xl font-bold font-mono text-[#fb5607]">404</p>
                            <p class="text-2xl md:text-3xl lg:text-5xl font-bold font-mono text-[#03045e] mt-4">Recherche
                                introuvable</p>
                        </div>
                        <nav class="flex flex-col md:flex-row justify-end items-end md:items-center space-y-3 md:space-y-0 p-4"
                            aria-label="Table navigation">

                            <div class="mt-8 flex justify-center bg-white font-mono">
                                {{ $classes->links('pagination::tailwind') }}
                            </div>
                        </nav>
                    </div>
                </div>
            </section>


            {{-- ajouter class  --}}

            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-2 w-full max-w-2xl h-full md:h-auto">

                    <div class="relative p-4   bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">

                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Class Form
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="defaultModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <form action="{{ route('create.class') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                    <input type="text" name="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Class Name">
                                </div>


                                <div>
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                                    <select name="statut"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="activer">Activer</option>
                                        <option value="desactiver">Desactiver</option>

                                    </select>
                                </div>


                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Ajouter
                            </button>
                        </form>
                    </div>
                </div>
            </div>




            {{-- Modifier course  --}}

            <div id="update" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-2 w-full max-w-2xl h-full md:h-auto">

                    <div class="relative p-4   bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">

                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Class Form
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="update">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <form action="{{ route('update.class') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">

                                <input type="hidden" name="id" id="id">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="le nom de class" required="">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                                    <select name="statut" id="statut"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="activer">Activer</option>
                                        <option value="desactiver">Desactiver</option>

                                    </select>
                                </div>




                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>



            <script src="js/updateClasse.js"></script>
            <script src="js/searchClasse.js"></script>
        @endsection
