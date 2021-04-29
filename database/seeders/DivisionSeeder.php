<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{


    public function run()
    {

       
        Division::create([
            'name' => 'South',
            'conference' => 'NFC',
        ]);
        Division::create([
            'name' => 'North',
            'conference' => 'NFC',
        ]);

        Division::create([
            'name' => 'East',
            'conference' => 'AFC',
        ]);
        Division::create([
            'name' => 'West',
            'conference' => 'AFC',
        ]);


    }
}
