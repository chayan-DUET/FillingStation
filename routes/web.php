<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('site.index');
});

Auth::routes();
Route::group(['middleware'=>'AuthenticateMiddleware'],function(){
//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    //Cache::flush();
    return redirect()->back()->with('success', 'Page Refresh Successfull');
});

Route::get('/home', 'HomeController@index')->name('home');


// General Settings Route
Route::get('/general-setting', 'GeneralSettingController@index');
Route::post('/update-setting', 'GeneralSettingController@update_setting');


// Resource Route for HeadController
Route::resource('head', 'HeadController');
Route::post('head/search', 'HeadController@search');
Route::post('head/delete', 'HeadController@delete');

// Resource Route for SubHeadController
Route::resource('subhead', 'SubHeadController');
Route::post('subhead/search', 'SubHeadController@search');
Route::post('subhead/delete', 'SubHeadController@delete');
Route::post('subhead/subhead', 'SubHeadController@get_sub_head');


// Resource Route for Particular
Route::resource('particulars', 'ParticularController');
Route::post('particulars/search', 'ParticularController@search');
Route::post('particulars/delete', 'ParticularController@delete');
Route::post('particulars/particular', 'ParticularController@get_particular');

// Resource Route for Transactions
Route::resource('transactions', 'TransactionController');
Route::get('transactions/create/{tp}', 'TransactionController@create');
Route::post('transactions/search', 'TransactionController@search');
Route::post('transactions/delete', 'TransactionController@delete');
Route::post('transactions/subhead', 'TransactionController@get_sub_head');
Route::get('transaction/expense', 'TransactionController@expenses');
Route::post('transactions/expense-search', 'TransactionController@expense_search');


// Resource Route for Ledger Controller 
Route::get('daily_report', 'LedgerController@daily_report');
Route::get('ledger/dailysheet', 'LedgerController@daily_sheet');
Route::post('ledger/dailysheet/search', 'LedgerController@daily_sheet_search');
Route::get('business-ledger/{id}', 'BusinessLedgerController@view');
Route::resource('ledger', 'LedgerController');
Route::get('ledger-view', 'LedgerController@view_ledger');
Route::post('ledger/search', 'LedgerController@ledger_search');
Route::get('ledger/head/{id}', 'LedgerController@head_transaction');
Route::post('ledger/head/search', 'LedgerController@head_transaction_search');
Route::get('ledger/subhead/{id}', 'LedgerController@subhead_transaction');
Route::post('ledger/subhead/search', 'LedgerController@subhead_transaction_search');
Route::get('ledger/particular/{id}', 'LedgerController@particular_transaction');
Route::post('ledger/particular/search', 'LedgerController@particular_transaction_search');




// Institute Route
Route::resource('institute', 'InstituteController');
Route::post('institute/search', 'InstituteController@search');
Route::post('institute/delete', 'InstituteController@delete');
Route::get('institute/{id}/access', 'InstituteController@institute_access_by_id');
Route::post('institute/acess/update', 'InstituteController@update_institute_access_by_id');
Route::post('institute/type', 'InstituteController@get_institute_by_type');
Route::post('institute/head', 'InstituteController@get_head');
Route::post('institute/subhead', 'InstituteController@get_subhead');
Route::post('institute/customers', 'InstituteController@get_customer_list');
Route::post('institute/mills', 'InstituteController@get_mill_list');
Route::post('institute/categories', 'InstituteController@get_category_list');
Route::post('institute/chambers', 'InstituteController@get_chamber_list');
Route::post('institute/rawbricks-mills', 'InstituteController@get_rawbricks_mills');
Route::post('institute/loading-chambers', 'InstituteController@get_loading_chambers');
Route::post('institute/loading-raw-brick-field', 'InstituteController@get_loading_raw_brick_field');
Route::post('institute/uloading-chamber', 'InstituteController@get_unloading_chamber');
Route::post('institute/loading-items', 'InstituteController@get_loading_items');
Route::post('institute/sales-categories', 'InstituteController@get_sales_category');
Route::post('institute/ledger', 'InstituteController@get_ledger');
Route::post('institute/chamber', 'InstituteController@get_chamber');
Route::post('institute/raw_brick_field', 'InstituteController@get_raw_brick_field');


