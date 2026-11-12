<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    // Formulaire de connexion (US4)
    public function showLogin(): View
    {
        return view('connexion', ['categories' => Category::all()]);
    }

    // Connexion : l'adresse e-mail sert de login
    public function login(Request $request): RedirectResponse
    {
        $identifiants = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => "L'adresse e-mail est obligatoire.",
            'email.email' => "L'adresse e-mail n'est pas valide.",
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (! Auth::attempt($identifiants)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['echec' => 'Adresse e-mail ou mot de passe incorrect.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('accueil'));
    }
}
