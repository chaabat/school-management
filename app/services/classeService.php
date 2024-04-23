<?php

namespace  App\Services;

use App\repositoriesInterfaces\classeRepositoryInterface;

class  classeService
{
    private $classeRepository;

    public function __construct(classeRepositoryInterface $classeRepository)
    {
        $this->classeRepository = $classeRepository;
    }
    public function createclasse(array $data)
    {
        return  $this->classeRepository->createclasse($data);
    }
    public function getAllclasses($perPage)
    {
        return $this->classeRepository->getAllclasses($perPage);
    }
    public function getclasseById($id)
    {
        return $this->classeRepository->getclasseById($id);
    }
    public function updateclasse($id, array $data)
    {
        return $this->classeRepository->updateclasse($id, $data);
    }
    public function destroyclasse($id)
    {
        return  $this->classeRepository->destroyclasse($id);
    }
    public function searchclasses($query)
    {
       return $this->classeRepository->searchclasses($query);
    }

    public function absenceClasses($perPage){
        return $this->classeRepository->absenceClasses($perPage);
    }
    
}
