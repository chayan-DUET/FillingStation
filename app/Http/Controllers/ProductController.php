<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Auth;
use DB;
use App\Models\Category;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $model = new Product();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $categorys = Category::where('institute_id', institute_id())->get();
        return view('institute.product.index', compact('insList', 'dataset','categorys'));
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
        return view('institute.product.create', compact('Categorys', 'insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $category_id = $r->category_id;
        DB::beginTransaction();
        try{
            foreach($_POST['product_name'] as $key => $value){
                    $model = new  Product();
                    if(is_Admin()){
                        if(empty($r->institute_id)){
                            throw new Exeption("please select a Branch");
                        }
                    }
                    if(empty($_POST['product_name'][$key])){
                       throw new Exeption("Product Name is Required");
                    }
                    //$model->enum('unit_name',['Liter','piece']);
                    $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                    $model->category_id = $category_id;
                    $model->product_name = $value;
                    $model->unit_name = $r->unit_id;
                    $model->_key =uniqueKey() .$key;
                    
                    if(!$model->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/product')->with('seccess','new Record Created Successfully');
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
       $model = new Product();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'product_name';
        $unit_by = 'unit_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('category_name', 'like', '%' . $search . '%')->orwhere('unit_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type, $unit_by);
        $dataset = $query->paginate($item_count);
        return view('institute.product._list', compact('dataset'));
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
        $product_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Product::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $product_del['success']=true;
             $product_del['message']='Transaction has been deleted successfully';

        } catch (Exception $e) {
            $product_del['success']=true;
             $product_del['message']=$e->getMessage();
        }
        return $product_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function get_category(Request $r) {
        $dataset = Category::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Category</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->category_name}</option>";
            }
            return $str;
        }
    } 
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
}
