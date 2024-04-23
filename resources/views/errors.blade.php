@extends('layouts.auth')
@section('errors')
<section class="flex items-center h-screen sm:p-16 dark:bg-gray-900 dark:text-gray-100" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/email.jpg') }}') no-repeat center;background-size:cover">
	<div class="container flex flex-col items-center justify-center px-5 mx-auto my-8 space-y-8 text-center sm:max-w-md">
        <a href="/"><img src="{{ asset('photos/mortier.png') }}" class="h-[100px]" alt=""></a> 
        
		<p class="text-2xl font-mono font-bold text-white">Unauthorized</p>
        <div class='flex space-x-2 justify-center items-center  dark:invert'>
             <div class='h-6 w-6 bg-white rounded-full animate-bounce [animation-delay:-0.3s]'></div>
           <div class='h-6 w-6 bg-white rounded-full animate-bounce [animation-delay:-0.15s]'></div>
           <div class='h-6 w-6 bg-white rounded-full animate-bounce'></div>
        </div>
		<a href="/" class="text-white bg-[#03045e] hover:bg-[#fb5607]   font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  ">
             Back To Homepage</a>
	</div>
    
</section>
@endsection

