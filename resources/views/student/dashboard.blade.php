@extends('layouts.student')

@section('dashboard')
    <div class="p-4 h-screen sm:ml-64" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover;">
        <div class="p-4 rounded-lg mt-14">
            @if ($canDownloadCertificate)
                <a href="{{ route('certificate') }}" class="text-white p-4 bg-blue rounded">Download Certificate</a>
            @else
                <button class="text-white p-4 bg-gray-400 rounded cursor-not-allowed" disabled>
                    You can't download
                </button>
            @endif
        </div>
    </div>
@endsection
