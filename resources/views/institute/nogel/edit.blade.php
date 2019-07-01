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
            {!! Form::open(['method' => 'PUT', 'url' => 'nogel/'.$data->id, 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <div class="form-group">
                <label for="InstituteList" class="col-md-4 control-label">Category Name</label>
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
                <label for="deep" class="col-md-4 control-label">Deep Name</label>
                <div class="col-md-6">
                    <select id="deep" class="form-control" name="deep_id">
                        <option value="">Select Deep</option>                  
                        @foreach($deep_set as $il)
                        <?php $sel = ($il->id == $data->deep_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$il->id}}" {{$sel}}>{{$il->deep_name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="station" class="col-md-4 control-label">Station Name</label>
                <div class="col-md-6">
                    <select id="station" class="form-control" name="station_id">
                        <option value="">Select Station</option>                  
                        @foreach($station_set as $ss)
                        <?php $sel = ($ss->id == $data->station_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$ss->id}}" {{$sel}}>{{$ss->station_name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Nogel No</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nozel_no" value="{{$data->nozel_no}}">
                    <small class="text-danger">{{ $errors->first('nozel_no') }}</small>
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
                url: "{{ URL::to('deep/deep') }}",
                type: "post",
                data: {'institute': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#deep').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

$(document).on("change", "#deep", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('station/station') }}",
                type: "post",
                data: {'deep': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#station').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });
});
</script>
@endsection