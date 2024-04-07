<?php

namespace App\repositoriesInterfaces;
interface studentRepositoryInterface
{
    public function createStudent(array $data);
    public function getAllStudents($perPage);
    public function getStudentById($id);
    public function updateStudent($id, array $data);
    public function destroyStudent($id);
    public function searchStudents($search);
   
}