<?php

namespace App\ServiceInterface;

interface  parentServiceInterface
{
    public function createParent(array $data);
    public function getAllParents($perPage);
    public function getParentById($id);
    public function updateParent($id, array $data);
    public function destroyParent($id);
    public function searchParents($search);
    public function getStudents();
    public function getParentWithChildren($id);
    
   
}
