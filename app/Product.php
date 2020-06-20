<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ["name", "publish_start", "publish_end", "price",'image'];

    public $timestamps = false;



}
