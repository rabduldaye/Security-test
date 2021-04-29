<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Game;
use App\Models\GamePick;

class GamePicks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $games = Game::all();
        $users = User::all();

        //now for each user, make a selection
        foreach ($users as $user) {
            foreach ($games as $game) {
                //choice array
                $select = array($game->team1,$game->team2);

                echo $user->id;
                echo "\n";
                echo $game->espnID;
                echo "\n";
                echo $select[rand(0,1)];
                echo "\n";
                echo "\n";
                
                GamePick::create([
                    'userid' => $user->id,
                    'gameid' => $game->espnID,
                    'selection' => $select[rand(0,1)],

                ]); 
            }
        }
        
    
    }
}
