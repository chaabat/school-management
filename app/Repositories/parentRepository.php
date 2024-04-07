<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\RepositoriesInterfaces\parentRepositoryInterface;


class parentRepository implements parentRepositoryInterface
{

    public function createParent(array $data)
    {
        return User::create($data);
    }

    public function getAllParents($perPage)
    {
        $parentRole = Role::where('name', 'parent')->first();
        return User::where('role_id', $parentRole->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getParentById($id)
    {
        return User::findOrFail($id);
    }

    public function updateParent($id, array $data)
    {
        $parent = User::findOrFail($id);
        $parent->update($data);

        return $parent;
    }

    public function destroyParent($id)
    {
        $parent = User::findOrFail($id);
        $parent->delete();
    }

    public function searchParents($search)
    {
        return User::where('name', 'like', '%' . $search . '%')
            ->whereHas('role', function ($query) {
                $query->where('name', 'parent');
            })
            ->get();
    }
}
