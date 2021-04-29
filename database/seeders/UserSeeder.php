<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{


    public function run()
    {

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
          'is_admin' => '0',
          'status' => 'current',
        ]);
        User::create([
          'nickname' => 'Breesy',
          'firstname' => 'Drew',
          'lastname' => 'Brees',
          'email' => 'b@b.com',
          'password' => bcrypt('b'),
          'city' => 'New Orleans',
          'state' => 'LA',
          'bowling' => '456',
          'cq1' => 'Getting a Hole in One!',
          'cq2' => 'Myself',
          'favsport' => 'Not golf',
          'knowme' => 'From tha party',
          'news' => 'Check the stats!',
          'smack' => 'Come beat me',
          'is_admin' => '0',
          'status' => 'current',
        ]);
        User::create([
          'nickname' => 'Ruthless',
          'firstname' => 'What',
          'lastname' => 'Ruth',
          'email' => 'r@r.com',
          'password' => bcrypt('r'),
          'city' => 'New Orleans',
          'state' => 'LA',
          'bowling' => '456',
          'cq1' => 'Getting a Hole in One!',
          'cq2' => 'Myself',
          'favsport' => 'Not golf',
          'knowme' => 'From tha party',
          'news' => 'Check the stats!',
          'smack' => 'Come beat me',
          'is_admin' => '0',
          'status' => 'current',
        ]);
        User::create([
          'nickname' => 'the leg',
          'firstname' => 'Thomas',
          'lastname' => 'Moorestead',
          'email' => 't@t.com',
          'password' => bcrypt('t'),
          'city' => 'New Orleans',
          'state' => 'LA',
          'bowling' => '456',
          'cq1' => 'Getting a Hole in One!',
          'cq2' => 'Myself',
          'favsport' => 'Not golf',
          'knowme' => 'From tha party',
          'news' => 'Check the stats!',
          'smack' => 'Come beat me',
          'is_admin' => '0',
          'status' => 'current',
        ]);
        User::create([
          'nickname' => 'MOM',
          'firstname' => 'Elizabeth',
          'lastname' => 'Ruth',
          'email' => 'e@e.com',
          'password' => bcrypt('t'),
          'city' => 'New Orleans',
          'state' => 'LA',
          'bowling' => '456',
          'cq1' => 'Getting a Hole in One!',
          'cq2' => 'Myself',
          'favsport' => 'Not golf',
          'knowme' => 'From tha party',
          'news' => 'Check the stats!',
          'smack' => 'Come beat me',
          'is_admin' => '0',
          'status' => 'current',
        ]);
        User::create([
          'nickname' => 'Sister',
          'firstname' => 'Estelle',
          'lastname' => 'Quijano',
          'email' => 'q@q.com',
          'password' => bcrypt('q'),
          'city' => 'New Orleans',
          'state' => 'LA',
          'bowling' => '456',
          'cq1' => 'Getting a Hole in One!',
          'cq2' => 'Myself',
          'favsport' => 'Not golf',
          'knowme' => 'From tha party',
          'news' => 'Check the stats!',
          'smack' => 'Come beat me',
          'is_admin' => '0',
          'status' => 'current',
        ]);
        User::create([
          'nickname' => 'Nephew',
          'firstname' => 'Anthony',
          'lastname' => 'Quijano',
          'email' => 'a@a.com',
          'password' => bcrypt('a'),
          'city' => 'New Orleans',
          'state' => 'LA',
          'bowling' => '456',
          'cq1' => 'Getting a Hole in One!',
          'cq2' => 'Myself',
          'favsport' => 'Not golf',
          'knowme' => 'From tha party',
          'news' => 'Check the stats!',
          'smack' => 'Come beat me',
          'is_admin' => '0',
          'status' => 'current',
        ]);
       




    }
}
