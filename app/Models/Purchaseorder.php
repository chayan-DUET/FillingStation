<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    protected $table = 'purchase_order';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function supplier() {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }
    public function employee() {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }
    public function purchaschallan() {
        return $this->belongsTo('App\Models\Purchaschallan', 'challan_id');
    } 
    public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'purchase_order_id', 'id');
    }

   


    

}
