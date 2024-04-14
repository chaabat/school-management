@extends('layouts.admin')
@section('timeTable.create')
<div class="p-4 h-screen sm:ml-64"
    style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
    <div class="p-4  rounded-lg  mt-14">

        <form action="{{ route('timeTable.store') }}" method="POST">
            @csrf
            <div>
                <div>
                    @if ($errors->any())
                        <h2 class="text-xl font-mono font-bold text-[#fb5607]">Validation errors:</h2>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <label for="class_id">Class:</label>
                <select name="class_id" id="class_id">
                    @foreach ($classSubjects as $classSubject)
                        @if ($classSubject->classe)
                            <option value="{{ $classSubject->classe->id }}">{{ $classSubject->classe->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="subject_id">Subject:</label>
                <select name="subject_id" id="subject_id">
                    <!-- Options will be dynamically populated via JavaScript -->
                </select>
            </div>
            <div>
                <label>Day of Week:</label>
                <select name="days" id="days">
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select>
            </div>
            <div>
                <label for="time">Time Slot:</label>
                <select name="time" id="time">
                    <!-- Options will be dynamically populated via JavaScript -->
                </select>
            </div>
            <button type="submit">Add Timetable Entry</button>
        </form>
        
    </div>
</div>

 <script>
    document.addEventListener('DOMContentLoaded', function() {
        var classSelect = document.getElementById('class_id');
        var subjectSelect = document.getElementById('subject_id');
        var timeSelect = document.getElementById('time');
        var classSubjects = @json($classSubjects);

        // Function to populate the time dropdown
        function populateTimeDropdown() {
            timeSelect.innerHTML = ''; // Clear existing options
            for (var hour = 8; hour <= 17; hour++) {
                for (var minute = 0; minute < 60; minute += 60) {
                    var timeString = ('0' + hour).slice(-2) + ':' + ('0' + minute).slice(-2);
                    var option = document.createElement('option');
                    option.value = timeString;
                    option.textContent = timeString + ' - ' + ('0' + (hour + 1)).slice(-2) + ':' + ('0' + minute).slice(-2);
                    timeSelect.appendChild(option);
                }
            }
        }

        // Initial population of time dropdown
        populateTimeDropdown();

        classSelect.addEventListener('change', function() {
            var selectedClassId = this.value;

            // Clear existing options
            subjectSelect.innerHTML = '';

            // Filter subjects based on the selected class
            var filteredSubjects = classSubjects.filter(function(classSubject) {
                return classSubject.classe && classSubject.classe.id == selectedClassId;
            });

            // Populate subjects dropdown with filtered subjects
            filteredSubjects.forEach(function(classSubject) {
                if (classSubject.subject) {
                    var option = document.createElement('option');
                    option.value = classSubject.subject.id;
                    option.textContent = classSubject.subject.name;
                    subjectSelect.appendChild(option);
                }
            });
        });
    });
</script>
 

 
@endsection