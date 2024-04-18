@extends('layouts.student')
@section('certificate')
<h1>Certificate</h1>
<p>Name: {{ $student->name }}</p>
<p>Grade: {{ $student->genre }}</p>
 
@endsection