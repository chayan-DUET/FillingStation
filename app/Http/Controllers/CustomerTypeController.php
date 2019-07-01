<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
         $insList = Institute::where('type', 'institute')->get();
         //$setting = $this->getSettings();
        $model = new CustomerType();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        ///////////
         $categorytype= DB::table('customer_type')
                ->join('institutes', 'institutes.id', '=', 'customer_type.institute_id')
                  ->select('customer_type.*','institutes.name','institutes.mobile')
                ->get();
       // dd($categorytype);
        return view('institute.customer_type.index',compact('insList', 'dataset','categorytype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $insList = Institute::where('type', 'institute')->get();
        return view('institute.customer_type.create', compact('insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //dd($r->all());
        $input = $r->all();
         $rule = array(
            'institute_id' => 'required',
            'customer_type' => 'required',
//            'customer_name' => 'required',
//            'address' => 'required',
//            'mobile_no' => 'required',
//            'reference' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'customer_type.required' => 'Type must be selected.',
//            'customer_name.required' => 'Customer Name  Should not be empty.',
//            'address.required' => 'Address Should not be empty.',
//            'mobile_no.required' => 'Mobile no Should not be empty.',
//            'reference.required' => 'Reference no Should not be empty.',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new CustomerType();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        //$model->customer_name = $r->customer_name;
        $model->type_name = $r->customer_type;
        //$model->address = $r->address;
        //$model->mobile_no = $r->mobile_no;
        //$model->phone_no = $r->phone_no;
        //$model->reference = $r->reference;
        //$model->description = $r->description;
        $model->created_by = Auth::id();
        $model->_key = uniqueKey();
      
        DB::beginTransaction();
        try{
                if(!$model->save()){
                    throw new Exception("Query Problem on Updating Record.");
                }
                DB::commit();
                return redirect('/customer_type')->with('success', 'Record Updated Successfully.');
        }catch(Exception $e){
                DB::rollback();
                return redirect()->back()->with('danger',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
      public function search(Request $r)
    {
          //$searchkey=\Request::get('search');
          $searchkey = $r->search;
          $searchtype= DB::table('customer_type')
                   ->join('institutes', 'institutes.id', '=', 'customer_type.institute_id')
                  ->select('customer_type.*','institutes.name','institutes.mobile')
                  ->where('type_name','like', '%' .$searchkey. '%')
                  ->orwhere('name','like', '%' .$searchkey. '%')
                  ->get();
        // return $searchkey ;
          ///////
       $model = new CustomerType();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'type_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('type_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.customer_type._list', compact('dataset','searchtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $insList = Institute::where('type', 'institute')->get();
       $data = CustomerType::where('_key', $id)->first();
        return view('institute.customer_type.edit', compact('data','insList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function update(Request $r, $id)
    {
           //dd($r);
        $input = $r->all();
         $rule = array(
            'type_name' => 'required',
        );
        $messages = array(
            'type_name.required' => 'Type must be selected.',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = CustomerType::find($id);
        $data->type_name = $r->get('type_name');
        //dd($data);
        //$data->save();
        $data->created_by = Auth::id();
        $data->_key = uniqueKey();
        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
          return redirect('/customer_type')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
          return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
           $cust_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = CustomerType::find($id);
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
}
