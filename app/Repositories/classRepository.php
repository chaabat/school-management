<?php

namespace App\Repositories;

use App\Models\Classe;
 
use App\RepositoriesInterfaces\classeRepositoryInterface;


class classRepository implements classeRepositoryInterface
{

    public function createClasse(array $data)
    {
        return Classe::create($data);
    }

    public function getAllClasses($perPage)
    {
       return Classe::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getClasseById($id)
    {
        return Classe::findOrFail($id);
    }

    public function updateClasse($id, array $data)
    {
        $classe = Classe::findOrFail($id);
        $classe->update($data);

        return $classe;
    }

    public function destroyClasse($id)
    {
        $classe = Classe::findOrFail($id);
        $classe->subjectToClass()->delete();
        $classe->teacherToClasse()->delete();
        $classe->timetable()->delete();
        $classe->delete();
    }
    public function searchClasses($query)
    {
        return Classe::where('name', 'like', "%$query%")->get();
    }

    public function absenceClasses($perPage){
        
        return Classe::with('user')->paginate($perPage);
    }


    

}
