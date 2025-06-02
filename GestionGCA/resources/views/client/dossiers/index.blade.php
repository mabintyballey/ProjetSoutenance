<!-- resources/views/client/dossiers/index.blade.php -->
@extends('client.base')

@section('content')
<div class="container mt-6">
    <h2 class="text-xl font-bold mb-4">Mes Dossiers</h2>
    <a href="{{ route('client.dossiers.create') }}" class="bg-green-500 text-white px-4 py-2 mb-4 inline-block">Nouveau dossier</a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Type</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dossiers as $dossier)
                <tr>
                    <td class="border p-2">{{ $dossier->type_affaire }}</td>
                    <td class="border p-2">{{ $dossier->statut_validation }}</td>
                    <td class="border p-2">
                        <a href="{{ route('client.dossiers.show', $dossier->id) }}" class="text-blue-600">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
