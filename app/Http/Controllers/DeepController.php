<?php

namespace App\Http\Controllers;

use App\Models\Deep;
use Exception;
use Auth;
use DB;
use App\Models\Category;
use App\Models\Institute;
use App\Models\Product;
use App\Models\Company;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class DeepController extends Controller
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
        $model = new Deep();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $categorys = Category::where('institute_id', institute_id())->get();
        $products = Product::where('institute_id', institute_id())->get();
        $companys = Company::where('institute_id', institute_id())->get();
        
        
        
        
         $category22= DB::table('category')
                ->join('institutes', 'category.Id', '=', 'category.institute_id')
                  ->select('institutes.*', 'category.category_name')
                ->get();
        
        
        return view('institute.deep.index', compact('insList', 'dataset','categorys','products','companys',"category22"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $Categorys = Category::where('institute_id', institute_id())->get();
        $products = Product::where('institute_id', institute_id())->get();
        $companys = Company::where('institute_id', institute_id())->get();
        return view('institute.deep.create', compact('Categorys', 'insList','products','companys'));
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
            'category_id' => 'required',
            'product_id' => 'required',
            'deep_name' => 'required',
            'deep_type' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'company_id.required' => 'Company must be selected.',
            'category_id.required' => 'Category must be selected.',
            'product_id.required' => 'Product must be selected.',
            'deep_name.required' => 'Deep Name  Should not be empty.',
            'deep_type.required' => 'Deep Type must be selected.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new Deep();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->company_id =$r->company_id;
        $model->category_id = $r->category_id;
        $model->product_id = $r->product_id;
        $model->deep_name = $r->deep_name;
        $model->deep_type = $r->deep_type;
        $model->deep_capacity = $r->deep_capacity;
        $model->deep_issue_authority = $r->deep_issue_authority;
        $model->calibration_by = $r->calibration_by;
        $model->calibration_date = $r->calibration_date;
        $model->validity = $r->validity;
        $model->remarks = $r->remarks;
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
            return redirect('/deep')->with('success', 'New Record Created Successfully.');
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
       $model = new Deep();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'deep_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('deep_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.deep._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Deep::where('_key', $id)->first();
       $insList = Institute::where('type', 'institute')->get();
       $company_set = Company::all();
       $category_set = Category::all();
       $product_set = Product::all();
        return view('institute.deep.edit', compact('data','company_set','category_set','insList','product_set'));
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
        $deep_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Deep::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $deep_del['success']=true;
             $deep_del['message']='Deep has been deleted successfully';

        } catch (Exception $e) {
            $deep_del['success']=true;
             $deep_del['message']=$e->getMessage();
        }
        return $deep_del;
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
}
