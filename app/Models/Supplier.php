<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier_setting';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

     public function purchaseorder() {
        return $this->hasMany('App\Models\Purchaseorder', 'supplier_id', 'id');
    }
    public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'supplier_id', 'id');
    }
    
    public function purchaschallan() {
        return $this->hasMany('App\Models\Purchaschallan', 'supplier_id', 'id');
    }
     public function category() {
        return $this->hasMany('App\Models\Category');
    }

}
