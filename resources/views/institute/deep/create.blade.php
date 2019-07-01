@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Create New Deep</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Deep</span></li>
        </ul>                            
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">SubHead Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'url' => 'deep', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            @if( is_Admin() )
            <div class="form-group">
                <label for="InstituteList" class="col-md-4 control-label">Branch</label>
                <div class="col-md-6">
                    <select name="institute_id" id="InstituteList" class="form-control" required>
                        <option value="">Select Branch</option>
                        @foreach ($insList as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('institute_id') }}</small>
                </div>
            </div> 
            @endif
            <div class="form-group">
                <label for="company" class="col-md-4 control-label">Company Name</label>
                <div class="col-md-6">
                    <select id="company" class="form-control" name="company_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Company</option>
                        @foreach($companys as $company)
                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Company</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="categorylist" class="col-md-4 control-label">Category Name</label>
                <div class="col-md-6">
                    <select id="categorylist" class="form-control" name="category_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Category</option>
                        @foreach($Categorys as $Category)
                        <option value="{{$Category->id}}">{{$Category->category_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Category</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="product" class="col-md-4 control-label">Product Name</label>
                <div class="col-md-6">
                    <select id="product" class="form-control" name="product_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Product</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Deep Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="deep_name" required>
                   
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Deep Type</label>
                <div class="col-md-6">
                    <select class="form-control" name="deep_type" required>
                        <option value="">Select deep type</option>
                        <option value="Underground">Underground</option>
                        <option value="Overground">Overground</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Deep Capacity</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="deep_capacity">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Deep Issue Authority</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="deep_issue_authority">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Calibration by</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="calibration_by">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Calibration Date</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="calibration_date">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Validity</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="validity">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Remarks</label>
                <div class="col-md-6">
                    <textarea class="form-control" name="remarks"></textarea>
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


<script type="text/javascript">

    $(document).ready(function () {
        $(document).on("change", "#InstituteList", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('category/category') }}",
                type: "post",
                data: {'institute': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#categorylist').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

$(document).on("change", "#InstituteList", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('company/company') }}",
                type: "post",
                data: {'institute': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#company').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

$(document).on("change", "#categorylist", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('product/product') }}",
                type: "post",
                data: {'category': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#product').html(data);
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