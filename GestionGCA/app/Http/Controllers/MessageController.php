<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Dossier;
use App\Models\User;
use App\Models\Conversation;

class MessageController extends Controller
{
  public function index()
{
    $user = auth()->user();
    $conversations = collect();

    if ($user->role === 'client') {
        $correspondants = collect();

        // 👉 Avocats liés aux dossiers du client
        $avocats = User::whereHas('avocat.dossiers', function ($q) use ($user) {
            $q->where('client_id', $user->client->id);
        })->get();

        $correspondants = $correspondants->merge($avocats);

        // 👉 Admin toujours disponible
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $correspondants->push($admin);
        }

        foreach ($correspondants->unique('id') as $correspondant) {
            $conversation = Conversation::where(function ($q) use ($user, $correspondant) {
                $q->where('user1_id', $user->id)
                  ->where('user2_id', $correspondant->id);
            })->orWhere(function ($q) use ($user, $correspondant) {
                $q->where('user1_id', $correspondant->id)
                  ->where('user2_id', $user->id);
            })->first();

            if ($conversation) {
                $lastMessage = Message::where('conversation_id', $conversation->id)->latest()->first();

                if ($lastMessage) {
                    $conversations->push([
                        'conversation_id' => $conversation->id,
                        'user' => $correspondant,
                        'last_message' => $lastMessage,
                    ]);
                }
            }
        }

    } elseif ($user->role === 'avocat') {
        $correspondants = collect();

        // 👉 Clients liés aux dossiers de l’avocat
        $clients = User::whereHas('client.dossiers', function ($q) use ($user) {
            $q->where('avocat_id', $user->avocat->id);
        })->get();

        $correspondants = $correspondants->merge($clients);

        // 👉 Admin toujours disponible
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $correspondants->push($admin);
        }

        foreach ($correspondants->unique('id') as $correspondant) {
            $conversation = Conversation::where(function ($q) use ($user, $correspondant) {
                $q->where('user1_id', $user->id)
                  ->where('user2_id', $correspondant->id);
            })->orWhere(function ($q) use ($user, $correspondant) {
                $q->where('user1_id', $correspondant->id)
                  ->where('user2_id', $user->id);
            })->first();

            if ($conversation) {
                $lastMessage = Message::where('conversation_id', $conversation->id)->latest()->first();

                if ($lastMessage) {
                    $conversations->push([
                        'conversation_id' => $conversation->id,
                        'user' => $correspondant,
                        'last_message' => $lastMessage,
                    ]);
                }
            }
        }

    } else {
        // 👉 Cas admin ou autre : toutes les conversations où il est présent
        $convs = Conversation::where('user1_id', $user->id)
                             ->orWhere('user2_id', $user->id)
                             ->get();

        foreach ($convs as $conv) {
            $otherUser = $conv->user1_id === $user->id ? $conv->user2 : $conv->user1;

            if ($otherUser) {
                $lastMessage = Message::where('conversation_id', $conv->id)->latest()->first();

                if ($lastMessage) {
                    $conversations->push([
                        'conversation_id' => $conv->id,
                        'user' => $otherUser,
                        'last_message' => $lastMessage,
                    ]);
                }
            }
        }
    }

    return view('messagerie.index', compact('conversations'));
}


public function create()
{
    $user = auth()->user();

    if ($user->role === 'avocat') {
        // Récupère uniquement les clients assignés via les dossiers
        $users = User::whereHas('client.dossiers', function ($query) use ($user) {
            $query->where('avocat_id', $user->avocat->id);
        })->get();

        // Ajoute l'admin sans doublons
        $admin = User::where('role', 'admin')->first();
        if ($admin && !$users->contains($admin)) {
            $users->push($admin);
        }

    } elseif ($user->role === 'client') {
        // Récupère son dernier dossier avec avocat
        $dossier = $user->client->dossiers()->with('avocat.user')->latest()->first();

        $users = collect();

        // Ajoute l’avocat du dossier s’il existe
        if ($dossier && $dossier->avocat && $dossier->avocat->user) {
            $users->push($dossier->avocat->user);
        }

        // Ajoute l’admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $users->push($admin);
        }

    } elseif ($user->role === 'admin') {
        // L'admin peut discuter avec tous sauf lui-même
        $users = User::where('id', '!=', $user->id)->get();

    } else {
        abort(403); // Rôle non autorisé
    }

    return view('messagerie.create', compact('users'));
}


