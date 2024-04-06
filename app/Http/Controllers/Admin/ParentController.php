<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\parentRequest;
use App\Http\Requests\UpdateParentRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\RepositoriesInterfaces\parentRepositoryInterface;
use Illuminate\Http\Request;

class ParentController extends Controller
{

    private $parentRepository;

    public function __construct(parentRepositoryInterface $parentRepository)
    {
        $this->parentRepository = $parentRepository;
    }

    public function index()
    {
        $parents = $this->parentRepository->getAllParents(5);

        return view('admin/parents/show', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/parents/add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(parentRequest $request)
    {

        try {
            $parent = $request->validated();

            $parent['password'] = Hash::make($request->password);
            $fileName = '';

            if ($request->hasFile('picture')) {
                $fileName = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('users'), $fileName);
            } else {
                $fileName = 'photos/logo.jpg';
            }

            $parent = array_merge($parent, ['picture' => $fileName]);

            $user = $this->parentRepository->createParent($parent);

            Auth::login($user);

            return redirect()->route('parents.index');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parent = $this->parentRepository->getParentById($id);
        return view('admin/parents/details', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parent = $this->parentRepository->getParentById($id);

        return view('admin/parents/update', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParentRequest $request, $id)
    {
        $parent = $this->parentRepository->getParentById($id);
        try {
            $updateParent = $request->validated();

            if (isset($updateParent['password'])) {
                $updateParent['password'] = Hash::make($updateParent['password']);
            }

            if ($request->hasFile('picture')) {
                $fileName = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('users'), $fileName);
                $updateParent['picture'] = $fileName;
            }

            $this->parentRepository->updateParent($id, $request->all());

            return redirect()->route('parents.index')->with('success', 'parent updated successfully');
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->parentRepository->destroyParent($id);

            return redirect()->route('parents.index')->with('success', 'Parent deleted successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

     
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        $parents = User::where('name', 'like', '%' . $searchTerm . '%')
                       ->whereHas('role', function ($query) {
                           $query->where('name', 'parent');
                       })
                       ->get();
        
        return response()->json($parents);
    }
    

    
    

}
