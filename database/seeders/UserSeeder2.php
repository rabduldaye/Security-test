<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Division;

class UserSeeder2 extends Seeder
{


    public function run()
    {

        //we need these two...
        User::create([
          'nickname' => 'The Michael',
          'firstname' => 'Mike',
          'lastname' => 'Ruth',
          'email' => 'mruth@roosevelt.edu',
          'password' => bcrypt('m'),
          'city' => 'Chicago',
          'state' => 'IL',
          'bowling' => '123',
          'cq1' => 'Eating More Than Vegeta',
          'cq2' => 'Krillin!',
          'favsport' => 'Martial Arts',
          'knowme' => 'You are the strongest of them all!',
          'news' => 'I am hungry',
          'division' => 'Division (1)',
          'conference' => 'AFC1',
          'smack' => 'Chi Chi lets me fight',
          'is_admin' => '1',
          'status' => 'current',
        ]);
        User::create([
          'nickname' => 'Ruthless',
          'firstname' => 'Ruth',
          'lastname' => 'Michael',
          'email' => 'n@n.com',
          'password' => bcrypt('n'),
          'city' => 'Cypress',
          'state' => 'CA',
          'bowling' => '456',
          'cq1' => 'Getting a Hole in One!',
          'cq2' => 'Myself',
          'favsport' => 'Not golf',
          'knowme' => 'From tha party',
          'news' => 'Check the stats!',
          'smack' => 'Come beat me',
          'division' => 'Division (1)',
          'conference' => 'AFC1',
          'is_admin' => '0',
          'status' => 'current',
        ]);

        //now let's set up some random data:

        //array of first names
        $firstname = array(
            'Jameis',
            'Wil',
            'Blake',
            'Taysom',
            'Christian',
            'Jalen',
            'Tanoh',
            'TreQuan',
            'Deonte',
            'Marquez',
            'Michael',
            'Trevor',
            'Jake',
            'Patrick',
            'C.J.',
            'Marshon',
            'Dwayne',
            'P.J.',
            'Malcolm',
            'Latavius',
            'Grant',
            'Tony',
            'Keith',
            'Alexander',
            'Alvin',
            'Chase',
            'Marcus',
            'Garrett',
            'J.T.',
            'Zach',
            'Andrew',
            'Cesar',
            'Zack',
            'Wynton',
            'Kaden',
            'Demario',
            'Noah',
            'Marcus',
            'Will',
            'Calvin',
            'Derrick',
            'Christian',
            'Ryan',
            'Terron',
            'Ethan',
            'James',
            'Andrus',
            'Jalen',
            'Erik',
            'Nick',
            'Adam',
            'Juwan',
            'LilJordan',
            'Ethan',
            'Ty',
            'Marcus',
            'David',
            'Cameron',
            'Ryan',
            'Carl',
            'Malcolm',
            'Shy'
            );
        
        $lastname = array(
                'Winston',
                'Lutz',
                'Gillikin',
                'Hill',
                'Montano',
                'McCleskey',
                'Kpassagnon',
                'Smith',
                'Harris',
                'Callaway',
                'Thomas',
                'Siemian',
                'Lampman',
                'Robinson',
                'Gardner-Johnson',
                'Lattimore ',
                'Washington',
                'Williams',
                'Jenkins',
                'Murray',
                'Haley',
                'Jones',
                'Washington',
                'Armah ',
                'Kamara',
                'Hansen',
                'Williams',
                'Griffin',
                'Gray',
                'Wood',
                'Dowell',
                'Ruiz',
                'Baun',
                'McManis',
                'Elliss',
                'Davis',
                'Spence',
                'Willoughby',
                'Clapp',
                'Throckmorton',
                'Kelly',
                'Ringo',
                'Ramczyk',
                'Armstead',
                'Greenidge',
                'Hurst',
                'Peat',
                'Dalton',
                'McCoy',
                'Vannett',
                'Trautman',
                'Johnson',
                'Humphrey',
                'Wolf',
                'Montgomery',
                'Davenport',
                'Onyemata',
                'Jordan',
                'Glasgow',
                'Granderson',
                'Roach',
                'Tuttle',
                
            );

        $nicks =  array('QB','T','G','C','WR','TE','RB','DE','DT','LB','CB','SS','FS');
        
        $cities = array('Chicago','New Orleans','Los Angeles','New York','Boston','Houston','Atlanta','Tampa Bay','Charleston');

        $states = array('IL','LA','CA','NY','TX','GA','FL','NC');
            
        
        $divisions = Division::all();
        $counter = 0;
        $uniqCounter = 0;
        foreach ($divisions as $division) {
          echo 'Creating User #' . $counter++ . "\n";
          if ($division->name == 'Division (1)') {
            //create 4 for this division
            for ($i = 0; $i < 4; $i++) {
              User::create([
                'nickname' => $nicks[rand ( 0 , count($nicks) -1)],
                'firstname' => $firstname[rand ( 0 , count($firstname) -1)],
                'lastname' => $lastname[rand ( 0 , count($lastname) -1)],
                'email' => $lastname[rand ( 0 , count($lastname) -1)] . $uniqCounter++ . '@n.com',
                'password' => bcrypt('n'),
                'city' => $cities[rand ( 0 , count($cities) -1)],
                'state' => $states[rand ( 0 , count($states) -1)],
                'bowling' => '456',
                'cq1' => 'How High? Chicken Thigh?',
                'cq2' => 'What? what? chicken butt!',
                'favsport' => 'Making students cry',
                'division' => $division->name,
                'conference' =>  $division->conference,
                'knowme' => 'I met you when I met you and not one second earlier',
                'news' => 'COVID SUCKS',
                'smack' => 'Come get some',
                'is_admin' => '0',
                'status' => 'current',
              ]);
            }
          } else {
            //create 6 for this division
            for ($i = 0; $i < 6; $i++) {
              User::create([
                'nickname' => $nicks[rand ( 0 , count($nicks) -1)],
                'firstname' => $firstname[rand ( 0 , count($firstname) -1)],
                'lastname' => $lastname[rand ( 0 , count($lastname) -1)],
                'email' => $lastname[rand ( 0 , count($lastname) -1)] . $uniqCounter++ . '@n.com',
                'password' => bcrypt('n'),
                'city' => $cities[rand ( 0 , count($cities) -1)],
                'state' => $states[rand ( 0 , count($states) -1)],
                'bowling' => '456',
                'cq1' => 'How High? Chicken Thigh?',
                'cq2' => 'What? what? chicken butt!',
                'favsport' => 'Making students cry',
                'division' => $division->name,
                'conference' =>  $division->conference,
                'knowme' => 'I met you when I met you and not one second earlier',
                'news' => 'COVID SUCKS',
                'smack' => 'Come get some',
                'is_admin' => '0',
                'status' => 'current',
              ]);
            }
          }



        }


        



















    }

}
       
