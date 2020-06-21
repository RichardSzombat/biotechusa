<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductDescription extends Model
{
    protected $table = "product_description";

    protected $fillable = ["product_id","description_id"];
    public $timestamps = false;
    //

}
