<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\RepositoriesInterfaces\parentRepositoryInterface;


class ParentController extends Controller
{

       private $parentRepository;

    public function __construct(parentRepositoryInterface $parentRepository)
    {
        $this->parentRepository = $parentRepository;
    }

    public function index()
    {
        $parentRole = Role::where('name', 'parent')->first();
        $parents = User::where('role_id', $parentRole->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);

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
    public function store(Request $request)
    {

        try {
            $parent = $request->validate([
                'name' => 'required | min:4|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required | min:8 ',
                'phone' => 'required|min:8|max:10',
                'adress' => 'required',
                'date' => 'required',
                'role_id' => 'required',
                'genre' => 'required',
                'description' => 'required',
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

            ], [
                'name.min' => 'Le nom doit comporter plus de 4 caractères.',
                'name.unique' => 'Ce nom est déjà pris.',
                'email.required' => 'L\'adresse e-mail est obligatoire.',
                'email.email' => 'Structure d\'e-mail incorrecte.',
                'email.unique' => 'Cet e-mail est déjà utilisé.',
                'password.min' => 'Le mot de passe doit comporter plus de 8 caractères.',
                'password.required' => 'Le mot de passe est obligatoire.',
                'phone.required' => 'Le numéro de téléphone est obligatoire.',
                'phone.min' => 'Le numéro de téléphone doit comporter au moins 8 chiffres.',
                'phone.max' => 'Le numéro de téléphone doit comporter au maximum 10 chiffres.',
                'date.required' => 'La date est obligatoire.',
                'genre.required' => 'Le genre est obligatoire.',
                'description.required' => 'La description est obligatoire.',
                'picture.image' => 'L\'image doit être un fichier image.',
                'picture.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif.',
                'picture.max' => 'L\'image ne doit pas dépasser 2048 kilo-octets.',
            ]);

            $parent['password'] = Hash::make($request->password);

            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $parent = array_merge($parent, ['picture' => $fileName]);

            $user = $this->parentRepository->createParent($parent) ;

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
        $parent = User::findOrFail($id);
        return view('admin/parents/details', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parent = User::findOrFail($id);

        return view('admin/parents/update', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $parent = User::findOrFail($id);
       try{
        $updateParent = $request->validate([
            'name' => 'required|min:4|unique:users,name,' . $parent->id,
            'email' => 'required|email|unique:users,email,' . $parent->id,
            'password' => 'nullable|min:8',
            'phone' => 'required|min:8|max:10',
            'adress' => 'required',
            'date' => 'required',
            'role_id' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (isset($updateParent['password'])) {
            $updateParent['password'] = Hash::make($updateParent['password']);
        }

        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('users'), $fileName);
            $updateParent['picture'] = $fileName;
        }

        $parent->update($updateParent);

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
        $parent = User::findOrFail($id);
        $parent->delete();
        return redirect()->route('parents.index')->with('success', 'parent deleted successfully');
    }
}
