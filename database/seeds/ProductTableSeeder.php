<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create(['name' => 'Biotech motivációs bögre ',
                         'image' => 'demo.jpg',
                            'publish_start' => '2020-06-25 00:00:00',
                            'publish_end' => '2020-06-28 00:00:00',
                            'price' => '1337',
            ]);
    }
}
