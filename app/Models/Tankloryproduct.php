<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tankloryproduct extends Model
{
    protected $table = 'tanklory';
    public $timestamps = false;
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function employee() {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }
    public function tanklory() {
        return $this->belongsTo('App\Models\Tanklory', 'tanklory_id');
    }
    public function purchasechallan() {
        return $this->belongsTo('App\Models\Purchaschallan', 'challan_id');
    }
    public function tankloryitem() {
        return $this->hasMany('App\Models\Tankloryitem', 'product_tanklory_id', 'id');
    }

    
}
