<?php

namespace App\ServiceInterface;

interface  classeServiceInterface
{
    public function createClasse(array $data);
    public function getAllClasses($perPage);
    public function getClasseById($id);
    public function updateClasse($id, array $data);
    public function destroyClasse($id);
    public function searchClasses($query);
    public function absenceClasses($perPage);
    
   
}