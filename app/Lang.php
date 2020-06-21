<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $table = "lang";

    protected $fillable = ["name", "code"];
    public $timestamps = false;

}
