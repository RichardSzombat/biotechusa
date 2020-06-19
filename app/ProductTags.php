<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTags extends Model
{
    protected $table = "product_tags";
    protected $fillable = ["product_id", "tag_id"];
    public $timestamps = false;
}
