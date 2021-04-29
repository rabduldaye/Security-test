<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AllTimeRank;

class AllTimeRankSeeder extends Seeder 
{


    public function run()
    {

        AllTimeRank::create([
            'id' => '1',
            'name' => 'John Doe 1',
            'points' => '435',
            'rank' => '3',
        ]);

        AllTimeRank::create([
            'id' => '2',
            'name' => 'John Doe 2',
            'points' => '487',
            'rank' => '2',
        ]);

        AllTimeRank::create([
            'id' => '3',
            'name' => 'John Doe 3',
            'points' => '558',
            'rank' => '1',
        ]);



    }
}