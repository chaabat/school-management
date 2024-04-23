<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimeTableRequest;
use App\Http\Requests\TimeTableUpdateRequest;
use App\Services\timeTableService;

class TimeTableController extends Controller
{
    public function __construct(protected timeTableService $timeTableService)
    {
    }
    
    public function index()
    {
        $classSubjects =  $this->timeTableService->getClassSubjects();
        $tables = $this->timeTableService->getAllTimeTable(5); 
    
        return view('admin.timeTable.create', compact('classSubjects', 'tables'));
    }
    
    public function store(TimeTableRequest $request)
    {
        $validatedData = $request->validated();  
        
        $this->timeTableService->createTimeTable($validatedData);  

        return redirect()->route('timeTable.index', $request->class_id)->with('success', 'Timetable entry added successfully.');
    }

    public function show($classId)
    {
        $class = $this->timeTableService->getClassById($classId);
        $timetable = $this->timeTableService->getTimeTableByClassId($classId);
        $subjects = $this->timeTableService->getSubjectsForClass($classId);
         
        return view('admin.timeTable.details', compact('class', 'timetable', 'subjects'));
    }

    public function edit($id)
    {
        $timetable = $this->timeTableService->getTimeTableById($id);
        $class = $this->timeTableService->getClassById($timetable->classe_id);
        $classSubjects = $this->timeTableService->getSubjectsForClass($timetable->classe_id);
        $subjects = $class->subjectToClass()->get();
        
        return view('admin.timeTable.update', compact('timetable','class','subjects','classSubjects'));
    }

    public function update(TimeTableUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();  

        $this->timeTableService->updateTimeTable($id, $validatedData); 
    
        return redirect()->route('timeTable.index')->with('success', 'Timetable entry updated successfully.');
    }

    public function destroy($id)
    {
        $this->timeTableService->destroyTimeTable($id); 
    
        return redirect()->route('timeTable.index')->with('success', 'Timetable entry deleted successfully.');
    }
}