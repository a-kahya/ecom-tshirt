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

        // Mêmes règles que l'inscription (US5)
        $donnees = $request->validate([
            // nom (colonne "name"), prénom et ville : des lettres (espaces, tirets, apostrophes et points permis), pas de chiffres
            'name' => ['required', 'string', 'max:255', "regex:/^\p{L}[\p{L}\s'’.-]*$/u"],
            'prenom' => ['required', 'string', 'max:255', "regex:/^\p{L}[\p{L}\s'’.-]*$/u"],
            // adresse : un nom de rue ET un numéro (maison ou boîte) ; pas uniquement des chiffres
            'adresse' => [
                'required', 'string', 'max:255',
                "regex:/^[\p{L}\p{N}\s'’.,\/°-]+$/u",
                'not_regex:/^[\d\s,.\/°-]+$/u',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (! preg_match('/\d/', $value)) {
                        $fail("L'adresse doit contenir un numéro (maison ou boîte).");
                    }
                },
            ],
            // code postal : un nombre à 4 chiffres (Belgique)
            'code_postal' => ['required', 'regex:/^\d{4}$/'],
            'ville' => ['required', 'string', 'max:255', "regex:/^\p{L}[\p{L}\s'’.-]*$/u"],
            // e-mail : format valide avec une extension, unique, mais en ignorant la ligne du membre lui-même
            // (sinon son propre courriel serait refusé)
            'email' => ['required', 'email', 'regex:/^[^@\s]+@[^@\s]+\.[A-Za-z]{2,}$/', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            // Mot de passe facultatif : on ne le change que s'il est rempli, avec la même règle qu'à l'inscription
            'password' => ['nullable', 'min:8', 'confirmed', 'regex:/^(?=.*\p{Lu})(?=.*\d)(?=.*[^\p{L}\d\s]).+$/u'],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.regex' => 'Le nom ne doit pas contenir de chiffres.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.regex' => 'Le prénom ne doit pas contenir de chiffres.',
            'adresse.required' => "L'adresse est obligatoire.",
            'adresse.regex' => "L'adresse contient des caractères non autorisés.",
            'adresse.not_regex' => "L'adresse doit contenir le nom de la rue, pas uniquement des chiffres.",
            'code_postal.required' => 'Le code postal est obligatoire.',
            'code_postal.regex' => 'Le code postal doit être un nombre à 4 chiffres.',
            'ville.required' => 'La ville est obligatoire.',
            'ville.regex' => 'La ville ne doit pas contenir de chiffres.',
            'email.required' => "L'adresse e-mail est obligatoire.",
            'email.email' => "L'adresse e-mail n'est pas valide.",
            'email.regex' => "L'adresse e-mail n'est pas valide (exemple : nom@domaine.com).",
            // Critère d'acceptation : deux utilisateurs ne peuvent pas avoir le même courriel
            'email.unique' => 'Cette adresse e-mail est déjà utilisée par un autre compte.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.regex' => 'Le mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.',
            '*.max' => 'Cette valeur est trop longue.',
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