<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Nbi;

class NBISeeder extends Seeder
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
            Nbi::Create([
                'id' => $user->id,
                'nickname' => $user->nickname,
                'nbiraw' => floatval(rand(1,100)/1000),

            ]); 

            

        }
    }
}
