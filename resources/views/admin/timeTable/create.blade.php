@extends('layouts.admin')
@section('timeTable.create')
<div class="p-4 h-screen sm:ml-64"
style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center; background-size: cover; overflow-y: scroll;">
<div class="p-4 rounded-lg mt-14">
        
            <form action="{{ route('timeTable.store') }}" method="POST">
                @csrf
                <div class="w-full flex items-center justify-center">
                    <div class=" rounded-lg shadow-lg flex-col w-5/6 sm:max-w-2xl px-6"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/classe2.jpg') }}') no-repeat center; background-size: cover;">

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
                                    @foreach ($classSubjects->groupBy('classe_id') as $classId => $subjects)
                                        @if ($subjects->first()->classe)
                                            <option value="{{ $classId }}">{{ $subjects->first()->classe->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
            
                                <label class="md:text-sm text-xs text-white text-light font-semibold">Subject:</label>
                                <select name="subject_id" id="subject_id" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                  
                                </select>
                            </div>
                            <div class="grid grid-cols-1 ">
                                <label class="md:text-sm text-xs text-white text-light font-semibold">Day:</label>
                                <select name="days" id="days" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                    <option value="monday">Monday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="wednesday">Wednesday</option>
                                    <option value="thursday">Thursday</option>
                                    <option value="friday">Friday</option>
                                </select>
            
                                <label class="md:text-sm text-xs text-white text-light font-semibold">Statut:</label>
                                <select name="time" id="time" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-center       my-6">
                            <button type="submit" class="font-mono font-bold py-2 px-8 bg-blue-900 rounded-full text-white  hover:bg-orange cursor-pointer">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
            <table class="w-full mt-4">
                <thead>
                  <tr class="text-md font-semibold tracking-wide text-left text-white bg-blue uppercase border-y  border-white">
                    <th class="px-4 py-3 border-x ">Classe</th>
                    <th class="px-4 py-3 border-x ">Subject</th>
                    <th class="px-4 py-3 border-x ">Day</th>
                    <th class="px-4 py-3 border-x ">Time</th>
                    <th class="px-4 py-3 border-x text-center">Actions</th>
                  </tr>
                </thead>

                 
                    <tbody  class="bg-white">
                        @foreach ($tables as $table)
                           
                     
                            <tr>
                                <td class="px-4 py-3 text-m font-mono text-orange bg-gray-200 font-bold  border">{{ $table->classe->name }}</td>

                                <td class="px-4 py-3 text-m font-mono text-blue bg-gray-200 font-bold  border">{{ $table->subject->name ?? 'No Subject' }}</td>
                                <td class="px-4 py-3 text-m font-mono text-blue bg-gray-200 font-bold  border">{{ ucfirst($table->days) }}</td>
                                <td class="px-4 py-3 text-m font-mono text-blue bg-gray-200 font-bold  border">{{ $table->time }}</td>
                                <td class="px-4 py-3 text-m font-mono text-blue bg-gray-200 font-bold border">
                                    <div class="flex mt-3 -mx-2 space-x-4 justify-center">
                                        <a href="{{ route('timeTable.show', $table->classe_id) }}"><img
                                            src="{{ asset('photos/show.png') }}" class="h-6" alt=""></a>
                                    <a href="{{ route('timeTable.edit', $table->id) }}"><img
                                        src="{{ asset('photos/update.png') }}" class="h-6"
                                        alt=""></a>
                                    <form action="{{ route('timeTable.destroy', $table->id) }}" method="POST"  >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="{{ asset('photos/delete.png') }}" class="h-6" alt=""></button>
                                    </form>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <div class="mt-8 flex justify-center bg-white font-mono">
                    {{ $tables->links('pagination::tailwind') }}
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
