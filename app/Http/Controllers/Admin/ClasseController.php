<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Database\QueryException;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::orderBy('created_at', 'desc')->paginate(8);
        return view('admin/class', compact('classes'));
    }

   
    public function store(Request $request)
    {
        try {
            $class = $request->validate([
                'name' => 'required|min:4|unique:classes,name',
                'statut' => 'required|in:activer,desactiver',
            ], [
                'name.min' => 'Le nom doit comporter au moins 4 caractères.',
                'name.unique' => 'Ce nom est déjà pris.',
                'statut.required' => 'Le statut est requis.',
                'statut.in' => 'Le statut doit être "active" ou "desactiver".',
            ]);

            Classe::create($class);

            return redirect()->route('admin.class');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

   
    public function update(Request $request)
    {
        try {
            $class = $request->validate([
                'name' => 'required|min:4|unique:classes,name,',
                'statut' => 'required|in:activer,desactiver',
            ], [
                'name.min' => 'Le nom doit comporter au moins 4 caractères.',
                'name.unique' => 'Ce nom est déjà pris.',
                'statut.required' => 'Le statut est requis.',
                'statut.in' => 'Le statut doit être "active" ou "desactiver".',
            ]);
    
            $classToUpdate =Classe::findOrFail($request->id);

            $classToUpdate->update($class);
    
            return redirect()->route('admin.class');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

   
    public function destroy(string $id)
    {
        $class = Classe::findOrFail($id);
        $class->delete();

        return redirect()->route('admin.class');
    }
}
