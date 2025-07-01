@extends('administration.base')

@section('content')


<div class="container py-5">

    <h3 class="mb-4 fw-bold text-blue-dark">
        📨 Ma Messagerie
    </h3>

    <a href="{{ route('messagerie.create') }}" class="btn btn-gold rounded-pill mb-4 shadow">
        <i class="bi bi-plus-circle me-1"></i> Nouvelle conversation
    </a>

    @if($conversations->isEmpty())
        <div class="alert alert-info shadow-sm rounded-3">
            <i class="bi bi-info-circle-fill me-2"></i>
            Aucune conversation pour le moment.
        </div>
    @else
        <div class="list-group shadow-sm rounded-4 overflow-hidden">

            @foreach ($conversations as $conv)
                @if($conv['user'])
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-left-gold position-relative">

                        {{-- Zone cliquable --}}
                        <a href="{{ route('messagerie.chat', $conv['conversation_id']) }}"
                           class="d-flex align-items-center flex-grow-1 text-decoration-none text-dark">

                            {{-- Photo ou Initiales --}}
                            <div class="me-3">
                               @if($conv['user']->photo && file_exists(public_path('upload/photos/' . $conv['user']->photo)))
                                    <img src="{{ asset('upload/photos/' . $conv['user']->photo) }}"
                                         class="rounded-circle shadow"
                                         alt="Photo"
                                         style="width:50px; height:50px; object-fit:cover;">
                               @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center rounded-circle-initial shadow">
                                        {{ strtoupper(substr($conv['user']->prenom, 0, 1)) }}
                                    </div>
                               @endif
                            </div>

                            {{-- Infos conversation --}}
                            <div>
                                <h5 class="mb-1 fw-semibold text-blue-dark">
                                    {{ $conv['user']->prenom }} {{ $conv['user']->nom }}
                                    <small class="text-muted">({{ ucfirst($conv['user']->role) }})</small>
                                </h5>
                                <p class="mb-0 text-muted small">
                                    {{ $conv['last_message']?->contenu
                                        ? Str::limit($conv['last_message']->contenu, 50)
                                        : 'Aucun message encore'
                                    }}
                                </p>
                            </div>
                        </a>

                        {{-- Badge Nouveau ou Date --}}
                        <div class="text-end ms-3">
                            @php
                                $last = $conv['last_message'];
                                $isUnread = $last &&
                                            $last->destinataire_id === auth()->id() &&
                                            !$last->lu;
                            @endphp

                            @if($isUnread)
                                <span class="badge bg-danger rounded-pill">Nouveau</span>
                            @else
                                <small class="text-muted">
                                    {{ $last?->created_at ? $last->created_at->diffForHumans() : '' }}
                                </small>
                            @endif
                        </div>

                        {{-- Bouton Supprimer --}}
                        <form action="{{ route('messagerie.conversation.destroy', $conv['conversation_id']) }}"
                              method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette conversation ?');"
                              class="ms-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Supprimer cette conversation">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                @endif
            @endforeach

        </div>
    @endif

</div>

@endsection
