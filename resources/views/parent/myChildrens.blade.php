@extends('layouts.parent')
@section('myChildren')
<div class="p-4 h-screen sm:ml-64"
style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
<div class="p-4 rounded-lg mt-14">
            @if ($children->isEmpty())
            <div class="bg-blue rounded-lg shadow-xl pb-8">
                <div class="w-full h-[200px]">
                    <img src="{{ asset('photos/classe.jpg') }}" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                </div>
                <div class="flex flex-col items-center mt-4">
    
                    <div class="flex items-center space-x-2 mt-2">
                        <p class="text-xl text-white font-mono">No childrens available </p>
    
                    </div>
    
                </div>
            </div>
            @else
                @foreach ($children as $child)
                    <div class="mt-4 flex flex-row rounded-lg border-4 border-white bg-blue p-6">
                  
                        <div class="relative">
                         
                            <img class="w-40 h-40 rounded-md object-cover" src="{{ asset('users/' . $child->picture) }}"
                                alt="User" />


                        </div>

                   
                        <div
                            class=" w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center  justify-between px-5 py-4 rounded-md">
                            <div>
                                <span class="text-orange font-mono font-bold text-m">Student</span>
                                <h3 class="font-bold font-mono mt-px text-white ">{{ $child->name }}</h3>
                                <div class="flex items-center gap-3 mt-2">
                                    <span
                                        class=" bg-orange text-blue font-mono font-bold rounded-full px-3 py-1 text-sm">{{ $child->genre }}</span>
                                    <span class="text-white font-mono font-bold text-m"> {{ $child->email }}</span>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>


                        <div class="w-100 flex flex-grow flex-col items-end justify-start">
                            <div class="flex flex-row space-x-3">

                                <a href="{{ route('myChildrenSubjects', ['id' => $child->id]) }}">
                                    <img src="{{asset('photos/voir.png')}}" class="h-8" alt="">

                                </a>


                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>
@endsection
