<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Auth;
use DB;
use App\Models\Company;
use App\Models\Category;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $model = new Supplier();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $companys = Company::where('institute_id', institute_id())->get();
        return view('institute.supplier.index', compact('insList', 'dataset','companys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $Companys = Company::where('institute_id', institute_id())->get();
        return view('institute.supplier.create', compact('Companys', 'insList'));
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
            'company_id' => 'required',
            'supplier_name' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'company_id.required' => 'Company must be selected.',
            'supplier_name.required' => 'Supplier Name  Should not be empty.',
            'address.required' => 'Address Should not be empty.',
            'mobile_no.required' => 'Mobile no Should not be empty.',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
       
        $model = new Supplier();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->company_id = $r->company_id;
        $model->supplier_name = $r->supplier_name;
        $model->address = $r->address;
        $model->mobile_no = $r->mobile_no;
        $model->phone_no = $r->phone_no;
        $model->description = $r->description;
        $model->created_by = Auth::id();
        $model->_key = uniqueKey();

        DB::beginTransaction();
        try{
                if(!$model->save()){
                    throw new Exception("Query Problem on Updating Record.");
                }
                DB::commit();
                
                return redirect('/supplier')->with('success', 'Record Updated Successfully.');
            
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
       $model = new Supplier();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'supplier_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('supplier_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.supplier._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $category= Category::all();
           $insList = Institute::where('type', 'institute')->get();
       $data = Supplier::where('_key', $id)->first();
       $company_set = Company::all();
        return view('institute.supplier.edit', compact('data','company_set','category','insList'));
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
            'company_id' => 'required',
            'supplier_name' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'company_id.required' => 'Company must be selected.',
            'supplier_name.required' => 'Supplier Name  Should not be empty.',
            'address.required' => 'Address Should not be empty.',
            'mobile_no.required' => 'Mobile no Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = Supplier::find($id);
        $data->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $data->company_id = $r->input('company_id');
        $data->supplier_name = $r->input('supplier_name');
        $data->address = $r->input('address');
        $data->mobile_no = $r->input('mobile_no');
        $data->phone_no = $r->input('phone_no');
        $data->description = $r->input('description');
        $data->created_by = Auth::id();
        $data->_key = uniqueKey();
        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/supplier')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $supplier_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Supplier::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $supplier_del['success']=true;
             $supplier_del['message']='Supplier has been deleted successfully';

        } catch (Exception $e) {
            $supplier_del['success']=true;
             $supplier_del['message']=$e->getMessage();
        }
        return $supplier_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function get_supplier(Request $r) {
        $dataset = Supplier::where('company_id', $r->supplier)->get();
        $str = ["<option value=''>Select Supplier</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->supplier_name}</option>";
            }
            return $str;
        }
    }
    
}
