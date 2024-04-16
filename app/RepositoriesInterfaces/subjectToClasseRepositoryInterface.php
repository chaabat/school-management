<?php

namespace App\repositoriesInterfaces;
interface subjectToClasseRepositoryInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function search($query);
    public function subjetToClassID($id);
    public function getAllClasses();
    public function getAllSubjects();
    public function getAllSubjectToClassPaginated($perPage);
     
}