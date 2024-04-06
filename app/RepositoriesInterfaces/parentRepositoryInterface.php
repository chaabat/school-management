<?php

namespace App\repositoriesInterfaces;
interface parentRepositoryInterface
{
    public function createParent(array $data);
    public function getAllParents($perPage);
    public function getParentById($id);
    public function updateParent($id, array $data);
    public function destroyParent($id);
   
}