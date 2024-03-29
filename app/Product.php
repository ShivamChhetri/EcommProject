<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Table name
    protected $table="products";
    // Primary key
    public $primaryKey= "id";
    // Timestamps
    public $timestamps= true;

    public function productPic(){
        return $this->hasOne('App\ProductPic');
    }
}