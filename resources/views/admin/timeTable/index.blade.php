@extends('layouts.admin')

@section('timeTable')
<div class="p-4 h-screen sm:ml-64" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
    <div class="p-4  rounded-lg  mt-14">
        <div class="container">
            <h1>Class: {{ $class->name }}</h1>
            <div id="calendar">
                <table>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($hour = 8; $hour <= 17; $hour++)
                            <tr>
                                <td>{{ $hour }}:00 - {{ $hour + 1 }}:00</td>
                                @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day)
                                    <td>
                                        @foreach ($timetable as $event)
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
            </div>
        </div>
    </div>
</div>
@endsection
