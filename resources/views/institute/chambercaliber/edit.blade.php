@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Update Chamber Caliber </h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Chamber Caliber</span></li>
        </ul>                            
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Chamber Caliber Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'PUT', 'url' => 'chambercaliber/'.$data->id, 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
             
            
            <div class="form-group">
                <label for="tanklory" class="col-md-4 control-label">Tanklory Name</label>
                <div class="col-md-6">
                    <select id="tanklory" class="form-control" name="tanklory_id">
                        <option value="">Select Tanklory</option>                  
                        @foreach($tanklory_set as $ts)
                        <?php $sel = ($ts->id == $data->tanklory_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$ts->id}}" {{$sel}}>{{$ts->tank_lory_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="chamber" class="col-md-4 control-label">Chamber Name</label>
                <div class="col-md-6">
                    <select id="chamber" class="form-control" name="chamber_id">
                        <option value="">Select Tanklory</option>                  
                        @foreach($chamber_set as $cs)
                        <?php $sel = ($cs->id == $data->chamber_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$cs->id}}" {{$sel}}>{{$cs->chamber_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="mm" class="col-md-4 control-label">MM</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="mm" id="mm" value="{{$data->mm}}">
                    <small class="text-danger">{{ $errors->first('mm') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="liter" class="col-md-4 control-label">Liter</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="liter" name="liter" value="{{$data->liter}}">
                    <small class="text-danger">{{ $errors->first('liter') }}</small>
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
$(document).on("change", "#tanklory", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('chamber/chamber') }}",
                type: "post",
                data: {'tanklory': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#chamber').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

    });
</script>
@endsection