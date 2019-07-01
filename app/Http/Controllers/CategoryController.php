<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Auth;
use DB;
use App\Models\Institute;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $model = new Category();
        $query = is_Admin() ? $model : $model->where('institute_id', institute_id());
        $dataset = $query->paginate();
        return view('institute.category.index', compact('insList', 'dataset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insList = Institute::where('type', 'institute')->get();
        return view('institute.category.create', compact('insList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        DB::beginTransaction();
        try{
            foreach($_POST['category_name'] as $key => $value){
                    $model = new  Category();
                    if(is_Admin()){
                        if(empty($r->institute_id)){
                            throw new Exeption("please select a Branch");
                        }
                    }
                    if(empty($_POST['category_name'][$key])){
                       throw new Exeption("Category Name is Required");
                    }
                    $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();
                    $model->category_name = $value;
                    $model->_key =uniqueKey() .$key;
                    
                    if(!$model->save()){
                            throw new Exception("Error While Creating Records");
                    }
            }
            DB::commit();
            return redirect('/category')->with('seccess','new Record Created Successfully');
        } catch(Exception $e){
                DB::rollback();
                return redirect()->back()->with('danger',$e->getMessage());
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
       $model = new Category();
        $item_count = !empty($r->item_count) ? $r->item_count : $this->getSettings()->pagesize;
        $institute = $r->institute_id;
        $search = $r->input('search');
        $sort_by = 'category_name';
        $sort_type = $r->sort_type;
        $query = is_Admin() ? $model->where('id', '!=', 0) : $model->where('institute_id', institute_id());
        if (!empty($institute)) {
            $query->where('institute_id', $institute);
        }
        if (!empty($search)) {
            $query->where('category_name', 'like', '%' . $search . '%');
        }
        $query->orderBy($sort_by, $sort_type);
        $dataset = $query->paginate($item_count);
        return view('institute.category._list', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::where('_key', $id)->first();
        return view('institute.category.edit', compact('data'));
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
                'category_name' => 'required',
        );
        $messages = array(
                'category_name.required' => 'Category name Should not be empty',
        );
        $valid = Validator::make($input, $rule, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $data = Category::find($id);
        $data->category_name = $r->input('category_name');
        DB::beginTransaction();
        try{
                if(!$data->save()){
                    throw new Exception("Query Problem on Updating Record.");
                }
                DB::commit();
                return redirect('/category')->with('success', 'Record Updated Successfully.');
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
        $category_del=array();
        DB::beginTransaction();
        try{
            foreach($_POST['data'] as $id){
                    $data = Category::find($id);
                    if(!$data->delete()){
                            throw new Exception("Error while deleting records. ");
                    }
            }
            DB::commit();
             $category_del['success']=true;
             $category_del['message']='Customer has been deleted successfully';

        } catch (Exception $e) {
            $category_del['success']=true;
             $category_del['message']=$e->getMessage();
        }
        return $category_del;
    }
}
