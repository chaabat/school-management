<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\RepositoriesInterfaces\teacherRepositoryInterface;


class teacherRepository implements teacherRepositoryInterface
{

    public function createTeacher(array $data)
    {
        return User::create($data);
    }

    public function getAllTeachers($perPage)
    {
        $teacherRole = Role::where('name', 'teacher')->first();
        return User::where('role_id', $teacherRole->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getTeacherById($id)
    {
        return User::findOrFail($id);
    }

    public function updateTeacher($id, array $data)
    {
        $teacher = User::findOrFail($id);
        $teacher->update($data);

        return $teacher;
    }

    public function destroyTeacher($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->teacherToClasse()->delete();
        $teacher->delete();
    }

    public function searchTeachers($search)
    {
        return User::where('name', 'like', '%' . $search . '%')
            ->whereHas('role', function ($query) {
                $query->where('name', 'teacher');
            })
            ->get();
    }
}
