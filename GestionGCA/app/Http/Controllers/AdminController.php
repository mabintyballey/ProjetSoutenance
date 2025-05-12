<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Dossier;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function dashboard()
    {
        $clientsCount = User::where('role', 'client')->count();
        $avocatsCount = User::where('role', 'avocat')->count();
        $dossiersCount = Dossier::count();
        $dossiersParStatut = Dossier::selectRaw('statut_validation, count(*) as total')
                                    ->groupBy('statut_validation')
                                    ->pluck('total', 'statut_validation');

        return view('administration.pages.dashboard', compact('clientsCount', 'avocatsCount', 'dossiersCount', 'dossiersParStatut',));
    }
    public function indexClients()
    {
        $clients = User::where('role', 'client')->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function indexAvocats()
    {
        $avocats = User::where('role', 'avocat')->paginate(10);
        return view('admin.avocats.index', compact('avocats'));
    }

    public function createAvocat()
    {
        return view('admin.avocats.create');
    }

    public function storeAvocat(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'avocat',
        ]);

        return redirect()->route('admin.avocats.index')->with('success', 'Avocat ajouté avec succès.');
    }

    public function destroyUser(User $user)
    {
        if (in_array($user->role, ['client', 'avocat'])) {
            $user->delete();
            return back()->with('success', 'Utilisateur supprimé.');
        }
        return back()->with('error', "Action non autorisée.");
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
