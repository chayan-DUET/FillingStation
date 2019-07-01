<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambercaliber extends Model
{
    protected $table = 'chamber_caliber_setting';
    public $timestamps = false;
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function tanklory() {
        return $this->belongsTo('App\Models\Tanklory', 'tanklory_id');
    } 
    public function chamber() {
        return $this->belongsTo('App\Models\Chamber', 'chamber_id');
    }
    
}
