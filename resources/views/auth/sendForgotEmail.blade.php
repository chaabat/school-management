@extends('layouts.auth')
@section('email')
<section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
    <header>
        <a href="#">
            <img class="w-auto h-7 sm:h-8" src="{{ asset('photos/mortier.png') }}" alt="">
        </a>
    </header>

    <main class="mt-8">
        <h2 class="text-gray-700 dark:text-gray-200">Bonjour,</h2>

       
        
        <a href="{{ route('resetPassword', $token) }}" class="px-6 py-2 mt-4 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">Reset Password Link</a>

        
        <p class="mt-8 text-gray-600 dark:text-gray-300">
            Thanks, <br>
            School-M
        </p>
    </main>
    

    <footer class="mt-8">
        

        <p class="mt-3 text-gray-500 dark:text-gray-400">© CHAABAT. All Rights Reserved.</p>
    </footer>
</section> 
@endsection
