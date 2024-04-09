<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Subject;
use App\Models\SubjetToClass;
use Illuminate\Http\Request;

class SubjectToClasseController extends Controller
{
    public function index(){
        $classes = Classe::all();
        $subjects = Subject::all();
        $subjetToClasse=SubjetToClass::paginate(6);
        return view('admin/subjectToClass',compact('subjetToClasse','subjects','classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'classe_id' => 'required',
            'subject_id' => 'required|array', // Ensure subject_id is an array
            'subject_id.*' => 'exists:subjects,id', // Validate each subject_id exists in the subjects table
            'statut' =>'required',
        ]);
    
        // Create a new SubjetToClass record for each selected subject
        foreach ($validatedData['subject_id'] as $subjectId) {
            SubjetToClass::create([
                'classe_id' => $validatedData['classe_id'],
                'subject_id' => $subjectId,
                'statut' => $validatedData['statut'],
            ]);
        }
    
        return redirect()->back()->with('success', 'Subjects added to class successfully.');
    }
    
    
   

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'classe_id' => 'required',
                'subject_id' => 'required',
                'statut' => 'required|in:activer,desactiver',
            ], [
                'classe_id.required' => 'Le champ "Classe" est requis.',
                'subject_id.required' => 'Le champ "Subject" est requis.',
                'statut.required' => 'Le statut est requis.',
                'statut.in' => 'Le statut doit être "activer" ou "desactiver".',
            ]);
    
            $subjetToClasse = SubjetToClass::findOrFail($request->id);
            $subjetToClasse->update($validatedData);
    
            return redirect()->back()->with('success', 'La relation "Subject-to-class" a été mise à jour avec succès.');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
    
        // Perform your search logic here
        $results = SubjetToClass::whereHas('classe', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                })
                ->orWhereHas('subject', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                })
                ->with('classe', 'subject')
                ->get();
    
        return response()->json($results);
    }
    

    
    



    public function destroy($id)
    {
        $subjetToClasse = SubjetToClass::findOrFail($id);
        $subjetToClasse->delete();

        return redirect()->back()->with('success', 'Subject-to-class relationship deleted successfully.');
    }
}
