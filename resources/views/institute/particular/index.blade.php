@extends('admin.layouts.master')
@section('content')
<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('{{url('view - clear')}}')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Particular List</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Particular</span></li>
        </ul>                            
    </div>
</div>
<div class="well">
    <table width="100%">
        <tbody>
            <tr>
                <td class="wmd_70">
                    {!! Form::open(['method' => 'POST',  'class' => 'search-form', 'id'=>'frmSearch','name'=>'frmSearch']) !!} 
                    {{ csrf_field() }}
                    <div class="input-group">
                        <div class="input-group-btn clearfix">
                            <select id="itemCount" class="form-control" name="item_count" style="width:58px;">
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="300">300</option>                         
                            </select>
                            @if( is_Admin() )
                            <div style="width:13%;"  class="col-md-2 col-sm-3 no_pad">
                                <select id="InstituteList" class="form-control" name="institute_id">
                                    <option value="">All Branch</option>   
                                    @foreach ( $insList as $ins )
                                    <option value="{{ $ins->id  }}">{{ $ins->name }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="col-md-2 col-sm-3 no_pad">
                                <select id="head" class="form-control" name="subhead_id" required>
                                    @if ( !is_Admin() )
                                    <option value="">All Sub Head</option>
                                    @foreach($subheads as $subhead)
                                    <option value="{{$subhead->id}}">{{$subhead->name}}</option>
                                    @endforeach
                                    @else
                                    <option value="">All Sub Head</option>
                                    @endif
                                </select>
                            </div>
                            <input type="text" name="search" id="q" class="form-control" placeholder="search" size="30"/>
                            <button type="button" id="search" class="btn btn-info">Search</button>
                            <button type="button" id="clear_from" class="btn btn-primary">Clear</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </td>
                <td class="text-right wmd_30" style="">
                    <a href="{{ url ('/particulars/create') }}"><button class="btn btn-success btn-xs"><i class="fa fa-plus"></i> New</button></a>
                    <button type="button" class="btn btn-danger btn-xs" id="Del_btn" disabled><i class="fa fa-trash-o"></i> Delete</button>
                    <button class="btn btn-primary btn-xs" onclick="printDiv('print_area')"><i class="fa fa-print"></i> Print</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
{!! Form::open(['method' => 'POST',  'class' => 'search-form', 'id'=>'frmList','name'=>'frmList']) !!} 
<div id="print_area">
    <?php print_header("Particular Information"); ?>
    <div id="ajax_content">
        <div class="table-responsive">
            <table class="table table-bordered tbl_thin" id="check">
                <tbody>
                    <tr class="bg_gray" id="r_checkAll">
                        <th class="text-center" style="width:5%;">SL#</th>
                        <th class="{{ show_hide() }} ">Branch Name</th>
                        <th>Sub Head Name</th>
                        <th>Particular Name</th>
                        <th class="text-right">Debit</th>
                        <th class="text-right">Credit</th>
                        <th class="text-right">Balance</th>
                        <th class="text-center hip" style="width:12%;">Actions</th>
                        <th class="text-center hip" style="width:4%;"><input type="checkbox" id="check_all"value="all"></th>
                    </tr>
                    <?php
                    $counter = 0;
                    if (isset($_GET['page']) && $_GET['page'] > 1) {
                        $counter = ($_GET['page'] - 1) * $dataset->perPage();
                    }
                    ?>
                    @foreach ($dataset as $data)
                    <?php
                    $counter++;
                    $_debit = $tmodel->sumPartDebit($data->id);
                    $_credit = $tmodel->sumPartCredit($data->id);
                    $_balance = $tmodel->sumPartBalance($data->id);
                    ?>   
                    <tr>
                        <td class="text-center">{{ $counter }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->institute->name }}</td>
                        <td>{{ $data->subhead->name }}</td>
                        <td>{{ $data->name }}</td>
                        <td class="text-right">{{ $_debit }}</td>
                        <td class="text-right">{{ $_credit }}</td>
                        <td class="text-right">{{ $_balance }}</td>                       
                        <td class="text-center hip">
                            <a class="btn btn-info btn-xs" href="particulars/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-primary btn-xs" href="{{ url('ledger/particular/'.$data->id) }}"><i class="fa fa-dashboard"></i> Ledger</a>
                        </td>
                        <td class="text-center hip">
                            <input type="checkbox" name="data[]" value="{{ $data->id }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center hip">
                {{ $dataset->render() }}
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
                url: "{{ URL::to('institute/subhead') }}",
                type: "post",
                data: {'institute': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#head').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });

        $("#search").click(function () {
            var _url = "{{ URL::to('particulars/search') }}";
            var _form = $("#frmSearch");

            $.ajax({
                url: _url,
                type: "post",
                data: _form.serialize(),
                success: function (data) {
                    $('#ajax_content').html(data);
                },
                error: function () {
                    $('#ajaxMessage').showAjaxMessage({html: 'There is some error.Try after some time.', type: 'error'});
                }
            });

        });

        $("#Del_btn").click(function () {
            var _url = "{{ URL::to('particulars/delete') }}";
            var _form = $("#frmList");
            var _rc = confirm("Are you sure about this action? This cannot be undone!");

            if (_rc == true) {

                $.post(_url, _form.serialize(), function (data) {
                    if (data.success === true) {
                        $('#ajaxMessage').showAjaxMessage({html: data.message, type: 'success'});
                        $("#search").trigger("click");
                    } else {
                        $('#ajaxMessage').showAjaxMessage({html: data.message, type: 'error'});
                    }
                }, "json");

            }

        });
    });
</script>
@endsection