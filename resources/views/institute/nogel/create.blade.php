@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Create New Nozel</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Nozel</span></li>
        </ul>                            
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">SubHead Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'url' => 'nogel', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
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
                <label for="deep" class="col-md-4 control-label">Deep Name</label>
                <div class="col-md-6">
                    <select id="deep" class="form-control" name="deep_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Deep</option>
                        @foreach($Deeps as $Deep)
                        <option value="{{$Deep->id}}">{{$Deep->deep_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Deep</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="station" class="col-md-4 control-label">Station Name</label>
                <div class="col-md-6">
                    <select id="station" class="form-control" name="station_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Station</option>
                        @foreach($stations as $station)
                        <option value="{{$station->id}}">{{$station->Station_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Station</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="nogel_no" class="col-md-4 control-label">Nozel No</label>
                <div class="col-md-6 input_fields_wrap">
                    <div><input type="text" class="form-control" id="nogel_no" name="nogel_no[]" required>
                    </div>
                    <button class="add_field_button form-control">Add More <i class="fa fa-plus" aria-hidden="true"></i></button> 
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
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var select = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="text-center"><input type="text" class="duplicate_field" name="nogel_no[]" required/>&nbsp;<a href="#" class="remove_field btn btn-danger btn-sm">Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

    });

    $("#reset_from").click(function () {
        var _form = $("#frm_product");
        _form[0].reset();
    });

</script>
@endsection