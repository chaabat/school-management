<?php

namespace App\repositoriesInterfaces;
interface examRepositoryInterface
{
    public function createExam(array $data);
    public function getAllExams($perPage);
    public function getExamById($id);
    public function updateExam($id, array $data);
    public function destroyExam($id);
   
}