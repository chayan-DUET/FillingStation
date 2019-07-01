<?php

namespace App\Http\Controllers;

use App\Models\Chambercaliber;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\Models\Tanklory;
use App\Models\Chamber;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class ChambercaliberController extends Controller
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
        $model = new Chambercaliber();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        $tanklorys = Tanklory::where('institute_id', institute_id())->get();
        $chambers = Chamber::where('institute_id', institute_id())->get();
        return view('institute.chambercaliber.index', compact('insList', 'dataset','tanklorys','chambers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        $tanklorys = Tanklory::where('institute_id', institute_id())->get();
        $chambers = Chamber::where('institute_id', institute_id())->get();
        return view('institute.chambercaliber.create', compact('insList','tanklorys','chambers'));
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
            'tanklory_id' => 'required',
            'chamber_id' => 'required',
            'mm' => 'required',
            'liter' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'tanklory_id.required' => 'Tanklory must be selected.',
            'chamber_id.required' => 'Chamber Name  Should not be empty.',
            'mm.required' => 'MM Should not be empty.',
            'liter.required' => 'Liter Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new Chambercaliber();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->tanklory_id =$r->tanklory_id;
        $model->chamber_id = $r->chamber_id;
        $model->mm = $r->mm;
        $model->liter = $r->liter;
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
            return redirect('/chambercaliber')->with('success', 'New Record Created Successfully.');
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
       $model = new Chambercaliber();
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
            $query->where('mm', 'like', '%' . $search . '%')->orWhere('liter', 'like', '%' . $search . '%');
        }
        $query->orderBy($mm_by,$liter_by,$sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.chambercaliber._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Chambercaliber::where('_key', $id)->first();
       $tanklory_set = Tanklory::all();
       $chamber_set = Chamber::all();
        return view('institute.chambercaliber.edit', compact('data','tanklory_set','chamber_set'));
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
            
            'tanklory_id' => 'required',
            'chamber_id' => 'required',
            'mm' => 'required',
            'liter' => 'required',
        );
        $messages = array(
            'tanklory_id.required' => 'Tanklory must be selected.',
            'chamber_id.required' => 'Chamber Name  Should not be empty.',
            'mm.required' => 'MM Should not be empty.',
            'liter.required' => 'Liter Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $data = Chambercaliber::find($id);
        $data->tanklory_id =$r->tanklory_id;
        $data->chamber_id = $r->chamber_id;
        $data->mm = $r->mm;
        $data->liter = $r->liter;
        $data->_key = uniqueKey();

        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }

            DB::commit();
            return redirect('/chambercaliber')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
        

        public function delete()
    {
        $chambercaliber_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Chambercaliber::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $chambercaliber_del['success']=true;
             $chambercaliber_del['message']='Chamber has been deleted successfully';

        } catch (Exception $e) {
            $chambercaliber_del['success']=true;
             $chambercaliber_del['message']=$e->getMessage();
        }
        return $chambercaliber_del;
    }
   
}
