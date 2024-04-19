<?php

namespace  App\Services;

use App\RepositoriesInterfaces\parentRepositoryInterface;

class  parentservice 
{

    private $parentRepository;

    public function __construct(parentRepositoryInterface $parentRepository)
    {
        $this->parentRepository = $parentRepository;
    }

    public function createParent(array $data) {
      return  $this->parentRepository->createParent($data);
    }

    public function getAllParents($perPage){
       return  $this->parentRepository->getAllParents($perPage);
    }


    public function getParentById($id){
        return   $this->parentRepository->getParentById($id);
    }


    public function updateParent($id, array $data){
        return $this->parentRepository->updateParent($id, $data);
    }


    public function destroyParent($id){
        return  $this->parentRepository->destroyParent($id);

    }
    public function searchParents($search){
        return  $this->parentRepository->searchParents($search);

    }
    public function getStudents(){
        return  $this->parentRepository->getStudents();

    }
    public function getParentWithChildren($id){
        return $this->parentRepository->getParentWithChildren($id);

    }

}

