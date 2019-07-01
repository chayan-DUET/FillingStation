<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deepcaliber extends Model
{
    protected $table = 'deep_caliber_setting';
    public $timestamps = false;

    
    public function institute() {
        return $this->belongsTo('App\Models\Institute', 'institute_id');
    }
    public function deep() {
        return $this->belongsTo('App\Models\Deep', 'deep_id');
    }
}
