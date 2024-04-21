<?php

namespace  App\Services;

use App\repositoriesInterfaces\teacherRepositoryInterface;

class  teacherService
{

    private $teacherRepository;

    public function __construct(teacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function createTeacher(array $data)
    {
        return $this->teacherRepository->createTeacher($data);
    }
    public function getAllTeachers($perPage)
    {
        return $this->teacherRepository->getAllTeachers($perPage);
    }
    
    public function getTeacherById($id)
    {
        return $this->teacherRepository->getTeacherById($id);
    }
    public function updateTeacher($id, array $data)
    {
        return  $this->teacherRepository->updateTeacher($id, $data);
    }
    public function destroyTeacher($id)
    {
        return $this->teacherRepository->getTeacherById($id);
    }
    public function searchTeachers($search)
    {
        return $this->teacherRepository->searchTeachers($search);
    }
}
