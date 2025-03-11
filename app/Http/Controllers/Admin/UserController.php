<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles como objetos
        $permissions = Permission::all(); // Obtener todos los permisos con su información
        return view('users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/', // Al menos una mayúscula
                'regex:/[0-9]/', // Al menos un número
                'regex:/[@$!%*?&]/' // Al menos un carácter especial opcional
            ],
            'role' => 'required|exists:roles,name',
        ], [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe incluir al menos una mayúscula, un número y un carácter especial (@$!%*?&).',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        // Asignar Permisos
        if ($request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        }

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }


    public function show(User $user)
    {
        $user->load('roles', 'permissions'); // Cargar roles y permisos del usuario
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all(); // Obtener todos los permisos con su información
        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => [
                'nullable',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ],
            'role' => 'required|exists:roles,name',
        ], [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe incluir al menos una mayúscula, un número y un carácter especial (@$!%*?&).',
        ]);

        // Actualizar datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Si hay contraseña, actualizarla
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Actualizar Rol
        $user->syncRoles([$request->role]); // syncRoles elimina y asigna el nuevo rol

        // Actualizar Permisos
        $user->syncPermissions($request->permissions ?? []); // Si no hay permisos, los limpia

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
    public function assignPermissionsForm(User $user)
    {
        $permissions = Permission::pluck('name'); // Obtener permisos existentes
        return view('users.assign-permissions', compact('user', 'permissions'));
    }

    public function assignPermissions(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions ?? []); // Asigna los permisos seleccionados
        return redirect()->route('users.index')->with('success', 'Permisos asignados correctamente.');
    }
}
