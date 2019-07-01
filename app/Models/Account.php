<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account  extends Model
{
    protected $table = 'account_setting';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function bank() {
        return $this->belongsTo('App\Models\Bank', 'bank_id');
    }
    public function bankbranch() {
        return $this->belongsTo('App\Models\Bankbranch', 'branch_id');
    }
    
     public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'account_id', 'id');
    }
     

}
