<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InscriptionController extends Controller
{
    // Formulaire d'inscription (US5)
    public function show(): View
    {
        return view('inscription', ['categories' => Category::all()]);
    }

    // Création du compte : tous les champs sont obligatoires, l'e-mail est unique
    public function store(Request $request): RedirectResponse
    {
        $donnees = $request->validate([
            // nom, prénom et ville : des lettres (espaces, tirets, apostrophes et points permis), pas de chiffres
            'nom' => ['required', 'string', 'max:255', "regex:/^\p{L}[\p{L}\s'’.-]*$/u"],
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
            // e-mail : format valide avec une extension (.com, .be, .fr, …), unique
            'email' => ['required', 'email', 'regex:/^[^@\s]+@[^@\s]+\.[A-Za-z]{2,}$/', 'max:255', 'unique:users,email'],
            // mot de passe : au moins une majuscule, un chiffre et un caractère spécial
            'password' => ['required', 'string', 'regex:/^(?=.*\p{Lu})(?=.*\d)(?=.*[^\p{L}\d\s]).+$/u'],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.regex' => 'Le nom ne doit pas contenir de chiffres.',
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
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.regex' => 'Le mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.',
            '*.max' => 'Cette valeur est trop longue.',
        ]);

        // Échec inattendu (base de données, doublon simultané…) : message clair plutôt qu'une page d'erreur
        try {
            $user = User::create([
                'name' => $donnees['nom'],
                'prenom' => $donnees['prenom'],
                'adresse' => $donnees['adresse'],
                'code_postal' => $donnees['code_postal'],
                'ville' => $donnees['ville'],
                'email' => $donnees['email'],
                'password' => $donnees['password'],
            ]);
        } catch (QueryException $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['echec' => "L'inscription n'a pas pu être effectuée. Veuillez réessayer."]);
        }

        // Le membre est connecté dès son inscription : « Bienvenue, <prénom> » s'affiche partout
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('accueil');
    }
}
