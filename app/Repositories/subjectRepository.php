<?php

namespace App\Repositories;

use App\Models\Subject;
 
use App\RepositoriesInterfaces\subjectsRepositoryInterface;


class subjectRepository implements subjectsRepositoryInterface
{

    public function createSubject(array $data)
    {
        return Subject::create($data);
    }

    public function getAllSubjects($perPage)
    {
       return Subject::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getSubjectById($id)
    {
        return Subject::findOrFail($id);
    }

    public function updateSubject($id, array $data)
    {
        $subjects = Subject::findOrFail($id);
        $subjects->update($data);

        return $subjects;
    }

    public function destroySubject($id)
    {
        $subjects = Subject::findOrFail($id);
        $subjects->subjectToClass()->delete();
        $subjects->timetable()->delete();
        $subjects->delete();
    }
    public function searchSubjects($query)
    {
        return Subject::where('name', 'like', "%$query%")->get();
    }
}
