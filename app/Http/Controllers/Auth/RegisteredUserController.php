<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'redes' => ['nullable', 'array'],
            'redes.instagram' => ['nullable', 'string', 'max:255'],
            'redes.facebook' => ['nullable', 'string', 'max:255'],
            'redes.twitter' => ['nullable', 'string', 'max:255'],
            'redes.tiktok' => ['nullable', 'string', 'max:255'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'descripcion' => $request->descripcion,
            'redes' => $request->redes ? array_filter($request->redes) : null,
            'es_admin' => false, // Los nuevos usuarios no son admin por defecto
        ];

        // Manejar la carga de foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('users/fotos', 'public');
            $userData['foto'] = $fotoPath;
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
