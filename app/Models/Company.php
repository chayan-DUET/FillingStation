<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function deep() {
        return $this->hasMany('App\Models\Deep', 'company_id', 'id');
    }

    public function tanklory() {
        return $this->hasMany('App\Models\Tanklory', 'company_id', 'id');
    }
    public function supplier() {
        return $this->hasMany('App\Models\Supplier', 'company_id', 'id');
    }
    
    public function purchaseorder() {
        return $this->hasMany('App\Models\Purchaseorder', 'company_id', 'id');
    }
     public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'company_id', 'id');
    }
    public function purchaschallan() {
        return $this->hasMany('App\Models\Purchaschallan', 'company_id', 'id');
    }
}
