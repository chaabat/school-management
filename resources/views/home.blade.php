@extends('layouts.auth')
@section('home')
@include('include.navbar')

<div class="w-full">
 
    <div class="flex  " style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/classe2.jpg') }}') no-repeat center; background-size: cover; ">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div class="mb-16 lg:my-40 lg:max-w-lg lg:pr-5 ">
                <p
                    class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-orange">
                   SCHOOL-M
                </p>
                <h2 class="mb-5  text-3xl font-bold font-mono tracking-tight text-gray-900 sm:text-4xl sm:leading-none">
                    Everything you
                    can imagine
                     
                </h2>
                <p class="pr-5 mb-5 text-base font-mono text-white md:text-lg">
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

@include('include.footer')
@endsection

    
   
