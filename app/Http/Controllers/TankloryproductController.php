<?php

namespace App\Http\Controllers;

use App\Models\Tankloryproduct;
use App\Models\Tankloryitem;
use Exception;
use Auth;
use DB;
use App\Models\tanklory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Chamber;
use App\Models\Account;
use App\Models\Institute;
use App\Models\Employee;
use App\Models\Purchaschallan;
use App\User;
use Session;
use Validator;
use DateTime;
use Illuminate\Http\Request;

class TankloryproductController extends Controller
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
        $model = Tankloryproduct::orderBy('id', 'DESC');
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        // $employees = Employee::where('institute_id', institute_id())->get();
        // $tanklorys = Tanklory::where('institute_id', institute_id())->get();
        return view('institute.tankloryproduct.index', compact('insList','dataset'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $purchaschallan = Purchaschallan::where('institute_id', institute_id())->get();
        return view('institute.Tankloryproduct.create', compact('insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        DB::beginTransaction();
        try{
            $input = $r->all();
        $rule = array(
            'company_id' => 'required',
            'category_id' => 'required',
            'employee_id' => 'required',
            'order_no' => 'required',
            'pay_type' => 'required',
        );
        $messages = array(
            'company_id.required' => 'Company must be selected.',
            'category_id.required' => 'Category must be selected.',
            'employee_id.required' => 'Employees must be selected.',
            'order_no.required' => 'Order No  Should not be empty.',
            'pay_type.required' => 'Pay Tyoe must be selected.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new Purchaseorder();
        $model->institute_id =$r->institute_id;
        $model->company_id =$r->company_id;
        $model->supplier_id = $r->supplier_id;
        $model->employee_id = $r->employee_id;
        $model->order_no = $r->order_no;
        $model->pay_type = $r->pay_type;
        $model->total_quantity = $r->total_quantity;
        $model->grand_total = $r->grand_total;
        $model->request_date = date_ymd($r->request_date);
        $model->_key = uniqueKey();
            if (!$model->save()) {
                throw new Exception("Error while Creating Records.");
            }


            foreach($_POST['payorder_no'] as $key => $value){
                    $itemmodel = new  Purchaseitem();
                   
                    if(empty($_POST['payorder_no'][$key])){
                       throw new Exeption("Product Name is Required");
                    }
                    //$model->enum('unit_name',['Liter','piece']);
                    $itemmodel->institute_id = $r->institute_id;
                    $itemmodel->purchase_order_id = $model->id;
                    $itemmodel->company_id =$r->company_id;
                    $itemmodel->supplier_id = $r->supplier_id;
                    $itemmodel->category_id = $r->input('category_id')[$key];
                    $itemmodel->product_id =$r->input('product_id')[$key];
                    $itemmodel->payorder_no = $value;
                    $itemmodel->bank_description = $r->input('bank_description')[$key];
                    $itemmodel->request_date = date_ymd($r->request_date);
                    $itemmodel->order_quantity = $r->input('order_quantity')[$key];
                    $itemmodel->order_amount = $r->input('order_amount')[$key];
                    $itemmodel->pay_amount = $r->input('order_amount')[$key];
                    $itemmodel->_key =uniqueKey();
                    
                    if(!$itemmodel->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/purchaseorder')->with('seccess','new Record Created Successfully');
        } catch(Exception $e){
                DB::rollback();
                return redirect()->back()->with('danger',$e->getMessage());
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
        $data = Purchaseorder::where('_key', $id)->first();
        $itemdata = Purchaseitem::where('purchase_order_id', $data->id)->get();
        return view('institute.purchaseorder._view', compact('data','itemdata'));
    }
    public function search(Request $r)
    {
       $model =Tankloryproduct::with('purchasechallan');
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'order_no';
        $challan_by = 'challan_no';
        $from_date = date_ymd($r->from_date);
        $end_date = !empty($r->end_date) ? date_ymd($r->end_date) : date('Y-m-d');
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
       
        if (!empty($from_date)) {
            $query->whereBetween('delivery_date', [$from_date, $end_date]);
        }
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
         $query->whereHas('purchasechallan',function($q) use ($search){
            $q->where('order_no', 'LIKE', '%' . $search . '%')->
              orWhere('challan_no', 'LIKE', '%' . $search. '%');
        });
         
        } 
        $query->orderBy($sort_by, $sort_type, $challan_by);
        $dataset = $query->paginate($item_count);
        return view('institute.tankloryproduct._list', compact('dataset'));
    }
    public function itemsearch(Request $r)
    {
       $model =Purchaseitem::with('product','purchaseorder');
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'payorder_no';
        $product_by = 'product_name';
        $order_by = 'order_no';
        $from_date = date_ymd($r->from_date);
        $end_date = !empty($r->end_date) ? date_ymd($r->end_date) : date('Y-m-d');
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
       
        if (!empty($from_date)) {
            $query->whereBetween('request_date', [$from_date, $end_date]);
        }
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
         $query->whereHas('product',function($q) use ($search){
            $q->where('payorder_no', 'LIKE', '%' . $search . '%')->
              orWhere('product_name', 'LIKE', '%' . $search. '%');
        });
         $query->orWhereHas('purchaseorder', function($q) use ($search) {
         $q->where('order_no', 'LIKE', '%'. $search . '%');
            });
        } 

        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.purchaseorder._itemlist', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Purchaseorder::where('_key', $id)->first();
        $itemdata = Purchaseitem::where('purchase_order_id', $data->id)->get();
        $insList = Institute::where('type', 'institute')->first();
        $categorys = Category::where('institute_id', $insList->id)->get();
        $companys = Company::where('institute_id', $insList->id)->get();
        $suppliers = Supplier::where('institute_id', $insList->id)->get();
        $products = Product::where('institute_id', $insList->id)->get();
        $employees = Employee::where('institute_id', $insList->id)->get();
       
        return view('institute.purchaseorder.edit', compact('insList','data','categorys','companys','suppliers','products','employees','itemdata'));
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
            'company_id' => 'required',
            'category_id' => 'required',
            'employee_id' => 'required',
            'order_no' => 'required',
            'pay_type' => 'required',
        );
        $messages = array(
            'company_id.required' => 'Company must be selected.',
            'category_id.required' => 'Category must be selected.',
            'employee_id.required' => 'Employees must be selected.',
            'order_no.required' => 'Order No  Should not be empty.',
            'pay_type.required' => 'Pay Tyoe must be selected.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = Purchaseorder::findOrFail($id);
        $model->institute_id =$r->institute_id;
        $model->company_id =$r->company_id;
        $model->supplier_id = $r->supplier_id;
        $model->employee_id = $r->employee_id;
        $model->order_no = $r->order_no;
        $model->pay_type = $r->pay_type;
        $model->total_quantity = $r->total_quantity;
        $model->grand_total = $r->grand_total;
        $model->request_date = $r->request_date;
        $model->updated_by = Auth::user()->id;
        $model->_key = uniqueKey();
            if (!$model->save()) {
                throw new Exception("Error while Creating Records.");
            }
                $model->purchaseitem()->delete();
            foreach($_POST['payorder_no'] as $key => $value){
                $itemmodel=new Purchaseitem;
                    if(empty($_POST['payorder_no'][$key])){
                       throw new Exeption("Product Name is Required");
                    }
                    $itemmodel->institute_id = $r->institute_id;
                    $itemmodel->company_id =$r->company_id;
                    $itemmodel->supplier_id = $r->supplier_id;
                    $itemmodel->purchase_order_id = $model->id;
                    $itemmodel->category_id = $r->input('category_id')[$key];
                    $itemmodel->product_id =$r->input('product_id')[$key];
                    $itemmodel->payorder_no = $value;
                    $itemmodel->bank_description = $r->input('bank_description')[$key];
                    $itemmodel->request_date = $r->input('request_date');
                    $itemmodel->order_quantity = $r->input('order_quantity')[$key];
                    $itemmodel->order_amount = $r->input('order_amount')[$key];
                    $itemmodel->pay_amount = $r->input('order_amount')[$key];
                    $itemmodel->updated_by = Auth::user()->id;
                    $itemmodel->_key =uniqueKey();
                    
                    if(!$itemmodel->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            //dd($model->purchaseitem()->save($itemmodel));
            DB::commit();
            return redirect('/purchaseorder')->with('seccess','Record Update Successfully');
        } catch(Exception $e){
                DB::rollback();
                return redirect()->back()->with('danger',$e->getMessage());
        }
    }
       

        public function delete()
    {
        $purchaseorder_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Purchaseorder::find($id);
                    $data->purchaseitem()->delete();
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $purchaseorder_del['success']=true;
             $purchaseorder_del['message']='Purchase Order has been deleted successfully';

        } catch (Exception $e) {
            $purchaseorder_del['success']=true;
             $purchaseorder_del['message']=$e->getMessage();
        }
        return $purchaseorder_del;
    }
    public function reset(Request $r)
    {   $purchaseorder_reset=array();
        DB::beginTransaction();
        try{
           
        $value = Tankloryproduct::orderBy('id', 'DESC');;
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
           
        $value = Tankloryproduct::orderBy('id', 'DESC');;
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    


     public function get_slipno(Request $r) {
        $institute_id = $r->institute;
        $products = Product::where('institute_id', $institute_id)->get();
        $employees = Employee::where('institute_id', $institute_id)->get();
        $categorys = Category::where('institute_id', $institute_id)->get();
        $Purchaseitem = Purchaschallan::where('id', $r->challan)->first();
        return view('institute.tankloryproduct._create', compact('employees', 'institute_id','products','categorys','Purchaseitem'));
    }
    
    public function get_challanno(Request $r)
    {
        $date=date_ymd($r->date);
       $dataset = Purchaschallan::where('institute_id', $r->institute)->where('pay_date',$date)->get();
        $str = ["<option value=''>Select Challan No</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->challan_no}</option>";
            }
            return $str;
        }
    }
    public function orderitem()
    {
       $insList = Institute::where('type', 'institute')->get();
        //$setting = $this->getSettings();
        $model = Purchaseitem::orderBy('id', 'DESC');
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $categorys = Category::where('institute_id', institute_id())->get();
        $products = Product::where('institute_id', institute_id())->get();
        $purchaseorder = Purchaseorder::where('institute_id', institute_id())->get();
        return view('institute.purchaseorder.orderitem',compact('insList','dataset','categorys','products','purchaseorder'));
    }
}
