@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Create New Supplier</h2>
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
            {!! Form::open(['method' => 'POST', 'url' => 'supplier', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
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
                <label for="comapany" class="col-md-4 control-label">Category Name</label>
                <div class="col-md-6">
                    <select id="comapany" class="form-control" name="company_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Company</option>
                        @foreach($Companys as $Company)
                        <option value="{{$Company->id}}">{{$Company->company_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Company</option>
                        @endif
                    </select>
                </div>
            </div> 
            
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Supplier Name</label>
                <div class="col-md-6 input_fields_wrap">
                    <input type="text" class="form-control" name="supplier_name" required>  
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
                <label for="name" class="col-md-4 control-label">Description</label>
                <div class="col-md-6 input_fields_wrap">
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-1">
                    <button type="button" id="reset_from" class="btn btn-info">Reset</button>
                    <input type="submit" class="btn btn-primary" name="btnSave" value="Save">
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!} 


<script type="text/javascript">

    $(document).ready(function () {
        $(document).on("change", "#InstituteList", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('company/company') }}",
                type: "post",
                data: {'institute': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#comapany').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });
    });

    $("#reset_from").click(function () {
        var _form = $("#frm_product");
        _form[0].reset();
    });

</script>
@endsection