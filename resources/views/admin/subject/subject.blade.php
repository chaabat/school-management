@extends('layouts.admin')
@section('subject')
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
            <form action="{{ route('subjects.store') }}" method="POST">
                
                @csrf
                <div class="w-full flex items-center justify-center">
                    <div class="rounded-lg shadow-lg flex-col w-5/6 sm:max-w-2xl px-6"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/classe2.jpg') }}') no-repeat center; background-size: cover;">

                        <div>
                            @if ($errors->any())
                                <h2 class="text-xl font-mono font-bold text-blue">Validation errors:</h2>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-white">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
            
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                            <div class="grid grid-cols-1">
            
                                <label class="md:text-sm text-xs text-white text-light font-semibold">Nom</label>
                                <input type="text" name="name" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
            
                                 
                            </div>
                            <div class="grid grid-cols-1">
                                 
            
                                <label class="md:text-sm text-xs text-white text-light font-semibold">Statut</label>
                                <select name="statut"   class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                    <option value="activer">Activer</option>
                                        <option value="desactiver">Desactiver</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-center  my-6">
                            <button type="submit" class="font-mono font-bold py-2 px-8 bg-blue-900 rounded-full text-white  hover:bg-orange cursor-pointer">
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
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2     "
                                            placeholder="Search" required="">
                                    </div>
                                
                            </div>

                         
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <div
                                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-l font-bold font-mono text-white focus:outline-none bg-blue rounded-lg      ">

                                    Subjects
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <div class="mx-auto max-w-screen-xl px-4 w-full mt-12 mb-12">
                                <div class="subjectData grid w-full sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                    @foreach ($subjects as $subject)
                                        <div
                                            class=" class-card border-4 border-[#03045e] relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">

                                            <div class="bg-white py-4 px-3"
                                                style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/classe2.jpg') }}') no-repeat center;background-size:cover">
                                                <h1 class="text-3xl text-white text-center mb-2 font-bold font-mono">
                                                    {{ $subject->name }}
                                                </h1>
                                                <div class="flex justify-between">

                                                    <a href="{{ route('subjects.edit',$subject->id) }}">
                                                        <img src="{{ asset('photos/update.png') }}" class="h-6" alt="">
                                                    </a>




                                                    <a href="#"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this Class ?')) { document.getElementById('delete-form-{{ $subject->id }}').submit(); }">
                                                        <img src="{{ asset('photos/delete.png') }}" class="h-6"
                                                            alt="">
                                                    </a>

                                                    <form id="delete-form-{{ $subject->id }}"
                                                        action="{{ route('subjects.destroy', $subject->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div style="display: none;"
                                class="search-not-found bg-white flex flex-col items-center justify-center px-4 md:px-8 lg:px-24 py-8 rounded-lg">
                                <p class="text-6xl md:text-7xl lg:text-9xl font-bold font-mono text-[#fb5607]">404</p>
                                <p class="text-2xl md:text-3xl lg:text-5xl font-bold font-mono text-[#03045e] mt-4">Recherche
                                    introuvable</p>
                            </div>
                            </div>
                        </div>
                        <div class=" flex justify-center bg-white font-mono">
                            {{ $subjects->links('pagination::tailwind') }}
                        </div>
                    </div>
                     
                  
                        
                     
                </div>
        </div>
        </section>

    </div>
  
    <script src="js/searchSubject.js"></script>
@endsection