public function redirigerVersConversation($dossierId)
{
    $avocat = auth()->user();

    if ($avocat->role !== 'avocat') {
        abort(403);
    }

    $dossier = Dossier::with('client.user')->findOrFail($dossierId);
    $clientUser = $dossier->client?->user;

    if (!$clientUser) {
        abort(404, 'Client non trouvé pour ce dossier.');
    }

    // Trouver ou créer la conversation
    $conversation = Conversation::firstOrCreate(
        [
            'user1_id' => min($avocat->id, $clientUser->id),
            'user2_id' => max($avocat->id, $clientUser->id),
        ]
    );

    return redirect()->route('messagerie.chat', $conversation->id);
}

    public function storeConversation(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);

        $authUserId = auth()->id();
        $otherUserId = $request->input('user_id');

        $conversation = Conversation::where(function ($q) use ($authUserId, $otherUserId) {
            $q->where('user1_id', $authUserId)->where('user2_id', $otherUserId);
        })->orWhere(function ($q) use ($authUserId, $otherUserId) {
            $q->where('user1_id', $otherUserId)->where('user2_id', $authUserId);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user1_id' => $authUserId,
                'user2_id' => $otherUserId,
            ]);
        }

        return redirect()->route('messagerie.chat', $conversation->id);
    }

    public function chat($conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);

        if (!in_array(auth()->id(), [$conversation->user1_id, $conversation->user2_id])) {
            abort(403);
        }

        $messages = $conversation->messages()->orderBy('created_at')->get();
        $destinataire = $conversation->user1_id === auth()->id() ? $conversation->user2 : $conversation->user1;

        return view('messagerie.chat', compact('messages', 'destinataire', 'conversation'));
    }

    public function marquerTousLus()
    {
        Message::where('destinataire_id', Auth::id())
               ->where('lu', false)
               ->update(['lu' => true]);

        return back();
    }

    public function envoyerMessage(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'destinataire_id' => 'required|exists:users,id',
            'conversation_id' => 'nullable|exists:conversations,id',
        ]);

        $conversationId = $request->conversation_id;

        if (!$conversationId) {
            $authId = auth()->id();
            $destId = $request->destinataire_id;

            $conversation = Conversation::where(function ($q) use ($authId, $destId) {
                $q->where('user1_id', $authId)->where('user2_id', $destId);
            })->orWhere(function ($q) use ($authId, $destId) {
                $q->where('user1_id', $destId)->where('user2_id', $authId);
            })->first();

            if (!$conversation) {
                $conversation = Conversation::create([
                    'user1_id' => $authId,
                    'user2_id' => $destId,
                ]);
            }

            $conversationId = $conversation->id;
        }

        Message::create([
            'expediteur_id' => auth()->id(),
            'destinataire_id' => $request->destinataire_id,
            'contenu' => $request->contenu,
            'conversation_id' => $conversationId,
        ]);

        return redirect()->route('messagerie.chat', $conversationId);
    }

