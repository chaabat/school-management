<?php

namespace App\ServiceInterface;

interface  studentServiceInterface
{
    public function createSubject(array $data);
    public function getAllSubjects($perPage);
    public function getSubjectById($id);
    public function updateSubject($id, array $data);
    public function destroySubject($id);
    public function searchSubjects($query);
    
   
}