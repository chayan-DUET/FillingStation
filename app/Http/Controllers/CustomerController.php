<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $model = new Customer();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        return view('institute.customer.index', compact('insList', 'dataset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        return view('institute.customer.create', compact('insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $input = $r->all();
         $rule = array(
            'institute_id' => 'required',
            'type' => 'required',
            'customer_name' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
            'reference' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'type.required' => 'Type must be selected.',
            'customer_name.required' => 'Customer Name  Should not be empty.',
            'address.required' => 'Address Should not be empty.',
            'mobile_no.required' => 'Mobile no Should not be empty.',
            'reference.required' => 'Reference no Should not be empty.',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new Customer();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->customer_name = $r->customer_name;
        $model->type = $r->type;
        $model->address = $r->address;
        $model->mobile_no = $r->mobile_no;
        $model->phone_no = $r->phone_no;
        $model->reference = $r->reference;
        $model->description = $r->description;
        $model->created_by = Auth::id();
        $model->_key = uniqueKey();
       

        DB::beginTransaction();
        try{
                if(!$model->save()){
                    throw new Exception("Query Problem on Updating Record.");
                }
                DB::commit();
                return redirect('/customer')->with('success', 'Record Updated Successfully.');
        }catch(Exception $e){
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
  
    public function search(Request $r)
    {
       $model = new Customer();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'customer_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('customer_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.customer._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $insList = Institute::where('type', 'institute')->get();
       $data = Customer::where('_key', $id)->first();
        return view('institute.customer.edit', compact('data','insList'));
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
        $input = $r->all();
         $rule = array(
            'institute_id' => 'required',
            'type' => 'required',
            'customer_name' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
            'reference' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'type.required' => 'Type must be selected.',
            'customer_name.required' => 'Customer Name  Should not be empty.',
            'address.required' => 'Address Should not be empty.',
            'mobile_no.required' => 'Mobile no Should not be empty.',
            'reference.required' => 'Reference no Should not be empty.',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = Customer::find($id);
        $data->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $data->type = $r->input('type');
        $data->customer_name = $r->input('customer_name');
        $data->address = $r->input('address');
        $data->mobile_no = $r->input('mobile_no');
        $data->phone_no = $r->input('phone_no');
        $data->reference = $r->input('reference');
        $data->description = $r->input('description');
        $data->created_by = Auth::id();
        $data->_key = uniqueKey();
        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/customer')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $cust_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Customer::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $cust_del['success']=true;
             $cust_del['message']='Supplier has been deleted successfully';

        } catch (Exception $e) {
            $cust_del['success']=true;
             $cust_del['message']=$e->getMessage();
        }
        return $cust_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

   
    
}
