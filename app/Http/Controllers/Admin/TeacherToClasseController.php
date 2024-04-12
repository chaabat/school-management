<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Role;
use App\Models\TeacherToClasse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class TeacherToClasseController extends Controller
{
    public function index()
    {
        $teacherRole = Role::where('name', 'teacher')->first();
        $classes = Classe::all();
        $teachers = User::where('role_id', $teacherRole->id)->get();
        $teacherToClasse = TeacherToClasse::paginate(6);

        return view('admin.teacherToClasse', compact('classes', 'teachers', 'teacherToClasse'));
    }


    public function store(Request $request)
    {
        $teacherToClasse = $request->validate([
            'user_id' => 'required',
            'classe_id' => 'required',
            'statut' => 'required|in:activer,desactiver',
        ]);

        TeacherToClasse::create($teacherToClasse);

        return redirect()->back()->with('success', 'Subjects added to class successfully.');
    }

    public function update(Request $request)
    {
        try {
            $teacherToClasse = $request->validate([
                'classe_id' => 'required',
                'user_id' => 'required',
                'statut' => 'required|in:activer,desactiver',
            ]);
    
            $assignment = TeacherToClasse::findOrFail($request->id);
            $assignment->update($teacherToClasse);
    
            return redirect()->back()->with('success', 'La relation "Subject-to-class" a été mise à jour avec succès.');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }


    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
    
         
        $results = TeacherToClasse::whereHas('classe', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                })
                ->orWhereHas('user', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                })
                ->with('classe', 'user')
                ->get();
    
        return response()->json($results);
    }
    


    public function destroy($id)
    {
        $TeacherToClassee = TeacherToClasse::findOrFail($id);
        $TeacherToClassee->delete();

        return redirect()->back()->with('success', 'Subject-to-class relationship deleted successfully.');
    }
}
