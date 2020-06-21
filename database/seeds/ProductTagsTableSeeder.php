<?php

use App\ProductTags;
use Illuminate\Database\Seeder;

class ProductTagsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ProductTags::create(['product_id' =>'1','tag_id' => '1' ]);
    }
}
