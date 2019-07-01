@extends('admin.layouts.master')

@section('content')

    <div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
        <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
            <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
            <button class="btn btn-info btn-xs" onclick="redirectTo('/en/site/clear_cache')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
            <h2 class="page-title">Update User Password</h2>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
            <ul class="text-right no_mrgn">
                <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Password</span></li>
            </ul>                            
        </div>
    </div>
    <div class="customer_info">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Update Password</div>
                <div class="panel-body">
                     {!! Form::open(['method' => 'POST', 'url' => 'password/update', 'class' => 'form-horizontal']) !!} 
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Old Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control"  name="old_password" required>
                                <small class="text-danger">{{ $errors->first('old_password') }}</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">New Password</label>
                            <div class="col-md-6">
                                <input  type="password" class="form-control" name="password"  required>
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Retype New Password</label>
                            <div class="col-md-6">
                                <input  type="password" class="form-control" name="password_confirmation"  required>
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!} 
@endsection