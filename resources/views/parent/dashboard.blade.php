@extends('layouts.parent')
@section('dashboard')
<div class="p-4 h-screen sm:ml-64"
style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
<div class="p-4 rounded-lg mt-14">

             
              
                <div class="bg-gray-200 p-8 rounded-xl shadow-xl flex items-center justify-between   border-4 border-blue mt-14 ">
                    <div class="flex space-x-6 items-center">
                        <img src="{{ asset('photos/students.png') }}" class="w-auto h-14 rounded-lg" />

                        <div>
                            <p class="font-bold font-mono text-orange text-xl"> {{$children}}</p>
                            <p class="font-bold font-mono  text-l text-black">childrens</p>
                        </div>
                    </div>

                  
                </div>
              
              
       
      

                <div class="mt-14 flex flex-row rounded-lg border-4 border-white bg-blue p-6">
                  
                    <div class="relative">
                     
                        <img class="w-40 h-40 rounded-md object-cover" src="{{ asset('users/' . Auth::user()->picture) }}"
                            alt="User" />


                    </div>

               
                    <div
                        class=" w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center  justify-between px-5 py-4 rounded-md">
                        <div>
                            <span class="text-orange font-mono font-bold text-m">Parent</span>
                            <h3 class="font-bold font-mono mt-px text-white ">{{Auth::user()->name}}</h3>
                            <div class="flex items-center gap-3 mt-2">
                                <span
                                    class=" bg-orange text-white font-mono font-bold rounded-full px-3 py-1 text-sm">{{Auth::user()->genre}}</span>
                                <span class="text-white font-mono font-bold text-m"> {{Auth::user()->email}}</span>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>


                    <div class="w-100  flex flex-grow flex-col items-end justify-start">
                        <div class="flex flex-row space-x-3">
                            
                                <div class="w-32 flex-none rounded-t lg:rounded-t-none lg:rounded-l text-center shadow-lg ">
                                    <div class="block rounded-t overflow-hidden  text-center ">
                                        <div class="bg-orange text-white font-bold font-mono text-l py-1">
                                            {{ \Carbon\Carbon::now()->format('F') }}
                                        </div>
                                        <div class="pt-1 border-l border-r border-white bg-white">
                                            <span class="text-5xl font-bold  font-mono">
                                                {{ \Carbon\Carbon::now()->format('d') }}
                                          </span>
                                        </div>
                                        <div class="border-l border-r border-b rounded-b-lg text-center border-white bg-white -pt-2 -mb-1">
                                            <span class="font-bold font-mono text-l">
                                                {{ \Carbon\Carbon::now()->format('l') }}
                                          </span>
                                        </div>
                                        <div class="pb-2 border-l border-r border-b rounded-b-lg text-center border-white bg-white">
                                            <span class="font-bold font-mono text-l text-blue">
                                                {{ \Carbon\Carbon::now()->format('g:i ') }} 
                                          </span>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            
        </div>
    </div>
@endsection