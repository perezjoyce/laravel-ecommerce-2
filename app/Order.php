<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    public function user() {
        return $this->belongsTo('\App\User');
    }
    //singular because an order has 1 status only
    public function status() {
        return $this->belongsTo('\App\Status');
    }

    //many to many hence plurarl
    //item_orders is the name of the pivot table

    // public function items(){
    //     return $this->belongsToMany('\App\Item', 'item_orders');
    // }

    //define quantity and timestamp in pivot table
    //because by default, laravel table only recognizes the ids
    //of the two main tables in the many-to-many rel
    public function items(){
        return $this->belongsToMany('\App\Item', 'item_orders')->withPivot('quantity')->withTimeStamps();
    }

    //remove withPivot() if there is no additional column
    //if more than 1
    // public function items(){
    //     return $this->belongsToMany('\App\Item', 'item_orders')->withPivot('quantity', 'price', 'total')->withTimeStamps();
    // }

    //We no longer employ CRUD inside our PIVOT tables. To save data, we use the method attach(). To remove data, use detach().

}
