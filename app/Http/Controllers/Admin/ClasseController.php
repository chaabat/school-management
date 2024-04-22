<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Classe;
use Illuminate\Http\Request;
 
use App\Services\classeService;

class ClasseController extends Controller
{
    public function __construct(protected classeService $classeService)
    {
    }

    public function index()
    {
        $classes = $this->classeService->getAllClasses(8);
        return view('admin.classe.class', compact('classes'));
    }

    public function classesAbsence()
    {
        
        $classes = Classe::with('user')->paginate(4);

        return view('admin.classe.absence', compact('classes'));
    }

   
    public function store(ClasseRequest $request)
    {
         
            $class = $request->validated();

            $this->classeService->createClasse($class);

            return redirect()->route('classes.index')->with('success','Classe créé avec success');
        
    }

    public function edit($id)
    {
        $class = $this->classeService->getClasseById($id);
    
        return view('admin.classe.update', compact('class'));
    }
    
 

   
    public function update(UpdateClasseRequest $request, $id)
    {
        $classData = $request->validated();
        
        $this->classeService->updateClasse($id, $classData);
        
        return redirect()->route('classes.index')->with('success', 'Classe modifiée avec succès');
    }
    
   
    public function destroy(string $id)
    {
        $this->classeService->destroyClasse($id);

        return redirect()->route('classes.index')->with('success','Classe supprimé avec success');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $classes = $this->classeService->searchClasses($query);
        return response()->json($classes);
    }

}
