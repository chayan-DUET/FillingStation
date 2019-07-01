<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nogel extends Model
{
    protected $table = 'nozel_setting';
    public $timestamps = false;
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function deep() {
        return $this->belongsTo('App\Models\Deep', 'deep_id');
    }
    public function station() {
        return $this->belongsTo('App\Models\Station', 'station_id');
    }
    
}
