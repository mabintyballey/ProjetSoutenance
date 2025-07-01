@extends('administration.base')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📂 Suivi de mes dossiers</h2>

    @forelse ($dossiers as $dossier)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6 p-6 hover:shadow-md transition">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">{{ $dossier->titre }}</h3>
                    <p class="text-sm text-gray-500">Créé le {{ $dossier->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 text-sm rounded-full font-medium 
                    @switch($dossier->statut)
                        @case('en_attente') bg-yellow-100 text-yellow-800 @break
                        @case('en_cours') bg-blue-100 text-blue-800 @break
                        @case('termine') bg-green-100 text-green-800 @break
                        @case('rejete') bg-red-100 text-red-800 @break
                        @default bg-gray-100 text-gray-800
                    @endswitch
                ">
                    {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                </span>
            </div>

            <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700 mb-4">
                <div>
                    <span class="font-medium text-gray-800">Domaine :</span>
                    {{ $dossier->domaine->nom ?? 'Non spécifié' }}
                </div>
                <div>
                    <span class="font-medium text-gray-800">Avocat :</span>
                    {{ $dossier->avocat->user->prenom ?? 'Aucun' }} {{ $dossier->avocat->user->nom ?? '' }}
                </div>
            </div>

            <div class="mt-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">🕒 Suivi :</h4>
                <ul class="text-sm text-gray-600 list-inside list-disc space-y-1">
                    <li>
                        <span class="font-medium text-gray-800">Dernière mise à jour :</span>
                        {{ $dossier->updated_at->format('d/m/Y à H:i') }}
                    </li>
                    <li>
                        Statut actuel : <strong>{{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}</strong>
                    </li>
                </ul>
            </div>

            <div class="mt-5 flex flex-wrap gap-3">
                <a href="#"
                   class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100 transition">
                    🔍 Voir détails
                </a>

                <a href="{{ route('messagerie.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-md hover:bg-green-100 transition">
                    💬 Messagerie
                </a>

                @if($dossier->document)
                <a href="{{ route('documents.telecharger', $dossier->document->id) }}"
                   class="inline-flex items-center px-4 py-2 bg-purple-50 text-purple-700 rounded-md hover:bg-purple-100 transition">
                    📄 Télécharger le document
                </a>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center text-gray-500 mt-10">
            Aucun dossier trouvé pour le moment.
        </div>
    @endforelse
</div>
@endsection
