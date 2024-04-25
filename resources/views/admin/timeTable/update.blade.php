@extends('layouts.admin')

@section('timeTable.update')
    <div class="p-4 h-screen sm:ml-64"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
        <div class="p-4  rounded-lg  mt-14">
            <div class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 h-screen py-8">
                <div class="w-full flex items-center justify-center">
                  <div class=" rounded-lg shadow-lg flex-col w-5/6 sm:max-w-2xl px-6"
                  style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/classe2.jpg') }}') no-repeat center; background-size: cover;">

              
                    <div class="px-5 py-3 mb-3 text-3xl font-medium text-gray-800 mt-6">
                      <div class="text-center text-white font-mono font-bold">Update Time Table </div>
                    </div>
                  
                  
                    
                    <form action="{{ route('timeTable.update',  $timetable->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            @if ($errors->any())
                                <h2 class="text-xl font-mono font-bold text-blue">Validation errors:</h2>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-white">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                                
                    
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                                    <div class="grid grid-cols-1">
                    
                                        <label class="md:text-sm text-xs text-white text-light font-semibold">Classe:</label>
                                        <select name="classe_id" id="class_id" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                            <option>Choisir</option>
                                            @foreach ($classSubjects as $classSubject)
                                                @if ($classSubject->classe)
                                                    <option value="{{ $classSubject->classe->id }}">{{ $classSubject->classe->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                    
                                        <label class="md:text-sm text-xs text-white text-light font-semibold">Subject:</label>
                                        <select name="subject_id" id="subject_id" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                          
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <label class="md:text-sm text-xs text-white text-light font-semibold">Day:</label>
                                        <select name="days" id="days" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                        </select>
                    
                                        <label class="md:text-sm text-xs text-white text-light font-semibold">Time:</label>
                                        <select name="time" id="time" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                        </select>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center       my-6">
                                    <button type="submit" class="font-mono font-bold py-2 px-8 bg-blue-900 rounded-full text-white  hover:bg-orange cursor-pointer">
                                        Update
                                    </button>
                                </div>
                          
                    </form>
                </div>
              </div>
              
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var classSelect = document.getElementById('class_id');
            var subjectSelect = document.getElementById('subject_id');
            var timeSelect = document.getElementById('time');
            var classSubjects = @json($classSubjects);

           
            function populateTimeDropdown() {
                timeSelect.innerHTML = '';
                for (var hour = 8; hour <= 17; hour++) {
                    for (var minute = 0; minute < 60; minute += 60) {
                        var timeString = ('0' + hour).slice(-2) + ':' + ('0' + minute).slice(-2);
                        var option = document.createElement('option');
                        option.value = timeString;
                        option.textContent = timeString + ' - ' + ('0' + (hour + 1)).slice(-2) + ':' + ('0' +
                            minute).slice(-2);
                        timeSelect.appendChild(option);
                    }
                }
            }

            populateTimeDropdown();

            classSelect.addEventListener('change', function() {
                var selectedClassId = this.value;

                subjectSelect.innerHTML = '';

                var filteredSubjects = classSubjects.filter(function(classSubject) {
                    return classSubject.classe && classSubject.classe.id == selectedClassId;
                });

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
