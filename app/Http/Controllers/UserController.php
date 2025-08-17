<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'redes' => ['nullable', 'array'],
            'redes.instagram' => ['nullable', 'string', 'max:255'],
            'redes.facebook' => ['nullable', 'string', 'max:255'],
            'redes.twitter' => ['nullable', 'string', 'max:255'],
            'redes.tiktok' => ['nullable', 'string', 'max:255'],
            'es_admin' => ['nullable', 'boolean'],
            'visible' => ['nullable', 'boolean'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'descripcion' => $request->descripcion,
            'redes' => $request->redes ? array_filter($request->redes) : null,
            'es_admin' => $request->has('es_admin') && $request->es_admin == '1',
            'visible' => $request->has('visible') && $request->visible == '1',
        ];

        // Manejar la carga de foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('users/fotos', 'public');
            $userData['foto'] = $fotoPath;
        }

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'redes' => ['nullable', 'array'],
            'redes.instagram' => ['nullable', 'string', 'max:255'],
            'redes.facebook' => ['nullable', 'string', 'max:255'],
            'redes.twitter' => ['nullable', 'string', 'max:255'],
            'redes.tiktok' => ['nullable', 'string', 'max:255'],
            'es_admin' => ['nullable', 'boolean'],
            'visible' => ['nullable', 'boolean'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'descripcion' => $request->descripcion,
            'redes' => $request->redes ? array_filter($request->redes) : null,
            'es_admin' => $request->has('es_admin') && $request->es_admin == '1',
            'visible' => $request->has('visible') && $request->visible == '1',
        ];

        // Solo actualizar password si se proporciona
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Manejar la carga de nueva foto
        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($user->foto && \Storage::disk('public')->exists($user->foto)) {
                \Storage::disk('public')->delete($user->foto);
            }
            $userData['foto'] = $request->file('foto')->store('users/fotos', 'public');
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