// User Route
Route::resource('user', 'UserController');
Route::get('password', 'UserController@change_user_password');
Route::post('password/update', 'UserController@update_user_password');
Route::get('user/{id}/access', 'UserController@user_access_by_id');
Route::post('user/acess/update', 'UserController@update_user_access_by_id');


/* Route for Receiving Ajax Request */
//Users Ajax Request
Route::post('/delete-users', 'AjaxController@delete_users_by_id');
Route::get('user-active/{id}', 'AjaxController@make_user_active_by_id');
Route::get('user-inactive/{id}', 'AjaxController@make_user_inactive_by_id');
//Institute Ajax Request
Route::get('institute-active/{id}', 'AjaxController@make_institute_active_by_id');
Route::get('institute-inactive/{id}', 'AjaxController@make_institute_inactive_by_id');
Route::post('/delete-institute', 'AjaxController@delete_institute_by_id');


// Resource Route for Ledger Controller
Route::get('trialbalance', 'LedgerController@trial_balance');
Route::get('ledger/dailysheet', 'LedgerController@daily_sheet');
Route::post('ledger/dailysheet/search', 'LedgerController@daily_sheet_search');
Route::get('business-ledger/{id}', 'BusinessLedgerController@view');
Route::resource('ledger', 'LedgerController');
Route::get('ledger-view', 'LedgerController@view_ledger');
Route::post('ledger/search', 'LedgerController@ledger_search');
Route::get('ledger/head/{id}', 'LedgerController@head_transaction');
Route::post('ledger/head/search', 'LedgerController@head_transaction_search');
Route::get('ledger/subhead/{id}', 'LedgerController@subhead_transaction');
Route::post('ledger/subhead/search', 'LedgerController@subhead_transaction_search');
Route::get('ledger/particular/{id}', 'LedgerController@particular_transaction');
Route::post('ledger/particular/search', 'LedgerController@particular_transaction_search');

// Daily Report Controller
Route::get('dailyreport', 'DailyReportController@index');
Route::post('dailyreport/search', 'DailyReportController@search');

// Financial Controller
Route::get('financial-statement', 'FinancialController@index');
Route::post('financial-statement/search', 'FinancialController@search');
////deep Controller
Route::resource('deep', 'DeepController');
Route::post('deep/delete', 'DeepController@delete');
Route::post('deep/search', 'DeepController@search');
Route::post('product/product', 'DeepController@get_product');
Route::post('company/company', 'DeepController@get_company');
Route::post('deep/deep', 'DeepController@get_deep');
////category Controller
Route::resource('category', 'CategoryController');
Route::post('category/delete', 'CategoryController@delete');
Route::post('category/search', 'CategoryController@search');
////product Controller
Route::resource('product', 'ProductController');
Route::post('product/delete', 'ProductController@delete');
Route::post('product/search', 'ProductController@search');
Route::post('category/category', 'ProductController@get_category');
Route::post('product/product', 'ProductController@get_product');

