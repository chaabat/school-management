<?php

namespace App\RepositoriesInterfaces;
interface subjectsRepositoryInterface
{
    public function createSubject(array $data);
    public function getAllSubjects($perPage);
    public function getSubjectById($id);
    public function updateSubject($id, array $data);
    public function destroySubject($id);
    public function searchSubjects($query);

   
}