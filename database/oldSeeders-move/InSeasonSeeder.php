<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Game;
use App\Models\InSeason;



class InSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        //now for each user, make a selection
        foreach ($users as $user) {
            
            echo $user->id;
            echo "\n";
            
            

            InSeason::create([
                    'userid' => $user->id,                    
            ]); 
            
        }



    }
}
