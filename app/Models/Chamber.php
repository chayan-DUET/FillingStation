<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamber extends Model
{
    protected $table = 'chamber_setting';
    public $timestamps = false;
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function tanklory() {
        return $this->belongsTo('App\Models\Tanklory', 'tanklory_id');
    }
    public function chambercaliber() {
        return $this->hasMany('App\Models\Chambercaliber', 'chamber_id', 'id');
    }
    public function tankloryitem() {
        return $this->hasMany('App\Models\Tankloryitem', 'chamber_id', 'id');
    }
}
