@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title col">Create New Customer Type</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Supplier</span></li>
        </ul>                            
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">SubHead Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'url' => 'customer_type', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <div class="form-group">
                <label for="InstituteList" class="col-md-4 control-label">Branch</label>
            @if( is_Admin() )
                <div class="col-md-6">
                    <select name="institute_id" id="InstituteList" class="form-control" required>
                        <option value="">Select Branch</option>
                        @foreach ($insList as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('institute_id') }}</small>
                </div>
            @endif
        </div>
        <div class="form-group">
                <label for="comapany" class="col-md-4 control-label">Type</label>
                <div class="col-md-6">
                    <select id="comapany" class="form-control" name="type" required>
                        
                        <option value="">Select Type</option>
                        <option value="H">H</option>
                        <option value="V">V</option>
                        <option value="BA">BA</option>
                       
                    </select>
                </div>
            </div> 
            
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Customer Type</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="customer_type" required>  
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Address</label>
                <div class="col-md-6 input_fields_wrap">
                    <textarea name="address" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Mobile No</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="mobile_no" required>  
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Phone No</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="phone_no">  
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Reference By</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="reference">  
                </div>
            </div>
            
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Description</label>
                <div class="col-md-6 input_fields_wrap">
                    <textarea name="description" class="form-control"></textarea>
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