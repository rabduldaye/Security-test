<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{


    public function run()
    {

       Game::create([
        'espnID' => 401282772,
        'name' => 'Battle for Battle Creek',
        'team1' => '130',
        'team1Name' => 'Michigan',
        'team2' => '2711',
        'team2Name' => 'Western Michigan',
        'date' => Carbon::create('2021', '03', '29'),
        'points' => 3,

      ]);

      
      Game::create([
        'espnID' => 401282614,
        'name' => 'Notre Dame vs. Florida State',
        'team1' => '87',
        'team1Name' => 'Notre Dame',
        'team2' => '52',
        'team2Name' => 'Florida State',
        'date' => Carbon::create('2021', '03', '24'),
        'points' => 3,

      ]);

      
      Game::create([
        'espnID' => 401287156,
        'name' => 'Florida VS Tennessee',
        'team1' => '57',
        'team1Name' => 'Florida',
        'team2' => '2633',
        'team2Name' => 'Tennessee',
        'date' => Carbon::create('2021', '03', '10'),
        'points' => 3,

      ]);

      Game::create([
        'espnID' => 401296393,
        'name' => 'Ohio State VS Purdue',
        'team1' => '194',
        'team1Name' => 'Ohio State',
        'team2' => '2509',
        'team2Name' => 'Purdue',
        'date' => Carbon::create('2021', '03', '12'),
        'points' => 3,
      ]);

      
      Game::create([
        'espnID' => 401309833,
        'name' => 'The I Want to Go There Bowl',
        'team1' => '62',
        'team1Name' => 'Hawaii',
        'team2' => '26',
        'team2Name' => 'UCLA',
        'date' => Carbon::create('2021', '03', '15'),
        'points' => 3,
      ]);




    }
}
