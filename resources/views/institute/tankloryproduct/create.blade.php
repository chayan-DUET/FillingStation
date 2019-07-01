@extends('admin.layouts.master')
@section('content')
<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Branch List</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Ledger</span></li>
        </ul>                            
    </div>
</div>
@if( is_Admin() )
    <div class="col-md-4">
<div class="form-group" style="margin-bottom:7%;">
    <label for="InstituteList">Branch</label>
        <select id="InstituteList" class="form-control" name="institute_id" required>
            <option value="">Select Branch</option>
            @foreach ($insList as $institute)
            <option value="{{ $institute->id }}">{{ $institute->name }}</option>
            @endforeach
        </select>
        
    </div> 
</div>
@endif
    <div class="col-md-4">
<div class="form-group" style="margin-bottom:7%;">
    <label for="date">Date</label>
        <input type="text" class="form-control pickdate" id="request_date" autocomplete="off">
    </div> 
</div>
    <div class="col-md-4">
<div class="form-group" style="margin-bottom:7%;">
    <label for="pay">Challan No</label>
        <select class="form-control" id="challanlist">
            <option>Select Challan No</option>
        </select>
    </div> 
</div>

<div id="tanklory" style="margin-top: 5px;">
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("change", "#request_date", function () {
            var date = $(this).val();
            var id = $('#InstituteList').val();
            $.ajax({
                url: "{{ URL::to('challanno/challanno') }}",
                type: "post",
                data: {'institute': id,'date':date, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    $('#challanlist').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

        $(document).on("change", "#challanlist", function () {
            var challan = $(this).val();
            var id = $('#InstituteList').val();
            $.ajax({
                url: "{{ URL::to('slipno/slipno') }}",
                type: "post",
                data: {'institute': id,'challan':challan, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    $('#tanklory').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });
});



</script>
@endsection