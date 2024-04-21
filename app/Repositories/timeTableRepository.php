<?php

namespace App\Repositories;

use App\Models\Classe;
use App\Models\SubjetToClass;
use App\Models\TimeTable;
 

use App\RepositoriesInterfaces\timeTableRepositoryInterface;

class timeTableRepository implements timeTableRepositoryInterface
{
    public function createTimeTable(array $data)
    {
        return TimeTable::create($data);
    }
    public function getAllTimeTable($perPage)
    {

        return TimeTable::paginate($perPage);
    }
    public function getTimeTableById($id)
    {
        return TimeTable::findOrFail($id);
    }
    public function updateTimeTable($id, array $data)
    {
        $timeTable = TimeTable::findOrFail($id);
        $timeTable->update($data);
        return $timeTable;
    }
    public function destroyTimeTable($id)
    {
        $timeTable = TimeTable::findOrFail($id);
        $timeTable->delete();
    }
    public function getClassSubjects()
    {
        return SubjetToClass::with('classe', 'subject')->get();
    }

    public function getClassById($id)
    {
        return Classe::findOrFail($id);
    }
    
    public function getTimeTableByClassId($id)
    {
        return TimeTable::where('classe_id', $id)->get();
    }
    
    public function getSubjectsByClassId($id)
    {
        return SubjetToClass::where('classe_id', $id)->with('subject')->get();
    }

    public function getSubjectsForClass($classId)
    {
        return SubjetToClass::where('classe_id', $classId)->with('subject')->get();
    }
}
