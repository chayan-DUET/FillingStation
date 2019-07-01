<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class BankController extends Controller
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
        $model = new Bank();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        return view('institute.bank.index', compact('insList', 'dataset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        return view('institute.bank.create', compact('insList'));
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
            foreach($_POST['bank_name'] as $key => $value){
                    $model = new  Bank();
                    if(is_Admin()){
                        if(empty($r->institute_id)){
                            throw new Exeption("please select a Branch");
                        }
                    }
                    if(empty($_POST['bank_name'][$key])){
                       throw new Exeption("Bank Name is Required");
                    }
                    $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                    $model->bank_name = $value;
                    $model->_key =uniqueKey();
                    
                    if(!$model->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/bank')->with('seccess','new Record Created Successfully');
        } catch(Exception $e){
                DB::rollback();
                return redirect()->back()->with('danger',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
   

    public function search(Request $r)
    {
       $model = new Bank();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'bank_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('bank_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.bank._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Bank::where('_key', $id)->first();
        return view('institute.bank.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $input = $r->all();
        $rule = array(
                'bank_name' => 'required',
        );
        $messages = array(
                'bank_name.required' => 'Bank name Should not be empty',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $data = Bank::find($id);
        $data->bank_name = $r->input('bank_name');
        DB::beginTransaction();
        try{
                if(!$data->save()){
                    throw new Exception("Query Problem on Updating Record.");
                }
                DB::commit();
                return redirect('/bank')->with('success', 'Record Updated Successfully.');
        }catch(Exception $e){
                DB::rollback();
                return redirect()->back()->with('danger',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        $bank_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Bank::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $bank_del['success']=true;
             $bank_del['message']='Transaction has been deleted successfully';

        } catch (Exception $e) {
            $bank_del['success']=true;
             $bank_del['message']=$e->getMessage();
        }
        return $bank_del;
    }
     public function get_bank(Request $r) {
        $dataset = Bank::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Bank</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->bank_name}</option>";
            }
            return $str;
        }
    }
}
