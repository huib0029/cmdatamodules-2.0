<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Seed om zoekmodule te testen
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'Veiligheidsregio Zeeland',
            'competenties' => 'SAN1a, SON2a',
            'projectgrootte' => 10,
            'leverancier' => 'Veiligheidsregio Zeeland',
        ]);
        DB::table('projects')->insert([
            'name' => 'Data Science',
            'competenties' => 'SON2b, GAN1',
            'projectgrootte' => 20,
            'leverancier' => 'Rijkswaterstaat',
        ]);
        DB::table('projects')->insert([
            'name' => 'Data Science',
            'competenties' => 'SON2b, GAN1',
            'projectgrootte' => 20,
            'leverancier' => 'Profit',
        ]);
        DB::table('projects')->insert([
            'name' => 'VR omgeving bouwen',
            'competenties' => 'SRE3a, SAD',
            'projectgrootte' => 15,
            'leverancier' => 'Damen',
        ]);
        DB::table('projects')->insert([
            'name' => 'Competentiemanagement tool ',
            'competenties' => 'GRE1, SAN2a',
            'projectgrootte' => 30,
            'leverancier' => 'HBO-ICT',
        ]);
    }
}
