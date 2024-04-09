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
        $classes = $this->classeRepository->getAllClasses(8);
        return view('admin.class', compact('classes'));
    }

   
    public function store(ClasseRequest $request)
    {
        try {
            $class = $request->validated();

            $this->classeRepository->createClasse($class);

            return redirect()->route('admin.class')->with('success','Classe créé avec success');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

   
    public function update(UpdateClasseRequest $request)
    {
        try {
            $class = $request->validated();
    
            $this->classeRepository->updateClasse($request->id, $class);
    
            return redirect()->route('admin.class')->with('success','Classe modifié avec success');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    

   
    public function destroy(string $id)
    {
        $this->classeRepository->destroyClasse($id);

        return redirect()->route('admin.class')->with('success','Classe supprimé avec success');
    }

public function search(Request $request)
{
    $query = $request->input('search');

    $classes = Classe::where('name', 'like', "%$query%")->get();

    return response()->json($classes);
}

}