////company Controller
Route::resource('company', 'CompanyController');
Route::post('company/delete', 'CompanyController@delete');
Route::post('company/search', 'CompanyController@search');
Route::post('company/company', 'CompanyController@get_company');
////deepcaliber Controller
Route::resource('deepcaliber', 'DeepcaliberController');
Route::post('deepcaliber/delete', 'DeepcaliberController@delete');
Route::post('deepcaliber/search', 'DeepcaliberController@search');
////Tanklory Controller
Route::resource('tanklory', 'TankloryController');
Route::post('tanklory/delete', 'TankloryController@delete');
Route::post('tanklory/search', 'TankloryController@search');
Route::post('tanklory/tanklory', 'TankloryController@get_tanklory');
////Chamber Controller
Route::resource('chamber', 'ChamberController');
Route::post('chamber/delete', 'ChamberController@delete');
Route::post('chamber/search', 'ChamberController@search');
Route::post('chamber/chamber', 'ChamberController@get_chamber');
////Chamber Controller
Route::resource('chambercaliber', 'ChambercaliberController');
Route::post('chambercaliber/delete', 'ChambercaliberController@delete');
Route::post('chambercaliber/search', 'ChambercaliberController@search');
////station Controller
Route::resource('station', 'StationController');
Route::post('station/delete', 'StationController@delete');
Route::post('station/search', 'StationController@search');
Route::post('station/station', 'StationController@get_station');
////Nogel Controller
Route::resource('nogel', 'NogelController');
Route::post('nogel/delete', 'NogelController@delete');
Route::post('nogel/search', 'NogelController@search');
////Bank Controller
Route::resource('bank', 'BankController');
Route::post('bank/delete', 'BankController@delete');
Route::post('bank/search', 'BankController@search');
Route::post('bank/bank', 'BankController@get_bank');
////bankbranch Controller
Route::resource('bankbranch', 'BankbranchController');
Route::post('bankbranch/delete', 'BankbranchController@delete');
Route::post('bankbranch/search', 'BankbranchController@search');
Route::post('branch/branch', 'BankbranchController@get_branch');
////bankbranch Controller
Route::resource('account', 'AccountsController');
Route::post('account/delete', 'AccountsController@delete');
Route::post('account/search', 'AccountsController@search');
////employee Controller
Route::resource('employee', 'EmployeeController');
Route::post('employee/delete', 'EmployeeController@delete');
Route::post('employee/search', 'EmployeeController@search');
////supplier Controller
Route::resource('supplier', 'SupplierController');
Route::post('supplier/delete', 'SupplierController@delete');
Route::post('supplier/search', 'SupplierController@search');
Route::post('supplier/supplier', 'SupplierController@get_supplier');
////purcahseorder and challan Controller
Route::resource('purchaseorder', 'PurchaseorderController');
Route::post('purchaseorder/delete', 'PurchaseorderController@delete');
Route::get('/purchasereset', 'PurchaseorderController@reset');
Route::get('/purchaseprossess', 'PurchaseorderController@prossess');
Route::post('purchaseitem/delete', 'PurchaseorderController@delete');
Route::get('/purchaseorderitem', 'PurchaseorderController@orderitem');
Route::post('purchaseorder/search', 'PurchaseorderController@search');
Route::post('purchaseitem/search', 'PurchaseorderController@itemsearch');
Route::post('institute/productorder', 'PurchaseorderController@get_productorder');
////purcahse challan Controller
Route::resource('purchasechallan', 'PurchasechallanController');
Route::post('orderno/orderno', 'PurchasechallanController@get_orderno');
Route::post('purchasechallan/delete', 'PurchasechallanController@delete');
Route::post('purchasechallan/search', 'PurchasechallanController@search');
Route::post('payorder/payorder', 'PurchasechallanController@get_payoder');
Route::post('purchasechallan/update', 'PurchasechallanController@get_update');
Route::get('/challanreset', 'PurchasechallanController@reset');
Route::get('/challanprossess', 'PurchasechallanController@prossess');
////Tanklory Product Controller
Route::resource('tankloryproduct', 'TankloryproductController');
Route::post('challanno/challanno', 'TankloryproductController@get_challanno');
Route::post('tankloryproduct/delete', 'TankloryproductController@delete');
Route::post('tankloryproduct/search', 'TankloryproductController@search');
Route::post('slipno/slipno', 'TankloryproductController@get_slipno');
Route::post('tankloryproduct/update', 'TankloryproductController@get_update');
Route::get('/tankloryproductreset', 'TankloryproductController@reset');
Route::get('/tankloryproductprossess', 'TankloryproductController@prossess');
////customer Controller
Route::resource('customer', 'CustomerController');
Route::post('customer/delete', 'CustomerController@delete');
Route::post('customer/search', 'CustomerController@search');

////customer_type Controller
Route::resource('customer_type', 'CustomerTypeController');
Route::post('customer-type/search', 'CustomerTypeController@search');
Route::post('customertype/delete', 'CustomerTypeController@delete');

});
