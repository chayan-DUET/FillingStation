@extends('admin.layouts.master')
@section('content')
<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Purchase order List</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Purchase Order</span></li>
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
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>                         
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
                            <div class="col-md-2 col-sm-3 no_pad" style="width:13%;">
                                <select id="sortType"  class="form-control" name="sort_type">
                                    <option value="ASC">Ascending</option>
                                    <option value="DESC">Descending</option>
                                </select>
                            </div>
                            <div style="width:14%;" class="col-md-2 col-sm-3 no_pad">
                                <input type="text" name="from_date" placeholder="(dd-mm-yyyy)" class="form-control pickdate" size="30" readonly>
                            </div> 
                            <div style="width:6%" class="col-md-1 col-sm-1 no_pad">
                                <span style="font-size:14px; padding:14px; font-weight:600;">TO</span>
                            </div> 
                            <div style="width:13%;" class="col-md-2 col-sm-3 no_pad">
                                <input type="text" placeholder="(dd-mm-yyyy)" name="end_date" class="form-control pickdate" size="30" readonly>
                            </div> 
                            <input type="text" name="search" style="width:15%;" id="q" class="form-control" placeholder="search" size="30"/>
                            <button type="button" id="search" class="btn btn-info">Search</button>
                            <button type="button" id="clear_from" class="btn btn-primary">Clear</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </td>
                <td class="text-right wmd_30" style="width:25%">
                   <a href="{{ url ('/tankloryproduct/create') }}">
                        <button class="btn btn-success btn-xs"><i class="fa fa-plus"></i> New</button></a>
                    
                    <button type="button" class="btn btn-danger btn-xs" id="Del_btn" disabled><i class="fa fa-trash-o"></i> Delete</button>
                    <button class="btn btn-primary btn-xs" onclick="printDiv('print_area')"><i class="fa fa-print"></i> Print</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Show Agent List-->
{!! Form::open(['method' => 'POST',  'class' => 'search-form', 'id'=>'frmList','name'=>'frmList']) !!} 
<div id="print_area">
    <?php print_header("Head Information"); ?>
    <div id="ajax_content">
        <div class="table-responsive">
            <table class="table table-bordered tbl_thin" id="check">
                <tbody>
                    <tr class="bg_gray" id="r_checkAll">
                        <th class="text-center" style="width:5%;">SL#</th>
                        <th class="{{ show_hide() }} text-center">Date</th>
                        <th class="{{ show_hide() }} text-center">Branch Name</th>
                        <th class="{{ show_hide() }} text-center">Employee Name</th>
                        <th class="text-center">Tanklory Name</th>
                        <th class="text-center">Slip No</th>
                        <th class="text-center">Challan No</th>
                        <th class="text-center">Total Quantity</th>
                        <th class="text-center hip" style="width:20%;">Actions</th>
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
                    ?>   
                    <tr>
                        <td>{{ $counter }}</td>
                        <td class="{{ show_hide() }} text-center">{{ $data->delivery_date }}</td>
                        <td class="{{ show_hide() }} text-center">{{ $data->institute->name }}</td>
                        <td class="{{ show_hide() }} text-center">{{ $data->employee->employee_name }}</td>
                        <td class="{{ show_hide() }} text-center">{{ $data->tanklory->tank_lory_name }}</td>
                        <td class="text-center">{{ $data->order_no }}</td>
                        <td class="text-center">{{ $data->purchasechallan->challan_no}}</td>
                        <td class="text-right">{{ $data->total_quantity }}</td>
                            <td class="text-center hip">
                            <input type="hidden" class="reset_id" value="{{ $data->_key }}">
                            @if( $data->is_edible == 0 )
                                <a class="btn btn-danger btn-xs prosesse_id" id="prosesse_id"><i class="fa fa-edit"></i> Prossess</a>
                                <a class="btn btn-info btn-xs" href="tankloryproduct/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-success btn-xs" href="tankloryproduct/{{ $data->_key }}"><i class="fa fa-eye"></i> Veiw</a>
                            
                            @elseif( $data->is_edible == 1 )
                            <a class="btn btn-success btn-xs" href="tankloryproduct/{{ $data->_key }}"><i class="fa fa-eye"></i> Veiw</a>
                            <button type="button" class="btn btn-danger btn-xs reset_del"><i class="fa fa-arrow-left"></i> reset</button>
                            @endif
                            
                       </td>
                        <td class="text-center hip">
                                <input type="checkbox"  name="data[]" value="{{ $data->id }}">
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
        $("#search").click(function () {
            var _url = "{{ URL::to('tankloryproduct/search') }}";
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
            var _url = "{{ URL::to('tankloryproduct/delete') }}";
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
        $(".reset_del").click(function () {
            var id= $(this).closest('tr').find('.reset_id').val();
            var _rc = confirm("Are you sure about this action? This cannot be undone!");

            if (_rc == true) {

                 $.ajax({
                type:'get',
                url: "{{ URL::to('/tankloryproductreset') }}",
                data:{'id':id},
                //dataType:'json',
                success:function(data){ 
                    $('#ajaxMessage').showAjaxMessage({html: data.message, type: 'success'});
                    $("#search").trigger("click");
                },
                error:function(){
                    $('#ajaxMessage').showAjaxMessage({html: data.message, type: 'error'});
                }
            });
            }
        }); 
        $(".prosesse_id").click(function () {
            var id= $(this).closest('tr').find('.reset_id').val();
            var _rc = confirm("Are you sure about this action? This cannot be undone!");

            if (_rc == true) {

                 $.ajax({
                type:'get',
                url: "{{ URL::to('/tankloryproductprossess') }}",
                data:{'id':id},
                //dataType:'json',
                success:function(data){ 
                    $('#ajaxMessage').showAjaxMessage({html: data.message, type: 'success'});
                    $("#search").trigger("click");
                },
                error:function(){
                    $('#ajaxMessage').showAjaxMessage({html: data.message, type: 'error'});
                }
            });
            }

        });
    });

</script>
@endsection