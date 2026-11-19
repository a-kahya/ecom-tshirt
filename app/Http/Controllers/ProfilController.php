<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfilController extends Controller
{
    // Affiche le formulaire pré-rempli avec les informations du membre connecté
    public function show(): View
    {
        // "categories" sert à afficher la nav, comme sur les autres pages
        return view('profil', ['categories' => Category::all()]);
    }

    // Enregistre les modifications (US6)
    public function update(Request $request): RedirectResponse
    {
        // Le membre connecté : on ne modifie JAMAIS un autre compte que le sien
        $user = $request->user();

        $donnees = $request->validate([
            'name' => ['required', 'string', 'max:255'],        // nom de famille
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'string', 'max:10'],
            'ville' => ['required', 'string', 'max:255'],
            // unique, mais en ignorant la ligne du membre lui-même (sinon son propre courriel serait refusé)
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($user->id)],
            // Mot de passe facultatif : on ne le change que s'il est rempli
            'password' => ['nullable', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'adresse.required' => "L'adresse est obligatoire.",
            'code_postal.required' => 'Le code postal est obligatoire.',
            'ville.required' => 'La ville est obligatoire.',
            'email.required' => "L'adresse e-mail est obligatoire.",
            'email.email' => "L'adresse e-mail n'est pas valide.",
            // Critère d'acceptation : deux utilisateurs ne peuvent pas avoir le même courriel
            'email.unique' => 'Cette adresse e-mail est déjà utilisée par un autre compte.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        // Assignation champ par champ : fonctionne même sans propriété $fillable dans le modèle
        $user->name = $donnees['name'];
        $user->prenom = $donnees['prenom'];
        $user->adresse = $donnees['adresse'];
        $user->code_postal = $donnees['code_postal'];
        $user->ville = $donnees['ville'];
        $user->email = $donnees['email'];

        // Le mot de passe n'est modifié que si le champ a été rempli
        if (! empty($donnees['password'])) {
            $user->password = Hash::make($donnees['password']);
        }

        // Critère d'acceptation : un message d'erreur indique un échec éventuel de la mise à jour
        try {
            $user->save();
        } catch (\Throwable $e) {
            report($e); // consigne l'erreur technique dans storage/logs
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['echec' => 'La mise à jour a échoué. Veuillez réessayer.']);
        }

        // Retour sur le profil avec un message de succès
        return redirect()->route('profil')->with('succes', 'Vos informations ont bien été mises à jour.');
    }
}