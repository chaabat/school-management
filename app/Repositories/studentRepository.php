<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\RepositoriesInterfaces\studentRepositoryInterface;


class studentRepository implements studentRepositoryInterface
{

    public function createStudent(array $data)
    {
        return User::create($data);
    }

    public function getAllstudents($perPage)
    {
        $studentRole = Role::where('name', 'student')->first();
        return User::where('role_id', $studentRole->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getStudentById($id)
    {
        return User::findOrFail($id);
    }

    public function updateStudent($id, array $data)
    {
        $student = User::findOrFail($id);
        $student->update($data);

        return $student;
    }

    public function destroyStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();
    }
}
