<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    // Listado con buscador por nombre o empresa
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('empresa', 'like', "%$search%");
            })
            ->orderBy('name')
            ->paginate(10);
        return view('admin.users.index', compact('users', 'search'));
    }

    // Editar usuario
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'empresa' => 'required|string|max:255',
            'telefono' => 'required|string|max:30',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:6',
        ]);
        $user->update($request->only('name', 'email', 'empresa', 'telefono'));
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }
        $user->syncRoles([$request->role]);
        return Redirect::route('admin.users.index')->with('status', 'Usuario actualizado');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('admin.users.index')->with('status', 'Usuario eliminado');
    }
}
