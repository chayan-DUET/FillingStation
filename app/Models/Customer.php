<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer_setting';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
 
}
