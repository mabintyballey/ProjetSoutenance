@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mes dossiers clients</h2>

    @if($clients->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type de service</th>
                    <th>Créé le</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->type_service }}</td>
                    <td>{{ $client->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('dossiers.show', $client->id) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('chat.show', $client->id) }}" class="btn btn-sm btn-primary">Chat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun dossier trouvé.</p>
    @endif
</div>
@endsection
