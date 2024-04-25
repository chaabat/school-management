<?php

namespace  App\Services;

use App\repositoriesInterfaces\paRepositoryInterface;

class  paService
{

    private $paRepository;

    public function __construct(paRepositoryInterface $paRepository)
    {
        $this->paRepository = $paRepository;
    }

    public function index()
    {
        return $this->paRepository->index();
    }
    public function myChildren()
    {
        return  $this->paRepository->myChildren();
    }
    public function myChildrenSubjects($id)
    {
        return $this->paRepository->myChildrenSubjects($id);
    }
}
