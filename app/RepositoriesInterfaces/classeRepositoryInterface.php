<?php

namespace App\repositoriesInterfaces;
interface classeRepositoryInterface
{
    public function createClasse(array $data);
    public function getAllClasses($perPage);
    public function getClasseById($id);
    public function updateClasse($id, array $data);
    public function destroyClasse($id);
    public function searchClasses($query);

   
}