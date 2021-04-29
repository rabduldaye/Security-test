<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MostDivisions;

class MostDivisionsSeeder extends Seeder
{


    public function run()
    {

        MostDivisions::create([
            'name' => 'c',
            'wins' => '3'
        ]);

        MostDivisions::create([
            'name' => 'b',
            'wins' => '9'
        ]);

        MostDivisions::create([
            'name' => 'e',
            'wins' => '5'
        ]);




    }
}
