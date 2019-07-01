<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institute;
use App\Models\Head;
use App\Models\SubHead;
use App\Models\Mill;
use App\Models\Category;
use App\Models\Chamber;
use App\Models\RawBrickField;
use App\Models\Customer;
use App\Models\RawBrickItem;
use App\Models\Transaction;
use Validator;
use Auth;
use DB;

class InstituteController extends Controller {

    public function index() {
        $model = new Institute();
        //$dataset = $model->where('id', '!=', institute_id())->get();
        $dataset = $model->get();
        return view('institute.institute.index', compact('dataset'));
    }

    public function create() {
        return view('institute.institute.create');
    }

    public function store(Request $r) {
        $input = $r->all();
        $rules = array(
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:institutes',
        );

        $messages = array(
            'name.required' => 'Please Provide Institute Name.',
        );

        $valid = Validator::make($input, $rules, $messages);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $insert_data = array(
            'name' => $r->input('name'),
            'address' => $r->input('address'),
            'phone' => $r->input('phone'),
            'mobile' => $r->input('mobile'),
            'email' => $r->input('email'),
            'website' => $r->input('website'),
            'created_by' => Auth::id(),
            '_key' => uniqueKey(),
        );

        $default_institute_access_items = default_institute_access_items();
        $items = json_encode($default_institute_access_items);

        $institute_permissiion = array(
            'permissions' => $items,
            '_key' => $insert_data['_key'],
        );

        $setting = array(
            'title' => $insert_data['name'],
            'address' => $insert_data['address'],
            'email' => $insert_data['email'],
            'mobile' => $insert_data['mobile'],
            'phone' => $insert_data['phone'],
            'copyright' => "Copyright © " . date('Y') . " Protected. All Rights Reserved," . $insert_data['name'],
            'created_by' => Auth::id(),
            '_key' => $insert_data['_key'],
        );

        DB::beginTransaction();
        try {
            $create_institute = DB::table('institutes')->insert($insert_data);
            if (!$create_institute) {
                throw new Exception("Query Problem on Creating Institute");
            }

            $institute_id = DB::getPdo()->lastInsertId();

            $institute_permissiion ['institute_id'] = $institute_id;
            $create_permission = DB::table('institute_permissions')->insert($institute_permissiion);
            if (!$create_permission) {
                throw new Exception("Query Problem on Creating Permission");
            }

            $setting ['institute_id'] = $institute_id;
            $create_setting = DB::table('general_settings')->insert($setting);
            if (!$create_setting) {
                throw new Exception("Query Problem on Creating Settings");
            }

            DB::commit();
            return redirect('institute')->with('success', 'New Institute has been Created Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function edit($id) {
        $data = Institute::where('_key', $id)->first();
        return view('institute.institute.edit', compact('data'));
    }

    public function update(Request $r, $id) {
        //pr($_POST,false);
        $input = $r->all();
        $rules = array(
            'name' => 'required',
            'email' => 'required|unique:institutes,email,' . $id,
        );

        $messages = array(
            'name.required' => 'Please Provide Institute Name.',
        );

        $valid = Validator::make($input, $rules, $messages);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $update_data = array(
            'name' => $r->input('name'),
            'address' => $r->input('address'),
            'phone' => $r->input('phone'),
            'mobile' => $r->input('mobile'),
            'email' => $r->input('email'),
            'website' => $r->input('website'),
            'created_by' => Auth::id()
        );

        $update_institute = DB::table('institutes')->where('id', $id)->update($update_data);

        return redirect('institute')->with('success', 'Institute Information Updated Successfully.');
    }

    public function show($id) {
        $data = Institute::where('_key', $id)->first();
        return view('institute.institute.view', compact('data'));
    }

    public function institute_access_by_id($id) {
        check_user_access('institute_access');
        $data = Institute::where('_key', $id)->first();
        return view('institute.institute.access', compact('data'));
    }

    public function get_institute_by_type(Request $r) {
        $type = $r->type;
        $dataset = Institute::where([['type', $type], ['status', 1]])->get();
        $str = [];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name}</option>";
            }
            return $str;
        }
    }

    public function update_institute_access_by_id(Request $r) {
        check_user_access('institute_access');
        $institute_id = $r->input('institute_id');
        $new_access = $r->input('access');
        $access_item = json_encode($new_access);
        $items = array(
            'permissions' => $access_item,
        );
        $update_access_item = DB::table('institute_permissions')->where('institute_id', '=', $institute_id)->update($items);
        return redirect('institute')->with('success', 'Institute Permission has been Updated Successfully.');
    }

    public function get_head(Request $r) {
        $dataset = Head::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Head</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name}</option>";
            }
            return $str;
        }
    }

    public function get_chamber(Request $r) {
        $dataset = Chamber::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Chamber</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name}</option>";
            }
            return $str;
        }
    }

    public function get_raw_brick_field(Request $r) {
        $dataset = RawBrickField::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Raw Brick Field</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name}</option>";
            }
            return $str;
        }
    }

    public function get_subhead(Request $r) {
        $dataset = SubHead::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Sub Head</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name}</option>";
            }
            return $str;
        }
    }

    public function get_customer_list(Request $r) {
        $dataset = Customer::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Customer</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name} ({$data->mobile})</option>";
            }
            return $str;
        }
    }

    public function get_mill_list(Request $r) {
        $dataset = Mill::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Mill</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                //pr($data->particular_name($data->particular_id));
                $str[] = "<option value='$data->id'>{$data->name} ( {$data->particular_name($data->particular_id)} )</option>";
            }
            return $str;
        }
    }

    public function get_category_list(Request $r) {
        $dataset = Category::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Category</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name}</option>";
            }
            return $str;
        }
    }

    public function get_chamber_list(Request $r) {
        $dataset = Chamber::where('institute_id', $r->institute)->get();
        $str = ["<option value=''>Select Chamber</option>"];
        if (!empty($dataset)) {
            foreach ($dataset as $data) {
                $str[] = "<option value='$data->id'>{$data->name}</option>";
            }
            return $str;
        }
    }

    public function get_rawbricks_mills(Request $r) {
        $institute_id = $r->institute;
        $dataset = Mill::where('institute_id', $institute_id)->get();
        return view('institute.rawbrick._mill', compact('dataset', 'institute_id'));
    }

    public function get_loading_chambers(Request $r) {
        $institute_id = $r->institute;
        $dataset = Chamber::where('institute_id', $institute_id)->get();
        $rawBrickItem = new RawBrickItem();
        $rawstocks = $rawBrickItem->sumRawBrickBalance($institute_id);
        return view('institute.loading._chamber', compact('dataset', 'rawstocks', 'institute_id'));
    }

    public function get_loading_raw_brick_field(Request $r) {
        $institute_id = $r->institute;
        $dataset = RawBrickField::where('institute_id', $institute_id)->get();
        $rawBrickItem = new RawBrickItem();
        $rawstocks = $rawBrickItem->sumRawBrickBalance($institute_id);
        $chamber_list = new Chamber();
        $chambers = Chamber::where('institute_id', $institute_id)->get();
        $heads = SubHead::where('institute_id', $institute_id)->get();
        return view('institute.loading._raw_brick_field', compact('dataset', 'rawstocks', 'institute_id', 'chamber_list', 'heads', 'chambers'));
    }
    
    public function get_unloading_chamber(Request $r) {
        $institute_id = $r->institute;
        $dataset = RawBrickField::where('institute_id', $institute_id)->get();
        $rawBrickItem = new RawBrickItem();
        $rawstocks = $rawBrickItem->sumRawBrickBalance($institute_id);
        $chamber_list = new Chamber();
        $chambers = Chamber::where('institute_id', $institute_id)->get();
        $heads = SubHead::where('institute_id', $institute_id)->get();
        return view('institute.unloading._chamber_list', compact('dataset', 'rawstocks', 'institute_id', 'chamber_list', 'heads', 'chambers'));
    }

    public function get_loading_items(Request $r) {
        $dataset = RawBrickItem::where([['institute_id', $r->institute], ['process_status', 1], ['stock_status', 0]])->groupBy('loading_id')->get();
        return view('institute.unloading._unloading_items', compact('dataset'));
    }

    public function get_sales_category(Request $r) {
        $institute_id = $r->institute;
        $dataset = Category::where('institute_id', $institute_id)->get();
        $customers = Customer::where('institute_id', $institute_id)->get();
        return view('institute.sales._category', compact('dataset', 'institute_id', 'customers'));
    }

    public function get_ledger(Request $r) {
        $institute_id = $r->institute;
        $dataset = Head::where('institute_id', $institute_id)->get();
        $tmodel = new Transaction();
        return view('institute.ledger._ledger', compact('dataset', 'institute_id', 'tmodel'));
    }

}
