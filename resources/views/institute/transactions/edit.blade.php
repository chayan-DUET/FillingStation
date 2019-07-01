@extends('admin.layouts.master')
@section('content')
<?php
$frm_head = $data->cr_subhead_id;
$frm_particular = $data->cr_particular_id;
$to_head = $data->dr_subhead_id;
$to_particular = $data->dr_particular_id;
if ($data->type == 'D') {
    $tp = 'd';
} elseif ($data->type == 'C') {
    $tp = 'c';
} else {
    $tp = 'journal';
}
if ($tp == 'd') {
    $pcls = "success";
    $pbg = "bg-success";
    $title = "Receive";
} elseif ($tp == 'c') {
    $pcls = "danger";
    $pbg = "bg-danger";
    $title = "Payment";
} else {
    $pcls = "warning";
    $pbg = "bg-warning";
    $title = "Journal";
}
?>
<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Update Transaction ({{ $title }} Voucher)</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Transactions</span></li>
        </ul>                            
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Transaction Information</div>
        <div class="panel-body {{$pbg}}">
            {!! Form::open(['method' => 'PUT', 'url' => 'transactions/'.$data->id, 'id' => 'frm_Transaction'  , 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <input type="hidden" name="type" value="{{ $tp }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="datepicker" class="col-md-3">Date</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" id="datepicker" class="form-control pickdate" name="date" value="{{ !empty($data->date) ? date_dmy($data->date) : date('d-m-Y') }}" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <small class="text-danger">{{ $errors->first('date') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-3">Description</label>
                        <div class="col-md-8">                    
                            <textarea id="description" class="form-control" name="description">{{ $data->description }}</textarea>
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="by_whom" class="col-md-3">By Whom</label>
                        <div class="col-md-8">
                            <input type="text" id="by_whom" class="form-control" name="by_whom" value="{{ $data->by_whom }}">
                            <small class="text-danger">{{ $errors->first('by_whom') }}</small>
                        </div>               
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-md-3 control-label">Amount</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="number" id="amount" class="form-control" name="amount" min="0" value="{{ $data->amount }}" required>
                                <span class="input-group-addon">Tk</span>
                            </div>
                            <small class="text-danger">{{ $errors->first('amount') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">From</label>
                        <div class="col-md-8">
                            <select id="headDebit" class="form-control" name="frm_subhead" required>
                                <option value="">Select Head</option>
                                @foreach($heads as $head)
                                <option value="{{ $head->id }}" @if($frm_head == $head->id) {{ 'selected' }} @endif>{{$head->name}}</option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('frm_subhead') }}</small>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="subheadDebit" class="col-md-3"></label>
                        <div class="col-md-8">
                            <select id="subheadDebit" class="form-control" name="frm_particular">
                                @foreach($particular->where('subhead_id',$frm_head)->get() as $pt)
                                <option value="">Select Sub Head</option>
                                <option value="{{$pt->id}}" @if($frm_particular == $pt->id) {{ 'selected' }} @endif>{{$pt->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">To</label>
                        <div class="col-md-8">
                            <select id="headCredit" class="form-control" name="to_subhead" required>
                                <option value="">Select Head</option>
                                @foreach($heads as $head)
                                <option value="{{$head->id}}" @if($to_head == $head->id) {{ 'selected' }} @endif>{{$head->name}}</option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('to_subhead') }}</small>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="subheadCredit" class="col-md-3"></label>
                        <div class="col-md-8">
                            <select id="subheadCredit" class="form-control" name="to_particular">
                                @foreach($particular->where('subhead_id',$to_head)->get() as $pt)
                                <option value="">Select Sub Head</option>
                                <option value="{{$pt->id}}" @if($to_particular == $pt->id) {{ 'selected' }} @endif>{{$pt->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>
                </div>
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <button type="button" id="reset_from" class="btn btn-info">Reset</button>
                    <input type="submit" class="btn btn-primary" name="btnSave" value="Update">
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!} 


<script type="text/javascript">
    $(document).ready(function () {

        $(document).on("change", "#headCredit", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('particulars/particular') }}",
                type: "post",
                data: {'head': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    enable("#subheadCredit");
                    $('#subheadCredit').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

        $(document).on("change", "#headDebit", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('particulars/particular') }}",
                type: "post",
                data: {'head': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    enable("#subheadDebit");
                    $('#subheadDebit').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

    });

    $("#reset_from").click(function () {
        var _form = $("#frm_Transaction");
        _form[0].reset();
    });

</script>
@endsection