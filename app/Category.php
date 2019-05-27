<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*plural because category has many items*/
    public function items(){
        return $this->hasMany('\App\Item');
    }
}
