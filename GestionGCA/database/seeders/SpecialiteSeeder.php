<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialite;
use App\Models\Domaine;

class SpecialiteSeeder extends Seeder
{
    public function run(): void
    {
        $specialites = [
            ['nom' => 'Avocat pénaliste', 'domaine' => 'Affaires pénales'],
            ['nom' => 'Avocat civiliste', 'domaine' => 'Affaires civiles'],
            ['nom' => 'Avocat administratif', 'domaine' => 'Affaires administratives'],
            ['nom' => 'Avocat des affaires', 'domaine' => 'Affaires commerciales'],
            ['nom' => 'Avocat en droit du travail', 'domaine' => 'Affaires civiles'],
            ['nom' => 'Avocat fiscaliste', 'domaine' => 'Affaires commerciales'],
            ['nom' => 'Juriste d’entreprise', 'domaine' => 'Jeunes juristes'],
            ['nom' => 'Rédacteur de contrat commercial', 'domaine' => 'Élaboration de contrat'],
            ['nom' => 'Rédacteur de contrat de travail', 'domaine' => 'Élaboration de contrat'],
            ['nom' => 'Conseiller en droit de la famille', 'domaine' => 'Conseil juridique'],
            ['nom' => 'Collaborateur judiciaire', 'domaine' => 'Collaborateur juridique'],
        ];

        foreach ($specialites as $item) {
            $domaine = Domaine::where('nom', $item['domaine'])->first();
            if ($domaine) {
                Specialite::create([
                    'nom' => $item['nom'],
                    'domaine_id' => $domaine->id
                ]);
            }
        }
    }
}
