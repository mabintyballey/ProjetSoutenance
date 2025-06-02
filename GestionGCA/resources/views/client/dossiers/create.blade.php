@extends('client.base')

@section('content')
<div class="container max-w-xl mx-auto mt-6">
    <h2 class="text-xl font-bold mb-4">Soumettre un nouveau dossier</h2>
    <form action="{{ route('client.dossiers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label>Type d'affaire</label>
            <select name="type_affaire" class="w-full border px-3 py-2">
                <option>Droit pénal</option>
                <option>commercial</option>
                <option>administrative</option>
                <option>civil</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Description</label>
            <textarea name="description" class="w-full border px-3 py-2" required></textarea>
        </div>

        <div class="mb-4">
            <label>Information adverse</label>
            <textarea name="information_adverse" class="w-full border px-3 py-2" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Soumettre</button>
    </form>
</div>
@endsection
