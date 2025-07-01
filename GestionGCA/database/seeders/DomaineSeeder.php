<?php

namespace Database\Seeders;

use App\Models\Domaine;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
     public function run(): void
    {
        $domaines = [
            ['nom' => 'Conseil juridique', 'description' => 'Assistance générale pour toute situation légale.'],
            ['nom' => 'Fourniture d\'avocats', 'description' => 'Mise en relation avec des avocats pour défense ou représentation.'],
            ['nom' => 'Jeunes juristes', 'description' => 'Jeunes juristes pour assister entreprises ou associations.'],
            ['nom' => 'Collaborateur juridique', 'description' => 'Collaboration avec un professionnel du droit pour assistance régulière.'],
            ['nom' => 'Affaires civiles', 'description' => 'Droit de la famille, succession, divorce, etc.'],
            ['nom' => 'Affaires pénales', 'description' => 'Infractions, garde à vue, procédure pénale.'],
            ['nom' => 'Affaires administratives', 'description' => 'Contentieux avec l’État, fonction publique, décisions administratives.'],
            ['nom' => 'Affaires commerciales', 'description' => 'Contrats, litiges entre entreprises, sociétés, recouvrements.'],
            ['nom' => 'Élaboration de contrat', 'description' => 'Rédaction et sécurisation juridique des contrats.'],
        ];

        foreach ($domaines as $domaine) {
            Domaine::create($domaine);
        }
    }
}
