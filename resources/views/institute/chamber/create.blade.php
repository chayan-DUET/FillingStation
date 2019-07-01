@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Create New Chamber</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Chamber Caliber</span></li>
        </ul>                            
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Chamber Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'url' => 'chamber', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
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
                <label for="tanklory" class="col-md-4 control-label">Tanklory Name</label>
                <div class="col-md-6">
                    <select id="tanklory" class="form-control" name="tanklory_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Tanklory</option>
                        @foreach($tanklorys as $tanklory)
                        <option value="{{$tanklory->id}}">{{$tanklory->tank_lory_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Tanklory</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="chamber_name" class="col-md-4 control-label">Chamber Name</label>
                <div class="col-md-6">
                    <input type="text" id="chamber_name" class="form-control" name="chamber_name" required>
                   
                </div>
            </div>
            <div class="form-group">
                <label for="chamber_capacity" class="col-md-4 control-label">Chamber Capacity</label>
                <div class="col-md-6">
                    <input type="number" id="chamber_capacity" class="form-control" name="chamber_capacity">
                    
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
                url: "{{ URL::to('tanklory/tanklory') }}",
                type: "post",
                data: {'institute': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#tanklory').html(data);
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