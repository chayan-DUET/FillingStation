<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }

    public function product() {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }

    public function deep() {
        return $this->hasMany('App\Models\Deep', 'category_id', 'id');
    }

    public function station() {
        return $this->hasMany('App\Models\Station', 'category_id', 'id');
    }

     public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'category_id', 'id');
    }
     public function purchaschallan() {
        return $this->hasMany('App\Models\Purchaschallan', 'category_id', 'id');
    }
    public function tankloryitem() {
        return $this->hasMany('App\Models\Tankloryitem', 'category_id', 'id');
    }
}
