<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    
     public function deep() {
        return $this->hasMany('App\Models\Deep', 'product_id', 'id');
    } 
    public function station() {
        return $this->hasMany('App\Models\Station', 'product_id', 'id');
    }

     public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'product_id', 'id');
    }
    
    public function purchaschallan() {
        return $this->hasMany('App\Models\Purchaschallan', 'product_id', 'id');
    }
    public function tankloryitem() {
        return $this->hasMany('App\Models\Tankloryitem', 'product_id', 'id');
    }

}
