<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $insList = Institute::where('type', 'institute')->get();
        //$setting = $this->getSettings();
        $model = new Company();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        return view('institute.company.index', compact('insList', 'dataset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $insList = Institute::where('type', 'institute')->get();
        return view('institute.company.create', compact('insList'));
    }

    public function store(Request $r) {
        DB::beginTransaction();
        try {
            foreach ($_POST['company_name'] as $key => $value) {
                $model = new Company();
                if (is_Admin()) {
                    if (empty($r->institute_id)) {
                        throw new Exeption("please select a Branch");
                    }
                }
                if (empty($_POST['company_name'][$key])) {
                    throw new Exeption("Company Name is Required");
                }
                $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                $model->company_name = $value;
                $model->_key = uniqueKey().$key;

                if (!$model->save()) {
                    throw new Exception("Error While Creating Records");
                }
            }
            DB::commit();
            return redirect('/company')->with('seccess', 'new Record Created Successfully');
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
    public function show(Category $category) {
        //
    }

    public function search(Request $r) {
        $model = new Company();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'company_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('company_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.company._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = Company::where('_key', $id)->first();
        return view('institute.company.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id) {
        $input = $r->all();
        $rule = array(
            'company_name' => 'required',
        );
        $messages = array(
            'company_name.required' => 'Company name Should not be empty',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $data = Company::find($id);
        $data->company_name = $r->input('company_name');
        DB::beginTransaction();
        try {
            if (!$data->save()) {
                throw new Exception("Query Problem on Updating Record.");
            }
            DB::commit();
            return redirect('/company')->with('success', 'Record Updated Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete() {
        $company_del = array();
        DB::beginTransaction();
        try {
            foreach ($_POST['data'] as $id) {
                $data = Company::find($id);
                if (!$data->delete()) {
                    throw new Exception("Error while deleting records. ");
                }
            }
            DB::commit();
            $company_del['success'] = true;
            $company_del['message'] = 'Transaction has been deleted successfully';
        } catch (Exception $e) {
            $company_del['success'] = true;
            $company_del['message'] = $e->getMessage();
        }
        return $company_del;
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

}
