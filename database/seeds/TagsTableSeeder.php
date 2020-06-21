<?php

use App\Tags;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Tags::create(['name' =>'Akciós','code' => 'forsale' ]);
        Tags::create(['name' =>'Zsírégető','code' => 'fatburner' ]);
        Tags::create(['name' =>'Fehérje','code' => 'protein' ]);
        Tags::create(['name' =>'Vitamin','code' => 'vitamin' ]);
    }
}
