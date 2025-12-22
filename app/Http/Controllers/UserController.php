<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Lógica para listar os usuários
        // Use pagination so the view can call ->links()
        $users = User::query();
        $users->when($request->keyword,
            function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%'. $keyword .'%')
                      ->orWhere('email', 'like', '%'. $keyword .'%');
                });
        });
        $users = $users->paginate();
        return view('users.index', compact('users'));

    }
    public function create()
    {
        // Lógica para mostrar o formulário de criação de usuário
        return view('users.create');
    }
    public function store(Request $request)
    {
        Gate::authorize('edit', User::class);
        // Lógica para armazenar um novo usuário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'avatar' => 'nullable|file|max:2048',
        ]);

        if(!empty($validatedData['avatar']) && $validatedData['avatar']->isValid()) {
            $validatedData['avatar']->store();
        }

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('users.index')->with('status', 'User created successfully!');
    }
    public function edit(User $user)
    {
        // Gate::authorize('edit', User::class);
        $user->load('profile', 'userInterests');
        $roles = Role::all();
        // Lógica para mostrar o formulário de edição de usuário
        return view('users.edit', compact('user'), compact('roles'));
    }
    public function update(Request $request, User $user)
    {
        // Lógica para atualizar um usuário existente
        Gate::authorize('edit', User::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'exclude_if:password,null|string|min:8',
        ]);

        if(!empty($validatedData['avatar']) && $validatedData['avatar']->isValid()) {
            $validatedData['avatar']->store();
        }

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->save();

        return redirect()->route('users.index') ->with('status', 'User updated successfully!');
    }

    public function updateProfile(Request $request, User $user)
    {
        Gate::authorize('edit', User::class);
        // Lógica para atualizar o perfil do usuário
        $validatedData = $request->validate([
            'bio' => 'nullable|string|max:1000',
            'document' => 'nullable|string|max:255',
        ]);

        // if(!empty($validatedData['avatar']) && $validatedData['avatar']->isValid()) {
        //     $validatedData['avatar']->store();
        //     $user->profile->avatar = $validatedData['avatar'];
        // }

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'bio' => $validatedData['bio'] ?? null,
                'document' => $validatedData['document'] ?? null,
            ]
        );

        return redirect()->route('users.index')->with('status', 'User profile updated successfully!');
    }
    public function updateInterest(Request $request, User $user)
    {
        Gate::authorize('edit', User::class);
        // Lógica para atualizar os interesses do usuário
        $validatedData = $request->validate([
            'interests' => 'nullable|array',
        ]);

        $interests = $validatedData['interests'] ?? [];
        $user->userInterests()->delete();
        if(!empty($interests)){
            $user->userInterests()->createMany($interests);
        }



        return redirect()->route('users.index')->with('status', 'User interests updated successfully!');
    }
    public function updateRoles(Request $request, User $user)
    {
        // Gate::authorize('edit', User::class);
        // Lógica para atualizar os papéis do usuário
        $validatedData = $request->validate([
            'roles' => 'required|array',
        ]);

        $roles = $validatedData['roles'] ?? [];
        $user->roles()->sync($roles);

        return redirect()->route('users.index')->with('status', 'User roles updated successfully!');
    }
    public function destroy(User $user)
    {
        Gate::authorize('destroy', User::class);
        // Lógica para deletar um usuário
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User deleted successfully!');
    }
}
