@extends('layouts.teacher')

@section('myTimeTable')
    <div class="p-4 h-full sm:ml-64" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4 rounded-lg mt-14">
            @foreach ($teacherTable as $teacherClass)
                <h1 class="font-mono font-bold text-xl text-orange mb-2">Classe: <span class="text-white">{{ $teacherClass->classe->name }}</span></h1>

                <table class="w-full">
                    <thead>
                        <tr class="text-l font-bold tracking-wide text-left text-white bg-blue uppercase border border-white">
                            <th class="px-6 py-4">Time / Days</th>
                            <th class="px-6 py-4">Monday</th>
                            <th class="px-6 py-4">Tuesday</th>
                            <th class="px-6 py-4">Wednesday</th>
                            <th class="px-6 py-4">Thursday</th>
                            <th class="px-6 py-4">Friday</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @for ($hour = 8; $hour <= 17; $hour++)
                            <tr>
                                <td class="px-4 py-3 text-m font-mono text-blue bg-gray-200 font-bold border">
                                    {{ $hour }}:00 - {{ $hour + 1 }}:00</td>
                                @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day)
                                    <td class="px-4 py-3 text-m font-mono text-blue text-center uppercase font-bold border">
                                        @foreach ($teacherClass->classe->timetable as $event)
                                            @if (date('H', strtotime($event->time)) == $hour && strtolower($event->days) == $day)
                                                {{ $event->subject->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>
            @endforeach
             
                <div class=" flex justify-center bg-white font-mono">
                    {{ $teacherTable->links('pagination::tailwind') }}
                </div>
             
        </div>
    </div>
@endsection
