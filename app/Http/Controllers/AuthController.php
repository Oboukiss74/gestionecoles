<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleves;
use App\Models\Parents;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //connexion
    public function login(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string',
            'password'  => 'required|string',
        ], [
            'matricule.required' => 'Le matricule est obligatoire.',
            'password.required'  => 'Le mot de passe est obligatoire.',
        ]);

        $credentials = [
            'matricule' => $request->matricule,
            'password'  => $request->password,
        ];

        if (Auth::guard('eleve')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('eleve.inscription.form');
        }

        return back()
            ->withInput($request->only('matricule'))
            ->withErrors([
                'matricule' => 'Matricule ou mot de passe incorrect.',
            ]);
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::guard('eleve')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('eleve.login');
    }

}
