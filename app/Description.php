<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $table = "description";

    protected $fillable = ['text', 'lang_id'];
    public $timestamps = false;

    //


}
