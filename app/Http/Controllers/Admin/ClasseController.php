<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\RepositoriesInterfaces\classeRepositoryInterface;


class ClasseController extends Controller
{
    private $classeRepository;

    public function __construct(classeRepositoryInterface $classeRepository)
    {
        $this->classeRepository = $classeRepository;
    }

    public function index()
    {
        $classes = $this->classeRepository->getAllClasses(4);
        return view('admin.classe.class', compact('classes'));
    }

   
    public function store(ClasseRequest $request)
    {
         
            $class = $request->validated();

            $this->classeRepository->createClasse($class);

            return redirect()->route('admin.class')->with('success','Classe créé avec success');
        
    }

    public function edit($id)
    {
        $class = $this->classeRepository->getClasseById($id);
    
        return view('admin.classe.update', compact('class'));
    }
    
 

   
    public function update(UpdateClasseRequest $request, $id)
    {
        $classData = $request->validated();
        
        $this->classeRepository->updateClasse($id, $classData);
        
        return redirect()->route('admin.class')->with('success', 'Classe modifiée avec succès');
    }
    
   
    public function destroy(string $id)
    {
        $this->classeRepository->destroyClasse($id);

        return redirect()->route('admin.class')->with('success','Classe supprimé avec success');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $classes = $this->classeRepository->searchClasses($query);
        return response()->json($classes);
    }

}
