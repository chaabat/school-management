<?php

namespace  App\Services;

use App\ServiceInterface\teacherToClasseServiceInterface;

class  teacherToClasseService
{

    private $teacherToClassRepository;

    public function __construct(teacherToClasseServiceInterface $teacherToClassRepository)
    {
        $this->teacherToClassRepository = $teacherToClassRepository;
    }


    public function create(array $data)
    {
        return $this->teacherToClassRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->teacherToClassRepository->update($data, $id);
    }
    public function delete($id)
    {
        return $this->teacherToClassRepository->delete($id);
    }
    public function search($query)
    {
        return  $this->teacherToClassRepository->search($query);
    }
    public function teacherToClassID($id)
    {
        return $this->teacherToClassRepository->teacherToClassID($id);
    }
    public function getAllClasses()
    {
        return $this->teacherToClassRepository->getAllClasses();
    }
    public function getAllTeachers()
    {
        return $this->teacherToClassRepository->getAllTeachers();
    }
    public function getAllTeachersToClassPaginated($perPage)
    {
       return  $this->teacherToClassRepository->getAllTeachersToClassPaginated($perPage);
    }
}
