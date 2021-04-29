<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Conference;
class DivisionSeeder2 extends Seeder
{


    public function run()
    {
    
        $conferences  = Conference::all();

        $divisionCounter = 1;

        foreach ($conferences as $conference) {
            //we need to create 8 divisions with unique names
            
            for ($j = 0; $j < 7; $j++) {
                Division::create([
                    'name' => 'Division (' . $divisionCounter++ . ')',
                    'conference' => $conference->name,
                ]);
            }
            
            
            
        }
    


    }
}
