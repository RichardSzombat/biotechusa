<?php

use App\Description;
use App\ProductDescription;
use Illuminate\Database\Seeder;

class ProductDescriptionTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ProductDescription::create(['product_id' =>'1','description_id' => '1' ]);
        ProductDescription::create(['product_id' =>'1','description_id' => '2' ]);
        ProductDescription::create(['product_id' =>'1','description_id' => '3' ]);
    }
}
