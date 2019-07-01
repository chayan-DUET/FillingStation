@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Update Employee </h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Employee</span></li>
        </ul>                            
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Category Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'PUT', 'url' => 'employee/'.$data->id, 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <div class="form-group">
                <label for="InstituteList" class="col-md-4 control-label">Branch Name</label>
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
                <label for="name" class="col-md-4 control-label">Employee name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="employee_name" value="{{$data->employee_name}}">
                    <small class="text-danger">{{ $errors->first('category_name') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Designation</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="designation" value="{{$data->designation}}">
                    <small class="text-danger">{{ $errors->first('designation') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Address</label>
                <div class="col-md-6">
                    <textarea name="address" class="form-control">{{$data->address}}</textarea>
                    <small class="text-danger">{{ $errors->first('designation') }}</small>
                </div>
            </div>
             <div class="form-group">
                <label for="name" class="col-md-4 control-label">Mobile No</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="mobile_no" value="{{$data->mobile_no}}">
                    <small class="text-danger">{{ $errors->first('mobile_no') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Phone No</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="phone_no" value="{{$data->phone_no}}">
                    <small class="text-danger">{{ $errors->first('phone_no') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Salary</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="salary" value="{{$data->salary}}">
                    <small class="text-danger">{{ $errors->first('salary') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Description</label>
                <div class="col-md-6">
                    <textarea name="description" class="form-control">{{$data->description}}</textarea>
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="button" id="reset_from" class="btn btn-info">Reset</button>
                    <input type="submit" class="btn btn-primary" name="btnSave" value="Save">
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!} 
@endsection