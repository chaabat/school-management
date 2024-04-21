<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimeTableRequest;
use App\Http\Requests\TimeTableUpdateRequest;
use App\RepositoriesInterfaces\TimeTableRepositoryInterface;  
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Subject;
use App\Models\SubjetToClass;
use App\Models\TimeTable;

class TimeTableController extends Controller
{
    private $timeTableRepository;

    public function __construct(TimeTableRepositoryInterface $timeTableRepository)
    {
        $this->timeTableRepository = $timeTableRepository;
    }
    
    public function index()
    {
        $classSubjects =  $this->timeTableRepository->getClassSubjects();
        $tables = $this->timeTableRepository->getAllTimeTable(5); 
    
        return view('admin.timeTable.create', compact('classSubjects', 'tables'));
    }
    
    public function store(TimeTableRequest $request)
    {
        $validatedData = $request->validated();  
        
        $this->timeTableRepository->createTimeTable($validatedData);  

        return redirect()->route('timeTable.index', $request->class_id)->with('success', 'Timetable entry added successfully.');
    }

    public function show($classId)
    {
       $class = $this->timeTableRepository->getClassById($classId);
        $timetable = $this->timeTableRepository->getTimeTableByClassId($classId);
        $subjects = $this->timeTableRepository->getSubjectsByClassId($classId);
     
        return view('admin.timeTable.details', compact('class', 'timetable', 'subjects'));
    }

    public function edit($id)
    {
        $timetable = $this->timeTableRepository->getTimeTableById($id);
        $class = $this->timeTableRepository->getClassById($timetable->classe_id);
        $classSubjects = $this->timeTableRepository->getSubjectsForClass($timetable->classe_id);
        $subjects = $class->subjectToClass()->get();
        
        return view('admin.timeTable.update', compact('timetable','class','subjects','classSubjects'));
    }

    public function update(TimeTableUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();  

        $this->timeTableRepository->updateTimeTable($id, $validatedData); 
    
        return redirect()->route('timeTable.index')->with('success', 'Timetable entry updated successfully.');
    }

    public function destroy($id)
    {
        $this->timeTableRepository->destroyTimeTable($id); 
    
        return redirect()->route('timeTable.index')->with('success', 'Timetable entry deleted successfully.');
    }
}
