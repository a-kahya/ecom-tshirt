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

    // Déconnexion (US7) : appelée en POST depuis le bouton de la nav
    public function logout(Request $request): RedirectResponse
    {
        // 1. Retire l'utilisateur connecté : il redevient "invité"
        Auth::logout();

        // 2. Détruit la session : plus aucune donnée de l'ancien utilisateur n'y reste
        $request->session()->invalidate();

        // 3. Génère un nouveau jeton CSRF : l'ancien formulaire ne peut plus être réutilisé
        $request->session()->regenerateToken();

        // 4. Retour à la page d'accueil
        return redirect()->route('accueil');
    }
}
