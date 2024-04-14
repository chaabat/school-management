<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\teacherToClasseRequest;
use App\Http\Requests\updateTeacherToClasseRequest;
use App\Models\Classe;
use App\Models\Role;
use App\Models\TeacherToClasse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\RepositoriesInterfaces\teacherToClasseRepositoryInterface;



class TeacherToClasseController extends Controller
{

    private $teacherToClassRepository;

    public function __construct(teacherToClasseRepositoryInterface $teacherToClassRepository)
    {
        $this->teacherToClassRepository = $teacherToClassRepository;
    }
    public function index()
    {
        $classes = $this->teacherToClassRepository->getAllClasses();
        $teachers = $this->teacherToClassRepository->getAllTeachers();
        $teacherToClasse = $this->teacherToClassRepository->getAllTeachersToClassPaginated(6);

        return view('admin.teacherToClasse', compact('classes', 'teachers', 'teacherToClasse'));
    }


    public function store(teacherToClasseRequest $request)
    {
        $teacherToClasse = $request->validated();

        $this->teacherToClassRepository->create($teacherToClasse);


        return redirect()->back()->with('success', 'Subjects added to class successfully.');
    }

    public function update(updateTeacherToClasseRequest $request)
    {
        try {
            $teacherToClasse = $request->validated();

            $this->teacherToClassRepository->update($teacherToClasse, $request->id);

            return redirect()->back()->with('success', 'La relation "Subject-to-class" a été mise à jour avec succès.');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }


    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
        $results = $this->teacherToClassRepository->search($searchQuery);
        return response()->json($results);
    }



    public function destroy($id)
    {
        $this->teacherToClassRepository->delete($id);

        return redirect()->back()->with('success', 'Subject-to-class relationship deleted successfully.');
    }
}
