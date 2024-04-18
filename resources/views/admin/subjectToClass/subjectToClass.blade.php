@extends('layouts.admin')
@section('subjectToClass')
<div class="p-4 h-screen sm:ml-64"
style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
<div class="p-4 rounded-lg mt-14">

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "{{ session('success') }}",

                    });
                </script>
            @endif
            <form action="{{ route('subject-to-class.store') }}" method="POST">
                @csrf
                <div class="w-full flex items-center justify-center">
                    <div class="bg-gray-100 rounded-lg shadow-lg flex-col w-5/6 sm:max-w-2xl px-6">
                        <div>
                            @if ($errors->any())
                                <h2 class="text-xl font-mono font-bold text-[#fb5607]">Validation errors:</h2>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <hr class="border-1 border-gray-300">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                            <div class="grid grid-cols-1">

                                <label class="md:text-sm text-xs text-gray-600 text-light font-semibold">Classe</label>
                                <select name="classe_id" id="classe"
                                    class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                    @foreach ($classes as $classe)
                                        <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                                    @endforeach
                                </select>


                            </div>
                            <div class="grid grid-cols-1">

                                <label class="md:text-sm text-xs text-gray-600 text-light font-semibold">Subject</label>
                                <select name="subject_id" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1">


                            <label class="md:text-sm text-xs text-gray-600 text-light font-semibold">Time:</label>
                            <select name="statut" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                <option value="activer">Activer</option>
                                <option value="desactiver">Desactiver</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-center  my-6">
                            <button type="submit"
                                class="font-mono font-bold py-2 px-8 bg-blue-900 rounded-full text-white  hover:bg-orange cursor-pointer">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Id</th>
                                        <th scope="col" class="px-4 py-3">Classe</th>
                                        <th scope="col" class="px-4 py-3">Subject</th>
                                        <th scope="col" class="px-4 py-3">Status</th>
                                        <th scope="col" class="px-4 py-3">Date de création </th>
                                        <th scope="col" class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjetToClasse as $class)
                                        <tr class="class-row border-b dark:border-[#03045e]">
                                            <th class="px-4 py-3 font-mono text-[#fb5607] font-bold">{{ $class->id }}
                                            </th>
                                            <td class="px-4 py-3 font-mono text-black font-bold">
                                                {{ $class->classe->name ?? 'No Class' }}</td>
                                            <td class="px-4 py-3 font-mono text-black font-bold">
                                                {{ $class->subject->name ?? 'No Subject' }}</td>
                                            <td class="px-4 py-3 font-mono text-black font-bold">{{ $class->statut }}</td>
                                            <td class="px-4 py-3 font-mono text-black font-bold">{{ $class->created_at }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="flex space-x-4 items-right">
                                                    <a href="{{ route('subject-to-class.edit',$class->id) }}">
                                                        <img src="{{ asset('photos/update.png') }}" class="h-6"
                                                            alt="">
                                                    </a>

                                                    <a href="#"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this Class ?')) { document.getElementById('delete-form-{{ $class->id }}').submit(); }">
                                                        <img src="{{ asset('photos/delete.png') }}" class="h-6"
                                                            alt="">
                                                    </a>

                                                    <form id="delete-form-{{ $class->id }}"
                                                        action="{{ route('subject-to-class.destroy', $class->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                {{ $subjetToClasse->links('pagination::tailwind') }}
                            </div>
                        </nav>
                    </div>
                </div>
            </section>





            <script src="js/updateSubjectToClasse.js"></script>
            <script src="js/searchSubjectToCLasse.js"></script>

        </div>
    </div>
@endsection
