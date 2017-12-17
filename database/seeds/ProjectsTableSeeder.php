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
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'project datawerken',
            'competenties' => 'SAN2a, SON2a, SAD, GAN1, SRE1a, SRE1b',
            'projectgrootte' => 12,
            'leverancier' => 'test',
        ]);
    }
}
