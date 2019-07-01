<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchaschallan extends Model
{
    protected $table = 'purchase_challan';
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
    public function purchaseorder() {
        return $this->belongsTo('App\Models\Purchaseorder', 'purchase_order_id');
    }
    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function purchasechallan() {
        return $this->hasMany('App\Models\Tankloryproduct', 'challan_id', 'id');
    }
     

}
