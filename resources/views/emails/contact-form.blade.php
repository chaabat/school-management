@component('mail::message')
# New Contact Form Submission

**Name:** {{ $data['name'] }}

**Email:** {{ $data['email'] }}

**Role:** {{ $data['role'] }}

**Message:**
{{ $data['message'] }}
@endcomponent
 