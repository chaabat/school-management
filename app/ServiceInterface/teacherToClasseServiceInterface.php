<?php

namespace App\ServiceInterface;

interface  teacherToClasseServiceInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function search($query);
    public function teacherToClassID($id);
    public function getAllClasses();
    public function getAllTeachers();
    public function getAllTeachersToClassPaginated($perPage);
   
}