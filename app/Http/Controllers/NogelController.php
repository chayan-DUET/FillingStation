<?php

namespace App\Http\Controllers;

use App\Models\Nogel;
use App\Models\Station;
use App\Models\Deep;
use App\Models\Institute;
use Exception;
use Auth;
use DB;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class NogelController extends Controller
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
        $model = new Nogel();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $deeps = Deep::where('institute_id', institute_id())->get();
        $stations =Station::where('institute_id', institute_id())->get();
        return view('institute.nogel.index', compact('insList', 'dataset','deeps','stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $Deeps = Deep::where('institute_id', institute_id())->get();
        $stations = Station::where('institute_id', institute_id())->get();
        return view('institute.nogel.create', compact('insList','Deeps','stations'));
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
        $station_id = $r->station_id;
        DB::beginTransaction();
        try{
            foreach($_POST['nogel_no'] as $key => $value){
                    $model = new  Nogel();
                    if(is_Admin()){
                        if(empty($r->institute_id)){
                            throw new Exeption("please select a Branch");
                        }
                    }
                    if(empty($_POST['nogel_no'][$key])){
                       throw new Exeption("Nogel No is Required");
                    }
                    $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                    $model->deep_id = $deep_id;
                    $model->station_id = $station_id;
                    $model->nozel_no = $value;
                    $model->_key =uniqueKey().$key;
                    
                    if(!$model->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/nogel')->with('seccess','new Record Created Successfully');
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
       $model = new Nogel();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'nozel_no';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('nozel_no', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.nogel._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Nogel::where('_key', $id)->first();
       $insList = Institute::where('type', 'institute')->get();
       $deep_set = Deep::all();
       $station_set = Station::all();
        return view('institute.nogel.edit', compact('insList','data','deep_set','station_set'));
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
            'station_id' => 'required',
            'nozel_no' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'deep_id.required' => 'Deep must be selected.',
            'station_id.required' => 'Station must be selected.',
            'nozel_no.required' => 'Nozel Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data = Nogel::find($id);
        $data->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $data->deep_id = $r->input('deep_id');
        $data->station_id = $r->input('station_id');
        $data->nozel_no = $r->input('nozel_no');
        $data->_key =uniqueKey();

        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/nogel')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $nogel_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Nogel::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $nogel_del['success']=true;
             $nogel_del['message']='Nogel no has been deleted successfully';

        } catch (Exception $e) {
            $nogel_del['success']=true;
             $nogel_del['message']=$e->getMessage();
        }
        return $nogel_del;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
 
}
