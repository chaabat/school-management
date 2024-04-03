<?php
namespace App\Repositories;

use App\Models\User;
use App\RepositoriesInterfaces\parentRepositoryInterface;


class parentRepository implements parentRepositoryInterface{

public function createParent(array $data)
{
    return User::create($data);
}

    
}