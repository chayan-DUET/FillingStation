<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Exception;
use Auth;
use DB;
use App\Models\Deep;
use App\Models\Product;
use App\Models\Category;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class StationController extends Controller
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
        $model = new Station();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $categorys = Category::where('institute_id', institute_id())->get();
        $deeps = Deep::where('institute_id', institute_id())->get();
        $products = Product::where('institute_id', institute_id())->get();
        return view('institute.station.index', compact('insList', 'dataset','categorys','deeps','products'));
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
        $Deeps = Deep::where('institute_id', institute_id())->get();
        $products = Product::where('institute_id', institute_id())->get();
        return view('institute.station.create', compact('Categorys', 'insList','Deeps','products'));
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
        $deep_id = $r->deep_id;
        $product_id = $r->product_id;
        DB::beginTransaction();
        try{
            foreach($_POST['station_name'] as $key => $value){
                    $model = new  Station();
                    if(is_Admin()){
                        if(empty($r->institute_id)){
                            throw new Exeption("please select a Branch");
                        }
                    }
                    if(empty($_POST['station_name'][$key])){
                       throw new Exeption("Station Name is Required");
                    }
                    $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                    $model->deep_id = $deep_id;
                    $model->category_id = $category_id;
                    $model->product_id = $product_id;
                    $model->station_name = $value;
                    $model->_key =uniqueKey(). $key;
                    
                    if(!$model->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/station')->with('seccess','new Record Created Successfully');
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
       $model = new Station();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'station_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('station_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.station._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//       $data = Product::where('_key', $id)->first();
//       $category_set = Category::all();
//        return view('institute.product.edit', compact('data','category_set'));
//    }
    
      public function edit($id)
    {
       $data = Station::where('_key', $id)->first();
       $insList = Institute::where('type', 'institute')->get();
       $deep_set = Deep::all();
       $category_set = Category::all();
       $product_set = Product::all();
        return view('institute.station.edit', compact('data','insList','deep_set','category_set','product_set'));
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
            'deep_id' => 'required',
            'category_id' => 'required',
            'product_id' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'deep_id.required' => 'Deep must be selected.',
            'category_id.required' => 'category must be selected.',
            'product_id.required' => 'product Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = Station::find($id);
        $data->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $data->deep_id = $r->input('deep_id');
        $data->category_id = $r->input('category_id');
        $data->product_id = $r->input('product_id');
        $data->station_name = $r->input('station_name');
        $data->_key =uniqueKey();

        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/station')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        
        

        public function delete()
    {
        $station_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Station::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $station_del['success']=true;
             $station_del['message']='Station has been deleted successfully';

        } catch (Exception $e) {
            $station_del['success']=true;
             $station_del['message']=$e->getMessage();
        }
        return $station_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function get_station(Request $r) {
        $dataset = Station::where('deep_id', $r->deep)->get();
        $str = ["<option value=''>Select Station</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->station_name}</option>";
            }
            return $str;
        }
    }
}
