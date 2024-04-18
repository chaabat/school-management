<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Subject;
use App\Models\SubjetToClass;
use App\Models\TimeTable;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
      

    }

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $classSubjects = SubjetToClass::with('classe', 'subject')->get();
        $tables = TimeTable::paginate(5);
    
        return view('admin.timeTable.create', compact('classSubjects', 'tables'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'days' => 'required|in:monday,tuesday,wednesday,thursday,friday',
            'time' => 'required|regex:/^\d{2}:\d{2}$/'
        ]);

        TimeTable::create($request->all());

        return redirect()->route('timeTable.index', $request->class_id)->with('success', 'Timetable entry added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($classId)
    {
        $class = Classe::findOrFail($classId);
        $timetable = TimeTable::where('classe_id', $classId)->get();
        $subjects = Classe::findOrFail($classId)->subjectToClass()->get();
     
        return view('admin.timeTable.details', compact('class', 'timetable', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $timetable = TimeTable::findOrFail($id);
        $class = Classe::findOrFail($timetable->classe_id);  
        $classSubjects = SubjetToClass::with('classe', 'subject')->get();
        $subjects = $class->subjectToClass()->get();
        return view('admin.timeTable.update', compact('timetable','class','subjects','classSubjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'days' => 'required|in:monday,tuesday,wednesday,thursday,friday',
            'time' => 'required|regex:/^\d{2}:\d{2}$/'
        ]);
    
        $timetable = TimeTable::findOrFail($id);
        $timetable->update($request->all());
    
        return redirect()->route('timeTable.index')->with('success', 'Timetable entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $timetable = TimeTable::findOrFail($id);
        $timetable->delete();
    
        return redirect()->route('timeTable.index')->with('success', 'Timetable entry deleted successfully.');
    }
}