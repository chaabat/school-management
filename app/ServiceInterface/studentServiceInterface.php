<?php

namespace App\ServiceInterface;

interface  studentServiceInterface
{
    public function createStudent(array $data);
    public function getAllStudents($perPage);
    public function getStudentById($id);
    public function updateStudent($id, array $data);
    public function destroyStudent($id);
    public function searchStudents($search);
    public function getParents();
    public function getActiveClasses();
    public function getStudentWithParent($id);
    
   
}
