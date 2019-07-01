@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Update Chamber </h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Chamber</span></li>
        </ul>                            
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Chamber Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'PUT', 'url' => 'chamber/'.$data->id, 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
             
            
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Tanklory Name</label>
                <div class="col-md-6">
                    <select id="ledger_head_id" class="form-control" name="tanklory_id">
                        <option value="">Select Tanklory</option>                  
                        @foreach($tanklory_set as $ts)
                        <?php $sel = ($ts->id == $data->tanklory_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$ts->id}}" {{$sel}}>{{$ts->tank_lory_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Chamber name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="chamber_name" value="{{$data->chamber_name}}">
                    <small class="text-danger">{{ $errors->first('chamber_name') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Chamber Capacity</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="chamber_capacity" value="{{$data->chamber_capacity}}">
                    <small class="text-danger">{{ $errors->first('chamber_capacitys') }}</small>
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