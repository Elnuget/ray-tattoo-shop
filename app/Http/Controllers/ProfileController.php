<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        // Manejar la subida de la foto de perfil
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior si existe
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            // Subir la nueva foto
            $path = $request->file('foto')->store('profile-photos', 'public');
            $validatedData['foto'] = $path;
        }

        // Filtrar redes sociales vacías
        if (isset($validatedData['redes'])) {
            $validatedData['redes'] = array_filter($validatedData['redes'], function($value) {
                return !empty(trim($value));
            });
            
            // Si no hay redes sociales, establecer como null
            if (empty($validatedData['redes'])) {
                $validatedData['redes'] = null;
            }
        }

        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Eliminar la foto de perfil si existe
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
