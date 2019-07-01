<?php

function pr($object, $exit = true) {
    echo '<pre>';
    print_r($object);
    echo '</pre>';

    if ($exit == true) {
        exit;
    }
}

function date_ymd($date) {
    return !empty($date) ? date("Y-m-d", strtotime($date)) : '';
}

function date_dmy($date) {
    return !empty($date) ? date("d-m-Y", strtotime($date)) : '';
}

function uniqueKey() {
    return md5(uniqid() . date('s'));
}

function has_flash_message() {
    return Session::has('success') OR Session::has('info') OR Session::has('warning') OR Session::has('danger');
}

function view_flash_message() {
    $retVal = "";
    if (Session::get('success')) {
        $retVal = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . Session::get('success') . "</div>";
    } elseif (Session::get('info')) {
        $retVal = "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . Session::get('info') . "</div>";
    } elseif (Session::get('warning')) {
        $retVal = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . Session::get('warning') . "</div>";
    } elseif (Session::get('danger')) {
        $retVal = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . Session::get('danger') . "</div>";
    } else {
        $retVal = "";
    }

    return $retVal;
}

function user_access_item_by_institute($id) {
    $permissions = DB::table('institute_permissions')->where('institute_id', '=', $id)->first()->permissions;
    $access_items = json_decode($permissions, true);
    //pr($access_items);
    return $access_items;
}

// function user_access_items () {
//     $access_items = array (
//         'setting' => 'Setting',
//         'generel_setting' => 'General Setting',
//         'generel_setting_update' => 'General Setting Update',
//         'purchase_price_setting' => 'Purchase Price Setting',
//         'sale_price_setting' => 'Sale Price Setting',
//         'supplier' => 'Supplier List',
//         'supplier_create' => 'Supplier Create ',     
//         'supplier_edit' => 'Supplier Edit ',     
//         'supplier_delete' => 'Supplier Delete ',
//         'customer' => 'Customer List', 
//         'customer_create' => 'Customer Create ',
//         'customer_edit' => 'Customer Edit ',
//         'customer_delete' => 'Customer Delete ',
//         'raw_material_setting' => 'Raw Material Setting',
//         'product_category' => 'Product Category',
//         'product_category_create' => 'Product Category Create',
//         'product_category_edit' => 'Product Category Edit',
//         'product_category_delete' => 'Product Category Delete',
//         'after_production' => 'After Production',
//         'after_production_create' => 'After Production Create',
//         'after_production_edit' => 'After Production Edit',
//         'after_production_delete' => 'After Production Delete',  
//         'product' => 'Product',
//         'product_create' => 'Product Create',
//         'product_edit' => 'Product Edit',
//         'product_delete' => 'Product Delete',   
//         'product_number' => 'Product Number',   
//         'product_number_create' => 'Product Number Create',
//         'product_number_edit' => 'Product Number Edit',
//         'product_number_delete' => 'Product Number Delete',
//         'manage_order' => 'Manage Order',
//         'manage_purchase' => 'Manage Purchase',
//         'purchase_create' => 'Purchase Create',
//         'purchase_confirm' => 'Purchase Confirm',
//         'purchase_edit' => 'Purchase Edit',
//         'purchase_delete' => 'Purchase Delete',
//         'purchase_list' => 'Purchase List',       
//         'manage_sales' => 'Manage Sales',
//         'sale_create' => 'Sale Create',
//         'sale_edit' => 'Sale Edit',
//         'sale_confirm' => 'Sale Confirm',
//         'sale_delete' => 'Sale Delete',
//         'sale_list' => 'Sale List',   
//         'manage_production' => 'Manage Production',
//         'production_order' => 'Production Order',
//         'production_order_create' => 'Production Order Create',
//         'production_order_edit' => 'Production Order Edit',
//         'production_order_delete' => 'Production Order Delete',
//         'production_order_confirm' => 'Production Order Confirm',
//         'production_stocks' => 'Production Stocks',
//         'manage_stocks' => 'Manage Stocks',
//         'manage_user' => 'Manage User',        
//         'user_create' => 'User Create',
//         'user_edit' => 'User Edit',
//         'user_delete' => 'User Delete',
//         'user_access' => 'User Access',
//         'user_status' => 'User Status',
//         'manage_finance' => 'Manage Finance',
//         'account_head' => 'Account Head',
//         'bank_account_setting' => 'Bank Account Setting',
//         );
//     return $access_items;
// }

function default_user_access_items() {
    $access_items = array(
        'setting' => 'Setting',
        'generel_setting' => 'General Setting',
        'generel_setting_update' => 'General Setting Update',
    );
    return $access_items;
}

