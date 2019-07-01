<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Exception;
use Auth;
use DB;
use App\Models\Bank;
use App\Models\BankBranch;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resp
     onse
     */
    public function index()
    {
       $insList = Institute::where('type', 'institute')->get();
        //$setting = $this->getSettings();
        $model = new Account();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $Banks = Bank::where('institute_id', institute_id())->get();
        $Branchs = BankBranch::where('institute_id', institute_id())->get();
        return view('institute.account.index', compact('insList', 'dataset','Banks','Branchs'));
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
        $Branchs = BankBranch::where('institute_id', institute_id())->get();
        return view('institute.account.create', compact('Banks', 'insList','Branchs'));
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
            'bank_id' => 'required',
            'branch_id' => 'required',
            'account_name' => 'required',
            'account_no' => 'required',
            'account_type' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'bank_id.required' => 'Bank must be selected.',
            'branch_id.required' => 'Branch must be selected.',
            'account_name.required' => 'Account Name  Should not be empty.',
            'account_no.required' => 'Account No  Should not be empty.',
            'account_type.required' => 'Account Type must be selected.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new Account();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->bank_id =$r->bank_id;
        $model->branch_id = $r->branch_id;
        $model->account_name = $r->account_name;
        $model->account_no = $r->account_no;
        $model->account_type = $r->account_type;
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
            return redirect('/account')->with('success', 'New Record Created Successfully.');
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
    
    public function search(Request $r)
    {
       $model = new Product();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'account_name';
        $unit_by = 'account_no';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('account_name', 'like', '%' . $search . '%')->orwhere('account_no', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type, $unit_by);
        $dataset = $query->paginate($item_count);
        return view('institute.account._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Account::where('_key', $id)->first();
       $bank_set = Bank::all();
       $branch_set = BankBranch::all();
        return view('institute.account.edit', compact('data','bank_set','branch_set'));
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
            'bank_id' => 'required',
            'branch_id' => 'required',
            'account_name' => 'required',
            'account_no' => 'required',
            'account_type' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'bank_id.required' => 'Bank must be selected.',
            'branch_id.required' => 'Branch must be selected.',
            'account_name.required' => 'Account Name  Should not be empty.',
            'account_no.required' => 'Account No  Should not be empty.',
            'account_type.required' => 'Account Type must be selected.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = Account::find($id);
        $data->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $data->bank_id = $r->input('bank_id');
        $data->branch_id = $r->input('branch_id');
        $data->account_name = $r->input('account_name');
        $data->account_no = $r->input('account_no');
        $data->account_type = $r->input('account_type');
        $data->_key = uniqueKey();

        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/account')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $account_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Account::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $account_del['success']=true;
             $account_del['message']='Account has been deleted successfully';

        } catch (Exception $e) {
            $account_del['success']=true;
             $account_del['message']=$e->getMessage();
        }
        return $account_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    
}
