@extends('administration.base')

@section('content')
<div class="container py-5" id="messages-container">

    <h4 class="fw-bold mb-4 border-bottom pb-2">
        💬 Conversation avec {{ $destinataire->prenom }} {{ $destinataire->nom }}
        <small class="text-muted">({{ ucfirst($destinataire->role) }})</small>
    </h4>

    <!-- Fil de messages -->
    <div id="messages" class="mb-4 p-3 border rounded-3 bg-light shadow-sm"
         style="height: 450px; overflow-y: auto;">
        @foreach($messages as $message)
            <div class="d-flex mb-3 {{ $message->expediteur_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="px-3 py-2 rounded-4 shadow-sm 
                    {{ $message->expediteur_id === auth()->id() ? 'bg-primary text-white' : 'bg-white border' }}"
                     style="max-width: 70%;">
                    <small class="d-block mb-1 fw-bold">
                        {{ $message->expediteur_id === auth()->id() ? 'Moi' : $destinataire->prenom }}
                    </small>
                    <span>{{ $message->contenu }}</span>
                    <div class="text-end">
                        <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Formulaire envoi -->
    <form id="form-message" class="shadow-sm">
        @csrf
        <input type="hidden" id="destinataire_id" value="{{ $destinataire->id }}">
        <div class="input-group">
            <input type="text" id="contenu" class="form-control border-end-0 rounded-start-pill"
                   placeholder="Écrire un message..." required>
            <button type="submit" class="btn btn-success rounded-end-pill">
                <i class="bi bi-send"></i> Envoyer
            </button>
        </div>
    </form>

    <!-- 🔊 Audio notification -->
    <audio id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    let lastMessageId = {{ $messages->last()->id ?? 0 }};

    function addMessage(message) {
        const isMine = message.expediteur_id === {{ auth()->id() }};
        const html = `
            <div class="d-flex mb-3 ${isMine ? 'justify-content-end' : 'justify-content-start'}">
                <div class="px-3 py-2 rounded-4 shadow-sm ${isMine ? 'bg-primary text-white' : 'bg-white border'}" style="max-width: 70%;">
                    <small class="d-block mb-1 fw-bold">${isMine ? 'Moi' : '{{ $destinataire->prenom }}'}</small>
                    <span>${message.contenu}</span>
                    <div class="text-end">
                        <small class="text-muted">${new Date(message.created_at).toLocaleString()}</small>
                    </div>
                </div>
            </div>`;
        $('#messages').append(html);
        $('#messages').scrollTop($('#messages')[0].scrollHeight);
        lastMessageId = message.id;

        if (!isMine) {
            const audio = document.getElementById('notification-sound');
            if (audio) {
                audio.play().catch(e => console.log("Lecture du son bloquée :", e));
            }
        }
    }

    $('#form-message').submit(function (e) {
        e.preventDefault();
        const contenu = $('#contenu').val().trim();
        if (!contenu) return;

        $.ajax({
            url: "{{ route('messagerie.sendAjax') }}",
            method: "POST",
            data: {
                destinataire_id: $('#destinataire_id').val(),
                contenu: contenu,
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                if (res.success) {
                    addMessage(res.message);
                    $('#contenu').val('').focus();
                }
            }
        });
    });

    function refreshMessages() {
        $.get("{{ route('messagerie.loadAjax', $destinataire->id) }}", function (res) {
            res.messages.forEach(function(message) {
                if (message.id > lastMessageId) {
                    addMessage(message);
                }
            });
        });
    }

    setInterval(refreshMessages, 5000);
});
</script>
@endsection
