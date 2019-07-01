<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank_setting';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function bankbranch() {
        return $this->hasMany('App\Models\Bankbranch', 'bank_id', 'id');
    }
    public function account() {
        return $this->hasMany('App\Models\Account', 'bank_id', 'id');
    }
    public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'bank_id', 'id');
    }

}
