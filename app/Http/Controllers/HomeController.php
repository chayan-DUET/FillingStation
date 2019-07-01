<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;

class HomeController extends Controller {

    public $_settings = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$language = Session::get('locale');
        //App::setLocale($language);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.index');
    }

    public function getSettings() {
        return GeneralSetting::get_setting();
    }

    public function UrlEncrypt($id) {
        return Crypt::encrypt($id);
    }

    public function UrlDecrypt($id) {
        return Crypt::decrypt($id);
    }

}
