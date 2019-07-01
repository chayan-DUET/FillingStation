<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bankbranch extends Model
{
    protected $table = 'branch_setting';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function bank() {
        return $this->belongsTo('App\Models\Bank', 'bank_id');
    }
     public function account() {
        return $this->hasMany('App\Models\Account', 'branch_id', 'id');
    }

     public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'branch_id', 'id');
    }
}
