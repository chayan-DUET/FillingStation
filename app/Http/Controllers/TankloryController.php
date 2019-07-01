<?php

namespace App\Http\Controllers;

use App\Models\Tanklory;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\Models\Company;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class TankloryController extends Controller
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
        $model = new Tanklory();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $companys = Company::where('institute_id', institute_id())->get();
        return view('institute.tanklory.index', compact('insList', 'dataset','companys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $companys = Company::where('institute_id', institute_id())->get();
        return view('institute.tanklory.create', compact('insList','companys'));
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
            'tank_lory_name' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'company_id.required' => 'Company must be selected.',
            'tank_lory_name.required' => 'Tanklory Name  Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new Tanklory();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->company_id =$r->company_id;
        $model->tank_lory_name = $r->tank_lory_name;
        $model->registration_date = $r->registration_date;
        $model->registration_no = $r->registration_no;
        $model->license_no = $r->license_no;
        $model->chasiss_no = $r->chasiss_no;
        $model->date_of_caliber = $r->date_of_caliber;
        $model->validity = $r->validity;
        $model->vehicle_no = $r->vehicle_no;
        $model->notes = $r->notes;
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
            return redirect('/tanklory')->with('success', 'New Record Created Successfully.');
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
    public function show(Request $r)
    {
        //
    }
    public function search(Request $r)
    {
       $model = new Tanklory();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'tank_lory_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('tank_lory_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.tanklory._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Product::where('_key', $id)->first();
       $category_set = Category::all();
        return view('institute.product.edit', compact('data','category_set'));
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
            'category_id' => 'required',
            'product_name' => 'required',
        );
        $messages = array(
            'category_id.required' => 'Category must be selected.',
            'product_name.required' => 'Product name Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = Product::find($id);
        $data->category_id = $r->input('category_id');
        $data->product_name = $r->input('product_name');
        $data->unit_name = $r->input('unit_name');

        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/product')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $tanklory_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Tanklory::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $tanklory_del['success']=true;
             $tanklory_del['message']='Tanklory has been deleted successfully';

        } catch (Exception $e) {
            $tanklory_del['success']=true;
             $tanklory_del['message']=$e->getMessage();
        }
        return $tanklory_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function get_product(Request $r) {
        $dataset = Product::where('category_id', $r->category)->get();
        $str = ["<option value=''>Select Product</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->product_name}</option>";
            }
            return $str;
        }
    }
    public function get_company(Request $r) {
        $dataset = Company::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Company</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->company_name}</option>";
            }
            return $str;
        }
    }
    public function get_deep(Request $r) {
        $dataset = Deep::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Deep</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->deep_name}</option>";
            }
            return $str;
        }
    }
    public function get_tanklory(Request $r) {
        $dataset = Tanklory::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Tanklory</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->tank_lory_name}</option>";
            }
            return $str;
        }
    }
}
