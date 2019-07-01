<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tankloryitem extends Model
{
    protected $table = 'tanklory_item';
    public $timestamps = false;
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    
    public function tankloryproduct() {
        return $this->belongsTo('App\Models\Tankloryproduct', ' product_tanklory_id');
    }


    
    
}
