<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('edit') || Gate::allows('view')) {
            $users = User::all();
            return view('users.index', compact('users'));
        }
        return view('layouts.unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('edit')) {
            return view('users.create');
        }
        return view('layouts.unauthorized');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('edit')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
        }
        return view('layouts.unauthorized');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Verifica se o usuário NÃO está bloqueado
        if (Gate::allows('edit') || Gate::allows('view')) {
            $user = User::findOrFail($id); // Carrega o usuário pelo ID ou lança um erro 404
            return view('users.show', compact('user')); // Exibe a view do perfil do usuário
        }

        // Se o usuário está bloqueado, renderiza a view de "não autorizado"
        return view('layouts.unauthorized');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Gate::allows('edit')) {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        }
        return view('layouts.unauthorized');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Gate::allows('edit')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
        }
        return view('layouts.unauthorized');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gate::allows('edit')) {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuário removido com sucesso.');
        }
        return view('layouts.unauthorized');
    }
}
