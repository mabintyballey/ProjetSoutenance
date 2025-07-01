@extends('administration.base')

@section('content')
<div class="container mt-4">
    <h3>📂 Requêtes en attente</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Client</th>
                <th>Domaine</th>
                <th>Soumis le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requetes as $req)
            <tr>
                <td>{{ $req->client->user->prenom }} {{ $req->client->user->nom }}</td>
                <td>{{ $req->domaine->nom }}</td>
                <td>{{ $req->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ route('admin.requetes.show', $req->id) }}" class="btn btn-sm btn-primary">Voir</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
