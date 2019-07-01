<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanklory extends Model
{
    protected $table = 'tanklory_setting';
    public $timestamps = false;
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function chamber() {
        return $this->hasMany('App\Models\Chamber', 'tanklory_id', 'id');
    }
    public function chambercaliber() {
        return $this->hasMany('App\Models\Chambercaliber', 'tanklory_id', 'id');
    }
    public function tankloryproduct() {
        return $this->hasMany('App\Models\Tankloryproduct', 'tanklory_id', 'id');
    }
    
}
