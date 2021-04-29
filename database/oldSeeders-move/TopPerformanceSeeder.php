<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TopPerformance;

class TopPerformanceSeeder extends Seeder
{
    // public function index()
    // {
    //   $topperformance = TopPerformance::all();
    //   return view('index', compact('topperformance'));      
    // }


    public function run()
    {

        TopPerformance::create([
         'name' => 'John Doe',
         'season' => 'Nolan Bowl VII',
         'performance' => '87.0588',    
        
        ]);
        TopPerformance::create([
         'name' => 'John Doee',
         'season' => 'Nolan Bowl XX',
         'performance' => '86.6667',  
        ]);
        TopPerformance::create([
         'name' => 'John Doed',
         'season' => 'Nolan Bowl XX',
         'performance' => '85.0000',  
        ]);
        TopPerformance::create([
         'name' => 'John Doeg',
         'season' => 'Nolan Bowl XV',
         'performance' => '82.0000',  
        ]);



    }
}
