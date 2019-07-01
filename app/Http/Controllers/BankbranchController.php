<?php

namespace App\Http\Controllers;

use App\Models\Bankbranch;
use Exception;
use Auth;
use DB;
use App\Models\Bank;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class BankbranchController extends Controller
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
        $model = new Bankbranch();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $Banks = Bank::where('institute_id', institute_id())->get();
        return view('institute.bankbranch.index', compact('insList', 'dataset','Banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $Banks = Bank::where('institute_id', institute_id())->get();
        return view('institute.bankbranch.create', compact('Banks', 'insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $bank_id = $r->bank_id;
        DB::beginTransaction();
        try{
            foreach($_POST['branch_name'] as $key => $value){
                    $model = new  Bankbranch();
                    if(is_Admin()){
                        if(empty($r->institute_id)){
                            throw new Exeption("please select a Branch");
                        }
                    }
                    if(empty($_POST['branch_name'][$key])){
                       throw new Exeption("Product Name is Required");
                    }
                    //$model->enum('unit_name',['Liter','piece']);
                    $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                    $model->bank_id = $bank_id;
                    $model->branch_name = $value;
                    $model->_key =uniqueKey();
                    
                    if(!$model->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/bankbranch')->with('seccess','new Record Created Successfully');
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
    public function show(Request $r)
    {
        //
    }
    public function search(Request $r)
    {
       $model = new Bankbranch();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'branch_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('branch_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.bankbranch._list', compact('dataset'));
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
       $data = Bankbranch::where('_key', $id)->first();
       $bank_set = Bank::all();
        return view('institute.bankbranch.edit', compact('data','bank_set','insList'));
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
            'bank_id' => 'required',
            'branch_name' => 'required',
        );
        $messages = array(
            'bank_id.required' => 'Bank name must be selected.',
            'branch_name.required' => 'Branch name Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = Bankbranch::find($id);
        $data->bank_id = $r->input('bank_id');
        $data->branch_name = $r->input('branch_name');

        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/bankbranch')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $branch_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Bankbranch::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $branch_del['success']=true;
             $branch_del['message']='Transaction has been deleted successfully';

        } catch (Exception $e) {
            $branch_del['success']=true;
             $branch_del['message']=$e->getMessage();
        }
        return $branch_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function get_branch(Request $r) {
        $dataset = Bankbranch::where('bank_id', $r->bank)->get();
        $str = ["<option value=''>Select Branch</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->branch_name}</option>";
            }
            return $str;
        }
    }
}
