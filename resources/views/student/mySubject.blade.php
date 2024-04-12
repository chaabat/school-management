@extends('layouts.student')

@section('mySubject')
<div class="p-4 h-screen sm:ml-64" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
    <div class="p-4 rounded-lg mt-14">
        @if($classes->count() > 0)
        <div class="bg-blue rounded-lg shadow-xl pb-8">
            @foreach($classes as $class)
            <div class="w-full h-[200px]">
                <img src="{{asset('photos/classe.jpg')}}"
                    class="w-full h-full rounded-tl-lg rounded-tr-lg">
            </div>
            <div class="flex flex-col items-center mt-4">
                
                <p class="text-m text-orange font-mono font-bold">classe Name : </p>
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl font-mono font-bold text-white">{{ $class->name }}</p>
                    
                </div>
            </div>
             
        </div>

    
        <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
            <div class="w-full flex flex-col 2xl:w-1/3">
                <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                    <h4 class="text-xl text-blue font-bold">Subjects</h4>
                    <ul class="mt-2 ">
                        <li class="flex  py-2">
                            @if($class->subjectToClass->count() > 0)
                            <ul>
                                @foreach($class->subjectToClass as $subjectToClass)
                                    <li class="font-mono font-bold text-l"><i class="fa-solid fa-minus mr-2" style="color: orange;"></i>{{ $subjectToClass->subject->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            No subjects assigned
                        @endif
                        </li>
                        
                    </ul>
                </div>
                @endforeach
                @else
                <p>No classes available.</p>
                @endif
    </div>
</div>
@endsection
