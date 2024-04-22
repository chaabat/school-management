@extends('layouts.admin')
@section('absence')
<div class="p-4 h-screen sm:ml-64"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
    <div class="p-4 rounded-lg mt-14">
        <h1 class="text-center font-mono font-bold text-white text-2xl  mt-4 ">Student Absences</h1>

        <div class="w-full overflow-x-auto">
            @foreach($classes as $class)
            <h2 class="text-left font-mono font-bold text-blue mb-2 mt-8 text-xl"><span class="text-white">Classe : </span>{{ $class->name }}</h2>
            @php
                $absentStudents = collect();
                foreach($class->user as $student) {
                    $absences = $student->absences()->whereDate('date', now()->toDateString())->where('statut', 'absent')->get();
                    if ($absences->isNotEmpty()) {
                        $absentStudents->push($student);
                    }
                }
            @endphp

            @if($absentStudents->isEmpty())
            <tbody class="bg-white">
                <table class="w-full">
                    <thead>
                        <tr class="text-md font-bold tracking-wide text-center text-white bg-blue uppercase">
                            <th class="px-4 py-3 w-1/2">Student Name</th>
                            <th class="px-4 py-3 w-1/2">Absent Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td colspan="2" class="px-4 py-3 text-ms font-semibold border text-center">No absences in this class.</td>
                        </tr>
                    </tbody>
               
                </table>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="text-md font-bold tracking-wide text-center text-white bg-blue uppercase">
                            <th class="px-4 py-3 w-1/2">Student Name</th>
                            <th class="px-4 py-3 w-1/2">Absent Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($absentStudents as $student)
                        @php
                            $absences = $student->absences()->whereDate('date', now()->toDateString())->where('statut', 'absent')->get();
                        @endphp
                        @foreach($absences as $absence)
                        <tr class="text-black font-mono ">
                            <td class="px-4 py-3 border ">
                                <div class="flex items-center justify-center text-sm">
                                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full"
                                            src="{{ asset('users/' . $student->picture) }}" alt="Student Image" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-black">{{$student->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border text-center">{{ $absence->date }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif
            @endforeach
        </div>
        <div class="mt-8 flex justify-center bg-white font-mono">
            {{ $classes->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
