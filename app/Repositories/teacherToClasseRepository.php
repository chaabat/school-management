<?php

namespace App\Repositories;

use App\Models\Classe;
use App\Models\Role;
use App\Models\User;
use App\Models\TeacherToClasse;
use App\RepositoriesInterfaces\teacherToClasseRepositoryInterface;

class teacherToClasseRepository implements teacherToClasseRepositoryInterface
{
    public function create(array $data)
    {
        return TeacherToClasse::create($data);
    }

    public function update(array $data, $id)
    {
        $teacherToClasse = TeacherToClasse::findOrFail($id);
        $teacherToClasse->update($data);
        return $teacherToClasse;
    }

    public function delete($id)
    {
        $teacherToClasse = TeacherToClasse::findOrFail($id);
        $teacherToClasse->delete();
    }

    public function teacherToClassID($id)
    {
        return TeacherToClasse::findOrFail($id);
    }

    public function search($query)
    {
        return TeacherToClasse::whereHas('classe', function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
            ->orWhereHas('user', function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->with('classe', 'user')
            ->get();
    }

    public function getAllClasses()
    {
        return Classe::all();
    }

    public function getAllTeachers()
    {
        $teacherRole = Role::where('name', 'teacher')->first();
        return User::where('role_id', $teacherRole->id)->get();
    }

    public function getAllTeachersToClassPaginated($perPage)
    {
        return TeacherToClasse::paginate($perPage);
    }
}
