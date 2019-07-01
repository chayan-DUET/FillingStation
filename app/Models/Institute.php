<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Institute extends Model {

    //

    public function users() {
        return $this->hasMany('App\Models\User', 'institute_id', 'id');
    }

    
    public function company() {
        return $this->hasMany('App\Models\Company', 'institute_id', 'id');
    } 
    public function category() {
        return $this->hasMany('App\Models\Category', 'institute_id', 'id');
    }
    public function product() {
        return $this->hasMany('App\Models\Product', 'institute_id', 'id');
    }

    public function heads() {
        return $this->hasMany('App\Models\Head', 'institute_id', 'id');
    }

    public function subheads() {
        return $this->hasMany('App\Models\SubHead', 'institute_id', 'id');
    }

    public function transactions() {
        return $this->hasMany('App\Models\CustomerTransaction', 'institute_id', 'id');
    }

     public function deep() {
        return $this->hasMany('App\Models\Deep', 'institute_id', 'id');
    }
    public function deepcaliber() {
        return $this->hasMany('App\Models\Deepcaliber', 'institute_id', 'id');
    }
    public function tanklory() {
        return $this->hasMany('App\Models\Tanklory', 'institute_id', 'id');
    }
    public function chamber() {
        return $this->hasMany('App\Models\Chamber', 'institute_id', 'id');
    }
    public function chambercaliber() {
        return $this->hasMany('App\Models\Chambercaliber', 'institute_id', 'id');
    }
    public function station() {
        return $this->hasMany('App\Models\Station', 'institute_id', 'id');
    }
    public function nogel() {
        return $this->hasMany('App\Models\Nogel', 'institute_id', 'id');
    }
    public function bank() {
        return $this->hasMany('App\Models\Bank', 'institute_id', 'id');
    }
    public function bankbranch() {
        return $this->hasMany('App\Models\Bankbranch', 'institute_id', 'id');
    }
    public function account() {
        return $this->hasMany('App\Models\Account', 'institute_id', 'id');
    }
    public function employee() {
        return $this->hasMany('App\Models\Employee', 'institute_id', 'id');
    }
    public function supplier() {
        return $this->hasMany('App\Models\Supplier', 'institute_id', 'id');
    }
    public function purchaseorder() {
        return $this->hasMany('App\Models\Purchaseorder', 'institute_id', 'id');
    }
    public function purchaseitem() {
        return $this->hasMany('App\Models\Purchaseitem', 'institute_id', 'id');
    }
    public function customer() {
        return $this->hasMany('App\Models\Customer', 'institute_id', 'id');
    }
      public function customerType() {
        return $this->hasMany('App\Models\CustomerType', 'institute_id', 'id');
    }
    public function purchaschallan() {
        return $this->hasMany('App\Models\Purchaschallan', 'institute_id', 'id');
    }
     public function tankloryproduct() {
        return $this->hasMany('App\Models\Tankloryproduct', 'institute_id', 'id');
    }
    public function stocks() {
        return $this->hasMany('App\Models\Stock', 'institute_id', 'id');
    }
 public function tankloryitem() {
        return $this->hasMany('App\Models\Tankloryitem', 'institute_id', 'id');
    }
    public static function get_institute_name_by_id($id) {
        $institute = Institute::find($id);
        return !empty($institute) ? $institute->name : '';
    }

    public static function get_institute_permission_by_id($id) {
        $permissions = DB::table('institute_permissions')->where('institute_id', '=', $id)->first()->permissions;
        return json_decode($permissions, true);
    }

}
