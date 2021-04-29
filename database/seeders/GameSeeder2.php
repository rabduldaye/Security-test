<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder2 extends Seeder
{


    public function run()
    {



        $team1 = array(
            '2',
            '8',
            '24',
            '25',
            '52',
            '57',
            '58',
            '59',
            '61',
            '62',
            '68',
            '77',
            '84',
            '87',
            '96',
            '97',
            '99',
            '103',
            '127',
            '130',
            '135',
            '142',
            '145',
            '150',
            '152',
            '153',
            '154',
            '158',
            '164',
            '183',
            '193',
            
        );

        $team2 = array(
            '194',
            '195',
            '201',
            '213',
            '221',
            '228',
            '238',
            '239',
            '245',
            '251',
            '252',
            '258',
            '259',
            '275',
            '277',
            '333',
            '344',
            '349',
            '356',
            '2005',
            '2006',
            '2116',
            '2294',
            '2390',
            '2426',
            '2579',
            '2628',
            '2633',
            '2641',
            '2649',
            '2655',
            '2751',
        );

        $espnID = 401282722;
        $months = array('11','12','1');
        

        //create 50 games
        for ($i = 0; $i < 50; $i++) {
            Game::create([
                'espnID' => $espnID++,
                'name' => 'Game #' . ($i+1),
                'team1' => $team1[rand ( 0 , count($team1) -1)],
                'team1Name' => 'Team' . $team1[rand ( 0 , count($team1) -1)],
                'team2' => $team2[rand ( 0 , count($team2) -1)],
                'team2Name' => 'Team' . $team2[rand ( 0 , count($team2) -1)],
                'date' => Carbon::create('2021', $months[rand ( 0 , count($months) -1)], rand(1,30)),
                'points' => 3,
        
              ]);

        }


        /*
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

        */


    }
}
