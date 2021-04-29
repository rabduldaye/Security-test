<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
            'welcome' => 'Welcome to Nolan Bowl XXI',
            'title' => 'Nolan Bowl XXX',
            'rules' => '1. Each bowl game is assigned a point value that corresponds roughly to its relative payout (so "how good" the bowl is), selected by \'The Admin\'. Better bowls are worth more points, and the highest point total wins.
                       <br><br>
                       2. TIEBREAKERS: (a) The 1st tiebreaker is "did you pick Michigan?" with those who did not being eliminated in favor of those who did [Go Blue!]; (b) The 2nd tiebreaker is "did you pick Notre Dame?" with those who did being eliminated in favor of those who did not [the "Returning to Glory since 1993" provision]; (c) If there is still a tie, cumulative overall number of games picked correctly will determine the champion; (d) In the event a tie is STILL in effect, we will begin with the final bowl and work backward through the games, eliminating those that picked incorrectly closest to the end of the bowl season until a winner emerges; (e) If there is still a tie (identical submissions), a coin will be flipped to determine the champion.
                       <br><br>
                       3. Divisions and Conferences will be created and named arbitrarily by \'The Admin\', and mean nothing in terms of winning the pool. They\'re just fun.
                       <br><br>
                       4. Entry for Nolan Bowl XX is 免费 (free, as always), and the grand prize is status as Nolan Bowl XX Champion, which gains you admission to the Nolan Bowl Hall of Champions.
                       <br><br>',
            'mapembed' => '<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1V4wXaqc_hcB5uQ2TTWHCFEPGVey8PAyV" width="640" height="480"></iframe>',
            'seasonlock' => 'no',
            'cq1' => 'How tall are you really?',
            'cq2' => 'Are you sure you\'re ready for football?',
        ]);

        
    }
}
