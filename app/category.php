<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public $timestamps = false;
    protected $table = "categories";  
    
    public function posts()
    {
        return $this->hasMany('App\post');
    }
}
