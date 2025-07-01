<div>
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="{{ $avocat->photo ? asset('storage/' . $avocat->photo) : asset('uploads/photos/default.png') }}"
                 class="img-fluid rounded mb-3" alt="Photo de {{ $avocat->name }}">
        </div>
        <div class="col-md-8">
            <h4>{{ $avocat->name }} {{ $avocat->prenom }}</h4>
            <p><strong>Email :</strong> {{ $avocat->email }}</p>
            <p><strong>Téléphone :</strong> {{ $avocat->telephone }}</p>
            <p><strong>Adresse :</strong> {{ $avocat->adresse }}</p>
            <p><strong>Domaine :</strong> {{ $avocat->avocat->domaine->nom ?? 'N/A' }}</p>
            <p><strong>Spécialité :</strong> {{ $avocat->avocat->specialite->nom ?? 'N/A' }}</p>
            <p><strong>Statut :</strong> 
                @if($avocat->avocat->is_active)
                    <span class="badge bg-success">Actif</span>
                @else
                    <span class="badge bg-danger">Inactif</span>
                @endif
            </p>
            <p><strong>Créé le :</strong> {{ $avocat->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
</div>
