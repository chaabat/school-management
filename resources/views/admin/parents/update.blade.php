@extends('layouts.admin')

@section('updateParent')
    <div class="p-4 sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">
 
            <form action="{{ route('parents.update', $parent->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <div class="flex justify-center items-center mb-4 space-x-6">
                        <input type="hidden" name="role_id" value="4">
                        <label class="block ">
                            <div class="shrink-0">
                                <img id='preview_img' class="h-20 w-20 object-cover rounded-full"
                                    src="{{ asset('users/' . $parent->picture) }}" alt="Current profile photo" />
                            </div>
                            <span class="sr-only ">Choose profile photo</span>
                            <input name="picture" type="file" onchange="loadFile(event)" class="hidden" />

                        </label>
                    </div>
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
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono">Nom
                                complet</label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                value="{{ $parent->name }}" type="text" name="name" placeholder="Jane">
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label
                                class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono">Date
                            </label>

                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                value="{{ $parent->date }}" type="date" name="date" placeholder="Doe">
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono">Email</label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                value="{{ $parent->email }}" type="email" name="email" placeholder="Jane">
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label
                                class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono">Password
                            </label>

                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="password" type="password" name="password" placeholder="Doe">
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono">Address</label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                value="{{ $parent->adress }}" type="text" name="adress" placeholder="Jane">
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono" for="grid-state">
                                Ville
                            </label>
                            <div class="relative">
                                <input id="ville" name="ville"  value="{{ $parent->ville }}"  class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                                    
                           
                            </div>
                        </div> 
                        <div class="md:w-1/2 px-3">
                            <label
                                class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono">Téléphone
                            </label>

                            <input
                                class=" block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                value="{{ $parent->phone }}" type="text" name="phone" placeholder="Doe">
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono"
                                for="grid-state">
                                Genre
                            </label>
                            <div class="relative">
                                <select name="genre" value="{{ $parent->genre }}"
                                    class=" block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                                    <option disabled selected="">Select Genre</option>
                                    <option value="masculin">Masculin</option>
                                    <option value="feminin">Féminin</option>

                                </select>

                            </div>
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono"
                                for="grid-state">
                                Student
                            </label>
                            <div class="relative">
                                <select name="child_id"
                                    class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                                    <option disabled selected>Select Student</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-l font-bold mb-2 font-mono"
                                for="grid-password">
                                Description
                            </label>
                            <textarea name="description" value="{{ $parent->description }}"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3"></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white  flex items-center justify-center  text-xl font-bold font-mono   bg-blue-900   rounded-lg  px-5 py-2.5  ">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Update

                    </button>
            </form>

        </div>
    </div>
 
 
@endsection
