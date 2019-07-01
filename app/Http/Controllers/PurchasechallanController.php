<?php

namespace App\Http\Controllers;


use App\Models\Purchaschallan;
use App\Models\Purchaseitem;
use App\Models\Purchaseorder;
use Exception;
use Auth;
use DB;
use App\Models\Company;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Institute;
use App\Models\Employee;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class PurchasechallanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $insList = Institute::where('type', 'institute')->get();
        //$setting = $this->getSettings();
        $model = Purchaschallan::orderBy('id', 'DESC');
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $suppliers = Supplier::where('institute_id', institute_id())->get();
        $companys = Company::where('institute_id', institute_id())->get();
        $categorys = Category::where('institute_id', institute_id())->get();
        $products = Product::where('institute_id', institute_id())->get();
        return view('institute.purchasechallan.index', compact('insList','dataset','categorys','products','companys','suppliers'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        return view('institute.purchasechallan.create', compact('insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
   {
        
        $model = new Purchaschallan();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->company_id =$r->company_id;
        $model->purchase_order_id = $r->purchase_order_id;
        $model->company_id = $r->company_id;
        $model->supplier_id = $r->supplier_id;
        $model->category_id = $r->category_id;
        $model->product_id = $r->product_id;
        $model->employee_id = $r->employee_id;
        $model->per_liter_amount = $r->per_liter_amount;
        $model->quantity = $r->quantity;
        $model->amount = $r->amount;
        $model->pay_date = date_ymd($r->pay_date);
        $model->pay_order_no = $r->pay_order_no;
        $model->challan_no = $r->challan_no;
        $model->by_whom = $r->by_whom;
        $model->vehicle_type = $r->vehicle_type;
        $model->vehicle_no = $r->vehicle_no;
        $model->driver_name = $r->driver_name;
        $model->driver_name = Auth::user()->id;
        $model->_key = uniqueKey();
        DB::beginTransaction();
        try {
            if (is_Admin()) {
                if (empty($r->institute_id)) {
                    throw new Exception("Please select a Branch");
                }
            }
            if (!$model->save()) {
                throw new Exception("Error while Creating Records.");
            }

            DB::commit();
            return redirect('/purchasechallan')->with('success', 'New Record Created Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Purchaschallan::where('_key', $id)->first();
        $orderdata = Purchaseorder::where('id', $data->id)->get();
        $itemdata = Purchaseitem::where('purchase_order_id', $data->purchase_order_id)->first();
       return view('institute.purchasechallan._view_challan',compact('data','orderdata','itemdata'));
    }
    public function search(Request $r)
    {
       $model =Purchaschallan::with('product');
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'pay_order_no';
        $product_by = 'product_name';
        $challan_by = 'challan_no';
        $from_date = date_ymd($r->from_date);
        $end_date = !empty($r->end_date) ? date_ymd($r->end_date) : date('Y-m-d');
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
       
        if (!empty($from_date)) {
            $query->whereBetween('pay_date', [$from_date, $end_date]);
        }
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
         $query->whereHas('product',function($q) use ($search){
            $q->where('pay_order_no', 'LIKE', '%' . $search . '%')->
              orWhere('product_name', 'LIKE', '%' . $search. '%')->orWhere('challan_no', 'LIKE', '%' . $search. '%');
        });
         
        } 
        $query->orderBy($sort_by, $sort_type, $challan_by,$product_by);
        $dataset = $query->paginate($item_count);
        return view('institute.purchasechallan._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Purchaschallan::where('_key', $id)->first();
        $orderitem=Purchaseitem::where('purchase_order_id', $data->purchase_order_id)->first();
        $insList = Institute::where('type', 'institute')->first();
        $categorys = Category::where('institute_id', $insList->id)->get();
        $products = Product::where('institute_id', $insList->id)->get();
        $employees = Employee::where('institute_id', $insList->id)->get();
        return view('institute.purchasechallan.edit', compact('insList','data','categorys','products','employees','orderitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        DB::beginTransaction();
        try{
            $input = $r->all();
        $rule = array(
            'category_id' => 'required',
            'employee_id' => 'required',
            'product_id' => 'required',
        );
        $messages = array(
            'category_id.required' => 'Category must be selected.',
            'product_id.required' => 'Product must be selected.',
            'employee_id.required' => 'Employees must be selected.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = Purchaschallan::findOrFail($id);
        $model->category_id = $r->category_id;
        $model->product_id = $r->product_id;
        $model->employee_id = $r->employee_id;
        $model->per_liter_amount = $r->per_liter_amount;
        $model->quantity = $r->quantity;
        $model->amount = $r->amount;
        $model->pay_date = date_ymd($r->pay_date);
        $model->challan_no = $r->challan_no;
        $model->by_whom = $r->by_whom;
        $model->vehicle_type = $r->vehicle_type;
        $model->vehicle_no = $r->vehicle_no;
        $model->driver_name = $r->driver_name;
        $model->driver_name = Auth::user()->id;
        $model->_key = uniqueKey();
            if (!$model->save()) {
                throw new Exception("Error while Creating Records.");
            }
                
            //dd($model->purchaseitem()->save($itemmodel));
            DB::commit();
            return redirect('/purchasechallan')->with('seccess','Record Update Successfully');
        } catch(Exception $e){
                DB::rollback();
                return redirect()->back()->with('danger',$e->getMessage());
        }
    }

        public function delete()
    {
        $challan_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Purchaschallan::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $challan_del['success']=true;
             $challan_del['message']='Purchase Challan has been deleted successfully';

        } catch (Exception $e) {
            $challan_del['success']=true;
             $challan_del['message']=$e->getMessage();
        }
        return $challan_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $r)
    {   $purchaseorder_reset=array();
        DB::beginTransaction();
        try{
        $value = Purchaschallan::orderBy('id', 'DESC');;
        $values = $value->where('_key', $r->id)->first();
          $values->is_edible=0;
          $values->save();

            DB::commit();
             $purchaseorder_reset['success']=true;
             $purchaseorder_reset['message']='Purchase Order has been reset successfully';

        } catch (Exception $e) {
            $purchaseorder_reset['success']=true;
             $purchaseorder_reset['message']=$e->getMessage();
        }
        return $purchaseorder_reset;
    }
    public function prossess(Request $r)
    {   $purchaseorder_reset=array();
        DB::beginTransaction();
        try{
           
        $value = Purchaschallan::orderBy('id', 'DESC');;
        $values = $value->where('_key', $r->id)->first();
          $values->is_edible=1;
          $values->save();

            DB::commit();
             $purchaseorder_reset['success']=true;
             $purchaseorder_reset['message']='Purchase Order has been prossess successfully';

        } catch (Exception $e) {
            $purchaseorder_reset['success']=true;
             $purchaseorder_reset['message']=$e->getMessage();
        }
        return $purchaseorder_reset;
    }


     public function get_payoder(Request $r) {
        $institute_id = $r->institute;
        $products = Product::where('institute_id', $institute_id)->get();
        $employees = Employee::where('institute_id', $institute_id)->get();
        $categorys = Category::where('institute_id', $institute_id)->get();
        $Purchaseitem = Purchaseitem::where('id', $r->payorder)->first();
        return view('institute.purchasechallan._create', compact('employees', 'institute_id','products','categorys','Purchaseitem'));
    }
    public function get_orderno(Request $r)
    {
        $date=date_ymd($r->date);
       $dataset = Purchaseitem::where('institute_id', $r->institute)->where('request_date',$date)->get();
        $str = ["<option value=''>Select Pay Order No</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->payorder_no}</option>";
            }
            return $str;
        }
    }
}