public function loadAjaxMessages(User $user)
    {
        $auth = auth()->user();

        $messages = Message::where(function ($q) use ($user, $auth) {
            $q->where('expediteur_id', $auth->id)->where('destinataire_id', $user->id);
        })->orWhere(function ($q) use ($user, $auth) {
            $q->where('expediteur_id', $user->id)->where('destinataire_id', $auth->id);
        })->orderBy('created_at')->get();

        return response()->json(['messages' => $messages]);
    }
     
    public function loadConversationsAjax()
{
    $user = auth()->user();
    $conversations = collect();

    if ($user->role === 'client') {
        $dossier = $user->client->dossiers()->with('avocat.user')->latest()->first();
        if ($dossier && $dossier->avocat && $dossier->avocat->user) {
            $avocatUser = $dossier->avocat->user;
            $conversation = Conversation::where(function ($q) use ($user, $avocatUser) {
                $q->where('user1_id', $user->id)->where('user2_id', $avocatUser->id);
            })->orWhere(function ($q) use ($user, $avocatUser) {
                $q->where('user1_id', $avocatUser->id)->where('user2_id', $user->id);
            })->first();

            $lastMessage = Message::where('conversation_id', $conversation?->id)->latest()->first();
            $conversations->push([
                'conversation_id' => $conversation?->id,
                'user' => $avocatUser,
                'last_message' => $lastMessage,
            ]);
        }

    } elseif ($user->role === 'avocat') {
        $clientUsers = User::whereHas('client.dossiers', function ($q) use ($user) {
            $q->where('avocat_id', $user->avocat->id);
        })->get();

        foreach ($clientUsers as $clientUser) {
            $conversation = Conversation::where(function ($q) use ($user, $clientUser) {
                $q->where('user1_id', $user->id)->where('user2_id', $clientUser->id);
            })->orWhere(function ($q) use ($user, $clientUser) {
                $q->where('user1_id', $clientUser->id)->where('user2_id', $user->id);
            })->first();

            $lastMessage = Message::where('conversation_id', $conversation?->id)->latest()->first();

            $conversations->push([
                'conversation_id' => $conversation?->id,
                'user' => $clientUser,
                'last_message' => $lastMessage,
            ]);
        }

        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $conversation = Conversation::where(function ($q) use ($user, $admin) {
                $q->where('user1_id', $user->id)->where('user2_id', $admin->id);
            })->orWhere(function ($q) use ($user, $admin) {
                $q->where('user1_id', $admin->id)->where('user2_id', $user->id);
            })->first();

            $lastMessage = Message::where('conversation_id', $conversation?->id)->latest()->first();

            $conversations->push([
                'conversation_id' => $conversation?->id,
                'user' => $admin,
                'last_message' => $lastMessage,
            ]);
        }

    } else {
        $convs = Conversation::where('user1_id', $user->id)->orWhere('user2_id', $user->id)->get();
        foreach ($convs as $conv) {
            $otherUser = $conv->user1_id === $user->id ? $conv->user2 : $conv->user1;
            $lastMessage = Message::where('conversation_id', $conv->id)->latest()->first();
            $conversations->push([
                'conversation_id' => $conv->id,
                'user' => $otherUser,
                'last_message' => $lastMessage,
            ]);
        }
    }

    return response()->json([
        'success' => true,
        'conversations' => $conversations,
    ]);
}


    public function show($id)
    {
        $message = Message::findOrFail($id);

        if (
            auth()->id() !== $message->expediteur_id &&
            auth()->id() !== $message->destinataire_id &&
            auth()->user()?->role !== 'admin'
        ) {
            abort(403);
        }

        return view('messagerie.chat', compact('message'));
    }

   
   public function destroyMessage(Message $message)
{
    // Vérifier que seul l'expéditeur peut le supprimer
    if ($message->expediteur_id !== auth()->id()) {
        abort(403, 'Vous ne pouvez supprimer que vos propres messages.');
    }

    $message->delete();

    return back()->with('success', 'Message supprimé.');
}

public function destroyConversation(Conversation $conversation)
{
    // Vérifier que l'utilisateur est bien dans la conversation
    if (!in_array(auth()->id(), [$conversation->user1_id, $conversation->user2_id])) {
        abort(403, 'Vous n\'avez pas accès à cette conversation.');
    }

    // Supprimer la conversation et ses messages
    $conversation->messages()->delete();
    $conversation->delete();

    return redirect()->route('messagerie.index')
                     ->with('success', 'Conversation supprimée avec succès.');
}

 public function sendAjax(Request $request)
{
    $request->validate([
        'contenu' => 'required|string',
        'destinataire_id' => 'required|exists:users,id',
    ]);

    $expediteur = auth()->user();
    $destinataire_id = $request->destinataire_id;

    // Créer ou récupérer une conversation entre les deux utilisateurs
    $conversation = Conversation::firstOrCreate(
        [
            'user1_id' => min($expediteur->id, $destinataire_id),
            'user2_id' => max($expediteur->id, $destinataire_id),
        ]
    );

    // Créer le message dans cette conversation
    $message = Message::create([
        'expediteur_id' => $expediteur->id,
        'destinataire_id' => $destinataire_id,
        'contenu' => $request->contenu,
        'conversation_id' => $conversation->id,
    ]);

    return response()->json([
        'success' => true,
        'message' => $message
    ]);
}

}