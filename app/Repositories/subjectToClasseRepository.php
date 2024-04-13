<?php

namespace App\Repositories;

use App\Models\Classe;
use App\Models\Subject;
use App\Models\SubjetToClass;
use App\RepositoriesInterfaces\subjectToClasseRepositoryInterface;

class SubjectToClasseRepository implements SubjectToClasseRepositoryInterface
{
    public function create(array $data)
    {
        $subjects = [];

        foreach ($data['subject_id'] as $subjectId) {
            $subjects[] = SubjetToClass::create([
                'classe_id' => $data['classe_id'],
                'subject_id' => $subjectId,
                'statut' => $data['statut'],
            ]);
        }

        return $subjects;
    }

    public function update(array $data, $id)
    {
        $subjetToClasse = SubjetToClass::findOrFail($id);
        $subjetToClasse->update($data);
        return $subjetToClasse;
    }

    public function findOrFail($id)
    {
        return SubjetToClass::findOrFail($id);
    }

    public function delete($id)
    {
        $subjetToClasse = SubjetToClass::findOrFail($id);
        $subjetToClasse->delete();
    }

    public function search($query)
    {
        return SubjetToClass::whereHas('classe', function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
            ->orWhereHas('subject', function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->with('classe', 'subject')
            ->get();
    }

    public function getAllClasses()
    {
        return Classe::all();
    }

    public function getAllSubjects()
    {
        return Subject::all();
    }

    public function getAllSubjectToClassPaginated($perPage)
    {
        return SubjetToClass::paginate($perPage);
    }
}
