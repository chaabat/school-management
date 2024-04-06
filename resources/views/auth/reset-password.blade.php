@extends('layouts.auth')
@section('reset')
    <div class="w-full flex flex-wrap">

        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
               <a href="/"><img src="{{ asset('photos/mortier.png') }}" class="h-[80px]" alt=""></a> 
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl font-mono font-bold text-[#03045e]">Welcome.</p>
                <form action="{{ route('reset') }}" method="post" class="flex flex-col pt-3 md:pt-8">
                    @csrf
                    @method('post')
                    <input type="text" hidden value="{{ $token }}" name="token">
                    <div class="flex flex-col pt-4">
                        <label class="text-lg font-mono font-bold">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex flex-col pt-4">
                        <label class="text-lg font-mono font-bold">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex flex-col pt-4">
                        <label class="text-lg font-mono font-bold">Password Confirmation</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Password Confirmation"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button type="submit"
                        class="bg-[#03045e] hover:bg-[#fb5607] text-white font-bold font-mono text-lg  p-2 mt-8 rounded">Reset</button>
                </form>


            </div>

        </div>

        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="{{ asset('photos/reset.jpg') }}">
        </div>
    </div>
@endsection
