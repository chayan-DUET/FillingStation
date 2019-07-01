<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        $model = new Employee();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        return view('institute.employee.index', compact('insList', 'dataset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        return view('institute.employee.create', compact('insList'));
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
            'employee_name' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'employee_name.required' => 'Employee Name  Should not be empty.',
            'designation.required' => 'Designation Should not be empty.',
            'address.required' => 'Address Should not be empty.',
            'mobile_no.required' => 'Mobile no Should not be empty.',
        );

        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $model = new Employee();
        $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $model->employee_name = $r->employee_name;
        $model->designation = $r->designation;
        $model->address = $r->address;
        $model->mobile_no = $r->mobile_no;
        $model->phone_no = $r->phone_no;
        $model->salary = $r->salary;
        $model->description = $r->description;
        $model->created_by = Auth::id();
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
            return redirect('/employee')->with('success', 'New Record Created Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    public function search(Request $r)
    {
       $model = new Employee();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'employee_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('employee_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.employee._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $insList = Institute::where('type', 'institute')->get();
        $data = Employee::where('_key', $id)->first();
        return view('institute.employee.edit', compact('data','insList'));
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
            'institute_id' => 'required',
            'employee_name' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
        );
        $messages = array(
            'institute_id.required' => 'Institute must be selected.',
            'employee_name.required' => 'Employee Name  Should not be empty.',
            'designation.required' => 'Designation Should not be empty.',
            'address.required' => 'Address Should not be empty.',
            'mobile_no.required' => 'Mobile no Should not be empty.',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $data = Employee::find($id);
        $data->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
        $data->employee_name = $r->input('employee_name');
        $data->designation = $r->input('designation');
        $data->address = $r->input('address');
        $data->mobile_no = $r->input('mobile_no');
        $data->phone_no = $r->input('phone_no');
        $data->salary = $r->input('salary');
        $data->description = $r->input('description');
        $data->created_by = Auth::id();
        $data->_key = uniqueKey();

        DB::beginTransaction();
        try{
                if(!$data->save()){
                    throw new Exception("Query Problem on Updating Record.");
                }
                DB::commit();
                return redirect('/employee')->with('success', 'Record Updated Successfully.');
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
        $emp_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Employee::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $emp_del['success']=true;
             $emp_del['message']='Employee has been deleted successfully';

        } catch (Exception $e) {
            $emp_del['success']=true;
             $emp_del['message']=$e->getMessage();
        }
        return $emp_del;
    }
}
