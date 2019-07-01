<?php

namespace App\Http\Controllers;

use App\Models\Deepcaliber;
use Exception;
use Auth;
use DB;
use App\Models\Deep;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class DeepcaliberController extends Controller
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
        $model = new Deepcaliber();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $deeps = Deep::where('institute_id', institute_id())->get();
        return view('institute.deepcaliber.index', compact('insList', 'dataset','deeps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $deeps = deep::where('institute_id', institute_id())->get();
        return view('institute.deepcaliber.create', compact('Categorys', 'insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $deep_id = $r->deep_id;
        DB::beginTransaction();
        try{
            foreach($_POST['mm'] as $key => $value){
                    $model = new  Deepcaliber();
                    if(is_Admin()){
                        if(empty($r->institute_id)){
                            throw new Exeption("please select a Branch");
                        }
                    }
                    if(empty($_POST['mm'][$key])){
                       throw new Exeption("MM Name is Required");
                    }
                    //$model->enum('unit_name',['Liter','piece']);
                   
                    $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                    $model->deep_id = $deep_id;
                    $model->mm = $value;
                    $model->liter = $r->input('liter')[$key];
                    $model->_key =uniqueKey();
                    
                    if(!$model->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/deepcaliber')->with('seccess','new Record Created Successfully');
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
       $model = new Deepcaliber();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $mm_by = 'mm';
        $liter_by = 'liter';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('mm', 'like', '%' . $search . '%')->orwhere('liter', 'like', '%' . $search . '%');
        }
        $query->orderBy($mm_by, $sort_type, $liter_by);
        $dataset = $query->paginate($item_count);
        return view('institute.deepcaliber._list', compact('dataset'));
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
            return redirect('/deepcaliber')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $deepcaliber_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Deepcaliber::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $deepcaliber_del['success']=true;
             $deepcaliber_del['message']='Deepcaliber Data has been deleted successfully';

        } catch (Exception $e) {
            $deepcaliber_del['success']=true;
             $deepcaliber_del['message']=$e->getMessage();
        }
        return $deepcaliber_del;
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
}
