<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee_info';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function purchaseorder() {
        return $this->hasMany('App\Models\Purchaseorder', 'employee_id', 'id');
    }
    public function purchaschallan() {
        return $this->hasMany('App\Models\Purchaschallan', 'employee_id', 'id');
    }
     public function tankloryproduct() {
        return $this->hasMany('App\Models\Tankloryproduct', 'employee_id', 'id');
    }
   
}
