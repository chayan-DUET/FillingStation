<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 'station_setting';
    public $timestamps = false;
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function deep() {
        return $this->belongsTo('App\Models\Deep', 'deep_id');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
     public function nogel() {
        return $this->hasMany('App\Models\Nogel', 'station_id', 'id');
    }
    
}
