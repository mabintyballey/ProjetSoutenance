<?php

namespace App\Http\Controllers\Auth;
use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(RouteServiceProvider::HOME);
    // }
public function store(Request $request)
{
    // ✅ Validation complète
    $request->validate([
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'photo' => ['nullable', 'image'],
        'telephone' => ['nullable', 'string', 'max:20'],
        'adresse' => ['nullable', 'string', 'max:255'],
    ]);

    // ✅ Gestion de la photo
    $photoName = null;
    if ($request->hasFile('photo')) {
        $photoName = time().'_'.$request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('public/photos', $photoName);
    }

    // ✅ Création de l'utilisateur
    $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'photo' => $photoName,
        'role' => 'client',
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    // ✅ Création du profil client
    Client::create([
        'user_id' => $user->id,
        'statut' => 'en_attente',
    ]);

    // ✅ Connexion automatique
    Auth::login($user);

    // ✅ Redirection
    return redirect()->route('client.requetes.create')->with('success', 'Compte créé avec succès. En attente de validation.');
}
}
