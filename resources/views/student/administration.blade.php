@extends('layouts.student')

@section('administration')
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
             <div class="items-center  space-y-8 mx-4 mb-12">
                <div
                  class="max-w-7xl sm:mx-auto flex flex-row items-center bg-blue p-4 md:p-3  font-medium rounded-3xl ">
                  <div class="flex flex-col md:flex-row justify-between items-center text-gray-300">
                    <div class="flex-initial inline-flex w-full md:w-8/12 items-center text-justify text-sm pr-4">
                      <span class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-orange" viewBox="0 0 20 20"
                          fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                        </svg>
                      </span>
                      Notice: "Vous pouvez télécharger votre attestation de scolarité une fois par semaine. Si vous avez besoin d'aide, veuillez nous contacter."
                    </div>
                    <div class="flex flex-row gap-x-2 md:gap-x-5 mt-4 md:mt-0">
                        @if ($certificate)
                      <a href="{{ route('Studentcertificate') }}"
                        class="uppercase px-2 md:px-1 lg:px-3 rounded-md py-3 text-center text-sm bg-orange text-white font-bold font-mono">Télécharger ici</a>
                      @else
                         <button class="uppercase px-2 md:px-1 lg:px-3 rounded-md py-3 text-center text-sm bg-red-600 text-white font-bold font-mono cursor-not-allowed" disabled>
                        You can't download
                           </button>
                      @endif
                    </div>
                  </div>
                </div>
                <form action="{{ route('send-message') }}" method="POST" class="form bg-white p-6 my-10 relative">
                    @csrf
                    <div class="icon bg-blue text-white w-6 h-6 absolute flex items-center justify-center p-5" style="left:-40px">
                        <i class="fal fa-phone-volume fa-fw text-2xl transform -rotate-45"></i>
                    </div>
                    <h3 class="text-2xl text-gray-900 font-semibold">Contact Us</h3>
                     
                    <input type="hidden" name="role" value="Student">
                    
                    <input type="text" name="name" placeholder="Your Name" class="border p-2 w-full mt-3">
                    <input type="email" name="email" placeholder="Your Email" class="border p-2 w-full mt-3">
                    <textarea name="message" cols="10" rows="3" placeholder="Tell us about desired property" class="border p-2 mt-3 w-full"></textarea>
                    <div>
                        @if ($errors->any())
                            <h2 class="text-xl font-mono font-bold text-red-600">Please check :</h2>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <input type="submit" value="Submit" class="w-full mt-6 bg-blue-900 hover:bg-orange text-white font-semibold p-3">
               
                </form>
        </div>
    </div>
@endsection