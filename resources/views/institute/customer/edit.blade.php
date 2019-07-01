@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Update Product </h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Product</span></li>
        </ul>                            
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Product Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'PUT', 'url' => 'customer/'.$data->id, 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Branch Name</label>
                <div class="col-md-6">
                    <select id="InstituteList" class="form-control" name="institute_id">
                        <option value="">Select Branch</option>                  
                        @foreach($insList as $il)
                        <?php $sel = ($il->id == $data->institute_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$il->id}}" {{$sel}}>{{$il->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Category Name</label>
                <div class="col-md-6">
                    <select id="ledger_head_id" class="form-control" name="type">
                        <option value="">Select Category</option>                  
                        <option value="H" {{$data->type=='H' ? 'selected':''}}>H</option>
                        <option {{$data->type=='V'? 'selected':''}}  value="V" >V</option>
                        <option {{$data->type=="BA"? 'selected':''}}  value="BA">BA</option>
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Customer name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="customer_name" value="{{$data->customer_name}}">
                    <small class="text-danger">{{ $errors->first('customer_name') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Address</label>
                <div class="col-md-6 input_fields_wrap">
                    <textarea name="address" class="form-control">{{$data->address}}</textarea>
                    <small class="text-danger">{{ $errors->first('address') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Mobile No</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="mobile_no" value="{{$data->mobile_no}}" required>
                    <small class="text-danger">{{ $errors->first('mobile_no') }}</small>  
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Phone No</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="phone_no" value="{{$data->phone_no}}">  
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Reference By</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="reference" value="{{$data->reference}}"> 
                    <small class="text-danger">{{ $errors->first('reference') }}</small> 
                </div>
            </div>
            
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Description</label>
                <div class="col-md-6 input_fields_wrap">
                    <textarea name="description" class="form-control">{{$data->description}}</textarea>
                    <small class="text-danger">{{ $errors->first('description') }}</small> 
                </div>
            </div>
           
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="button" id="reset_from" class="btn btn-info">Reset</button>
                    <input type="submit" class="btn btn-primary" name="btnSave" value="Update">
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!} 
@endsection