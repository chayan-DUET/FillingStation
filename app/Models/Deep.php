<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deep extends Model
{
    protected $table = 'deep_setting';
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
     public function unit() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function deepcaliber() {
        return $this->hasMany('App\Models\Deepcaliber', 'deep_id', 'id');
    }
    public function station() {
        return $this->hasMany('App\Models\Station', 'deep_id', 'id');
    }
    
    public function nogel() {
        return $this->hasMany('App\Models\Nogel', 'deep_id', 'id');
    }
}
