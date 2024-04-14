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
    public function create($classId)
    {
        $class = Classe::findOrFail($classId);
        $timetable = TimeTable::where('class_id', $classId)->get();
        $subjects = $class->subjectToClass()->get();

        return view('admin.timeTable.index', compact('class', 'timetable', 'subjects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $classSubjects = SubjetToClass::with('classe', 'subject')->get();
        
        return view('admin.timeTable.create', compact('classSubjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
