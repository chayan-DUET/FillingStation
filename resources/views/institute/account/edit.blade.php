@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Update Deep </h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Deep</span></li>
        </ul>                            
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Product Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'PUT', 'url' => 'deep/'.$data->id, 'class' => 'form-horizontal']) !!} 
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
                <label for="company" class="col-md-4 control-label">Company Name</label>
                <div class="col-md-6">
                    <select id="company" class="form-control" name="institute_id">
                        <option value="">Select Company</option>                  
                        @foreach($company_set as $cs)
                        <?php $sel = ($cs->id == $data->company_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$cs->id}}" {{$sel}}>{{$cs->company_name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="categorylist" class="col-md-4 control-label">Category Name</label>
                <div class="col-md-6">
                    <select id="categorylist" class="form-control" name="institute_id">
                        <option value="">Select Category</option>                  
                        @foreach($category_set as $cst)
                        <?php $sel = ($cst->id == $data->category_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$cst->id}}" {{$sel}}>{{$cst->category_name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="product" class="col-md-4 control-label">Product Name</label>
                <div class="col-md-6">
                    <select id="product" class="form-control" name="institute_id">
                        <option value="">Select Product</option>                  
                        @foreach($product_set as $ps)
                        <?php $sel = ($ps->id == $data->product_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$ps->id}}" {{$sel}}>{{$ps->product_name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Deep name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="deep_name" value="{{$data->deep_name}}">
                    <small class="text-danger">{{ $errors->first('deep_name') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Deep name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="deep_name" value="{{$data->deep_name}}">
                    <small class="text-danger">{{ $errors->first('deep_name') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Unit name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="unit_name" value="{{$data->unit_name}}">
                    <small class="text-danger">{{ $errors->first('unit_name') }}</small>
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

</script>
@endsection