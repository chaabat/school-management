<?php

namespace App\Repositories;

use App\Models\User;
use App\RepositoriesInterfaces\PaRepositoryInterface;
 

class PaRepository implements PaRepositoryInterface
{
    public function index()
    {
        $parent = auth()->user();
        return $parent->children()->count(); 
    }

    public function myChildren()
    {
        $parent = auth()->user();  
        return $parent->children()->get();
    }

    public function myChildrenSubjects($id)
    {
        $child = User::findOrFail($id);
    
        $upcomingExams = $child->classe()->with(['exam' => function ($query) {
            $query->where('date', '>=', now()->format('Y-m-d'));
        }])->get();
    
        $previousExams = $child->classe()->with(['exam' => function ($query) {
            $query->where('date', '<', now()->format('Y-m-d'));
        }])->get();
     
        $classeTable = $child->classe()->with('timetable')->get();
        $classes = $child->classe()->with('subjectToClass.subject')->get();

        $children = $child->absences()->where('statut', 'absent')->get();

        return [
            'upcomingExams' => $upcomingExams,
            'previousExams' => $previousExams,
            'classeTable' => $classeTable,
            'classes' => $classes,
            'children' => $children,
        ];
    }
}
