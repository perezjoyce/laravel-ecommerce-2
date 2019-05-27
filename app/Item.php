<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /*named as such because this defines relationship
    between the two Models

    category is singular because rel is one to may: 
    -- 1 category has many items

    this item belongs to a category
    */
    public function category() {
        return $this->belongsTo('\App\Category');
    }
}
