@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Create New Tanklory</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Tanklory</span></li>
        </ul>                            
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Tanklory Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'url' => 'tanklory', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
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
                <label for="name" class="col-md-4 control-label">Tanklory Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="tank_lory_name" required>
                   
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Registration Date</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="registration_date">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Registration No Authority</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="registration_no">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">License No</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="license_no">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Chasiss No</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="chasiss_no">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-md-4 control-label">Date of Caliber</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="date_of_caliber">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Validity</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="validity">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label"> Vehicle No</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="vehicle_no">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Notes</label>
                <div class="col-md-6">
                    <textarea class="form-control" name="notes"></textarea>
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

    });

    $("#reset_from").click(function () {
        var _form = $("#frm_product");
        _form[0].reset();
    });

</script>
@endsection