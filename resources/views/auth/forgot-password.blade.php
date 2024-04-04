@extends('layouts.auth')
@section('forget')
    <div class="w-full flex flex-wrap">

        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                <a href="#" class="bg-black text-white font-bold text-xl p-4">Logo</a>
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Welcome.</p>
                <form action="{{ route('forgot') }}" method="post" class="flex flex-col pt-3 md:pt-8">
                    @csrf
                    @method('post')
                    <div class="flex flex-col pt-4">
                        <label class="text-lg">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>


                    <button type="submit"
                        class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Send</button>
                </form>

                <div class="text-center pt-12 pb-12">
                    <p>Do you have an account? <a href="{{ route('login') }}" class="underline font-semibold">Login
                            here.</a>
                    </p>
                </div>
            </div>

        </div>

        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="https://source.unsplash.com/IXUM4cJynP0">
        </div>
    </div>
@endsection