function institute_access_items() {
    $access_items = array(
        'setting' => 'Setting',
        'generel_setting' => 'General Setting',
        'generel_setting_update' => 'General Setting Update',
        'chamber_setting' => 'Chamber Setting',
        'mill_setting' => 'Mill Setting',
        'manage_category' => 'Manage Category',
        'manage_purchase' => 'Manage Purchase',
        'purchase_create' => 'Purchase Create',
        'purchase_edit' => 'Purchase Edit',
        'purchase_delete' => 'Purchase Delete',
        'manage_rawbricks' => 'Manage Raw Bricks',
        'rawbricks_delete' => 'Raw Bricks Delete',
        'manage_loading' => 'Manage Loading',
        'loading_delete' => 'Loading Delete',
        'manage_unloading' => 'Manage Unloading',
        'unloading_delete' => 'Unloading Delete',
        'manage_sales' => 'Manage Sales',
        'sale_create' => 'Sale Create',
        'sale_edit' => 'Sale Edit',
        'sale_delete' => 'Sale Delete',
        'manage_customer' => 'Manage Customer',
        'manage_supplier' => 'Manage Supplier',
        'customer_create' => 'Customer Create',
        'customer_edit' => 'Customer Edit',
        'customer_delete' => 'Customer Delete',
        'supplier_create' => 'Supplier Create',
        'supplier_edit' => 'Supplier Edit',
        'supplier_delete' => 'Supplier Delete',
        'manage_stocks' => 'Manage Stocks',
        'manage_user' => 'Manage User',
        'user_create' => 'User Create',
        'user_edit' => 'User Edit',
        'user_delete' => 'User Delete',
        'user_access' => 'User Access',
        'user_status' => 'User Status',
        'institute_create' => 'Institute Create',
        'institute_edit' => 'Institute Edit',
        'institute_delete' => 'Institute Delete',
        'institute_access' => 'Institute Access',
        'institute_status' => 'Institute Status',
        'manage_account' => 'Manage Accounts',
        'head_create' => 'Head Create',
        'head_edit' => 'Head Edit',
        'head_delete' => 'Head Delete',
        'subhead_create' => 'Subhead Create',
        'subhead_edit' => 'Subhead Edit',
        'subhead_delete' => 'Subhead Delete',
        'particular_create' => 'Particular Create',
        'particular_edit' => 'Particular Edit',
        'particular_delete' => 'Particular Delete',
        'transaction' => 'Transaction',
        'ledger' => 'Ledger',
        'daily_sheet' => 'Daily Sheet',
        'deep_create' => 'Deep Create',
        'deep_edit' => 'Deep Edit',
        'deep_delete' => 'Deep Delete',
    );
    return $access_items;
}

function default_institute_access_items() {
    $access_items = array(
        'setting' => 'Setting',
        'generel_setting' => 'General Setting',
        'generel_setting_update' => 'General Setting Update',
        'manage_user' => 'Manage User',
    );
    return $access_items;
}

function has_user_access($access) {
    $id = Auth::id();
    $permissions = DB::table('user_permissions')->where('user_id', '=', $id)->first()->permissions;
    $access_items = json_decode($permissions, true);
    if (!empty($access_items)) {
        if (array_key_exists($access, $access_items)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function check_user_access($access) {
    if (has_user_access($access)) {
        return true;
    } else {
        return redirect()->back()->with('danger', 'You are not authorized to perform this action')->send();
    }
}

function is_Admin() {
    if (Auth::user()->type == 'admin') {
        return true;
    } else {
        return false;
    }
}

function is_Ajax($request) {
    if ($request->ajax()) {
        return true;
    } else {
        return redirect()->back()->with('danger', 'Invalid URL')->send();
    }
}

function show_hide() {
    return is_Admin() ? "" : "hide_column";
}

function colspan($a, $b) {
    return is_Admin() ? $a : $b;
}

function institute_id() {
    return Auth::user()->institute_id;
}

function print_header($title, $_mpmt = true, $_visible = false) {
    $_sip = ($_visible == true) ? '' : 'show_in_print';
    $_mt = ($_mpmt == false) ? '' : 'mpmt';

    $setting = \App\Models\GeneralSetting::get_setting();
    $str = "<div class='invoice_heading {$_mt} {$_sip}'>";
    $str .= "<div class='text-center'>";
    $str .= "<h3 style='margin:0px;'>{$setting->title}</h3>";
    $str .= "<span>{$setting->address}</span><br/>";
    $str .= "<span>Contact : {$setting->mobile}</span><br/>";
    $str .= "<span style='display:block;margin-bottom:5px; text-decoration:underline;'><strong>{$title}</strong></span>";
    $str .= "</div>";
    $str .= "</div>";
    echo $str;
}


    // $nwords = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", 30 => "thirty", 40 => "forty", 50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eighty", 90 => "ninety");
    // if (!is_numeric($x)) {
    //     $w = '#';
    // } else if (fmod($x, 1) != 0) {
    //     $w = '#';
    // } else {
    //     if ($x < 0) {
    //         $w = 'minus ';
    //         $x = -$x;
    //     } else {
    //         $w = '';
    //     }
    //     if ($x < 21) {
    //         $w .= $nwords[floor($x)];
    //     } else if ($x < 100) {
    //         $w .= $nwords[10 * floor($x / 10)];
    //         $r = fmod($x, 10);
    //         if ($r > 0) {
    //             $w .= '-' . $nwords[$r];
    //         }
    //     } else if ($x < 1000) {
    //         $w .= $nwords[floor($x / 100)] . ' hundred' . " taka only";
    //         $r = fmod($x, 100);
    //         if ($r > 0) {
    //             $w .= ' and ' . int_to_words($r);
    //         }
    //     } else if ($x < 100000) {
    //         $w .= int_to_words(floor($x / 1000)) . ' thousand' . " taka only";
    //         $r = fmod($x, 1000);
    //         if ($r > 0) {
    //             $w .= ' ';
    //             if ($r < 100) {
    //                 $w .= 'and ';
    //             }
    //             $w .= int_to_words($r);
    //         }
    //     } else {
    //         $w .= int_to_words(floor($x / 100000)) . ' lakh' . " taka only";
    //         $r = fmod($x, 100000);
    //         if ($r > 0) {
    //             $w .= ' ';
    //             if ($r < 100) {
    //                 $word .= 'and ';
    //             }
    //             $w .= int_to_words($r);
    //         }
    //     }
    // return $w;
    // }
    
