@extends('layouts.parent')
@section('myChildren')
    <div class="p-4 h-screen sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">
            @if ($children->isEmpty())
                <p>No children found.</p>
            @else
                @foreach ($children as $child)
                    <div class="mt-4 flex flex-row rounded-lg border border-gray-200/80 bg-white p-6">
                        <!-- Avaar Container -->
                        <div class="relative">
                            <!-- User Avatar -->
                            <img class="w-40 h-40 rounded-md object-cover" src="{{ asset('users/' . $child->picture) }}"
                                alt="User" />


                        </div>

                        <!-- Meta Body -->
                        <div
                            class=" w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center  justify-between px-5 py-4 rounded-md">
                            <div>
                                <span class="text-blue font-mono font-bold text-m">Student</span>
                                <h3 class="font-bold font-mono mt-px">{{ $child->name }}</h3>
                                <div class="flex items-center gap-3 mt-2">
                                    <span
                                        class=" bg-orange text-blue font-mono font-bold rounded-full px-3 py-1 text-sm">{{ $child->genre }}</span>
                                    <span class="text-slate-600 text-sm flex gap-1 items-center"> {{ $child->email }}</span>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>


                        <div class="w-100 flex flex-grow flex-col items-end justify-start">
                            <div class="flex flex-row space-x-3">

                                <a href="{{ route('myChildrenSubjects', ['id' => $child->id]) }}"
                                    class="flex rounded-md bg-blue-500 py-2 px-8 text-white transition-all duration-150 ease-in-out hover:bg-blue-600">
                                    Classe & Subjects
                                </a>


                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>
@endsection
