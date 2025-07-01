
<h2>Bonjour {{ $client->user->prenom }},</h2>

<p>Votre compte a été validé avec succès par notre équipe.</p>

@if($client->requetes()->latest()->first())
    <p>Votre demande juridique est également en cours de traitement.</p>
@endif

<p>Merci pour votre confiance.</p>

<p>Cordialement,<br>L’équipe JUGE(cabinet-avocat).</p>
