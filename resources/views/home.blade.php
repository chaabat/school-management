@extends('layouts.auth')
@section('home')
@include('include.navbar')

<div class="w-full">
 
    <div class="flex  " style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/classe2.jpg') }}') no-repeat center; background-size: cover; ">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div class="mb-16 lg:my-40 lg:max-w-lg lg:pr-5 ">
                <p
                    class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-orange">
                    Brand new
                </p>
                <h2 class="mb-5 font-sans text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none">
                    Everything you<br class="hidden md:block" />
                    can imagine
                    <span class="inline-block text-deep-purple-accent-400">is real</span>
                </h2>
                <p class="pr-5 mb-5 text-base text-white md:text-lg">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam, eaque ipsa quae. explicabo.
                </p>
                
            </div>
        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <img class="object-cover w-full h-56 rounded shadow-lg lg:rounded-none lg:shadow-none md:h-96 lg:h-full"
            src="{{asset('photos/classe1.jpg')}}"
            alt="" />
          
            </div>
        </div>
    </div>
</div>
 

{{-- <section class="">
    <div class="bg-white text-white py-20"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="container mx-auto flex flex-col md:flex-row items-center my-12 md:my-24">
            <div class="flex flex-col w-full lg:w-1/3 justify-center items-start p-8">
                <h1 class="titre text-3xl md:text-5xl p-2 text-orange tracking-loose font-mono font-extrabold">Evento</h1>

                <p class="text-sm md:text-base text-white mb-4 font-mono">Explore your favourite events and
                    register now to showcase your talent and win exciting prizes.</p>

            </div>
            <div class="p-8 mt-12 mb-6 md:mb-0 md:mt-0 ml-0 md:ml-12 lg:w-2/3  justify-center">
                <div class="h-48 flex flex-wrap content-center">
                    <div>

                        <video class="inline-block h-[500px] rounded border-4 border-white mt-22 hidden xl:block"
                            src={{asset('photos/evento.mp4')}}
                            type="video/mp4" autoplay muted loop></video>
                    </div>

                </div>
            </div>
</section> --}}
@include('include.footer')
@endsection

    
   
