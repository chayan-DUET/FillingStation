@extends('admin.layouts.master')
@section('content')
<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Users List</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> User</span></li>
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
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100" selected="selected">100</option>                         
                            </select>
                            <div class="col-md-2 col-sm-3 no_pad">
                                <select id="sortBy" class="form-control" name="sort_by">
                                    <option value="customer_name">Sort By</option>
                                    <option value="customer_name" style="text-transform:capitalize">User Name</option>
                                    <option value="customer_father" style="text-transform:capitalize">Email</option>                        
                                    <option value="customer_father" style="text-transform:capitalize">Mobile</option>                              
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-3 no_pad">
                                <select id="sortType" class="form-control" name="sort_type">
                                    <option value="ASC">Ascending</option>
                                    <option value="DESC">Descending</option>
                                </select>
                            </div>
                            <input type="text" name="search" id="q" class="form-control" placeholder="search name or email" size="30"/>
                            <button type="button" id="search" class="btn btn-info">Search</button>
                            <button type="button" id="clear_from" class="btn btn-primary" data-info="/agent">Clear</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </td>
                <td class="text-right wmd_30" style="">
                    <a href="{{ url ('/register') }}"><button class="btn btn-success btn-xs"><i class="fa fa-plus"></i> New</button></a>
                    <?php if (has_user_access('user_delete')) : ?>
                        <button type="button" class="btn btn-danger btn-xs" id="Del_btn" disabled><i class="fa fa-trash-o"></i> Delete</button>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Show Users List-->
{!! Form::open(['method' => 'POST',  'class' => 'search-form', 'id'=>'frmList','name'=>'frmList']) !!} 
<div id="ajax_content"> 
    <div class="table-responsive">
        <table class="table table-bordered" id="check">
            <tbody>
                <tr>
                    <th class="text-center" style="width:5%;">SL#</th>
                    <th class="{{ show_hide() }} ">Branch Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Loggedin</th>
                    <th class="text-center">Actions</th>
                    <th class="text-center">
                        <?php if (has_user_access('user_delete')) : ?>
                            <div class="checkbox">
                                <label><input type="checkbox" id="check_all"value="all"></label>
                            </div>
                        <?php endif; ?>
                    </th>
                </tr>
                <?php $sl = 1; ?>
                @foreach ($dataset as $data)
                <tr>
                    <td class="text-center" style="width:5%;">{{ $sl }}</td>
                    <td class="{{ show_hide() }} ">{{ $data->institute->name }}</td>  
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <?php if ($data->status == 0) : ?>
                        <?php if (has_user_access('user_status')) : ?>
                            <td class="text-center" ><span title="Activate User" onclick="make_user_active(<?= $data->id ?>)" class="btn btn-warning btn-xs">Inactive</span></td> 
                        <?php else : ?>
                            <td class="text-center" ><span class="label label-warning label-xs">Inactive</span></td>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (has_user_access('user_status')) : ?>
                            <td class="text-center" ><span title="Deactivate User" onclick="make_user_inactive(<?= $data->id ?>)" class="btn btn-success btn-xs">Active</span></td>
                        <?php else : ?>
                            <td class="text-center" ><span class="label label-success label-xs">Active</span></td>
                        <?php endif; ?>
                    <?php endif; ?>
                    <td class="text-center"> <?php
                        if ($data->is_loggedin == 1) {
                            echo "Yes";
                        } else {
                            echo "No";
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-info btn-xs" href="user/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-primary btn-xs" href="user/{{ $data->_key }}"><i class="fa fa-eye"></i> View</a>
                        <a class="btn btn-warning btn-xs" href="user/{{ $data->_key }}/access"><i class="fa fa-fw fa-wrench"></i> Access Control</a>
                    </td>
                    <?php if (has_user_access('user_delete')) : ?>
                        <td class="text-center">
                            <div class="checkbox">
                                <label><input type="checkbox" name="data[]" value="{{ $data->id }}"></label>
                            </div>
                        </td>
                        <?php
                    endif;
                    $sl++;
                    ?>
                </tr>          
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">

    $(document).ready(function () {

        //     $("#search").click(function(){
        //        var _url="{{ URL::to('get-customer-list') }}";
        //        var _form=$("#frmSearch");

        //     $.ajax({
        //       url: _url, //Full path of your action
        //      // alert (url);
        //       type: "post",   
        //       data: _form.serialize(),
        //       success: function(data){
        //         $('#ajax_content').html(data);
        //       },
        //       error: function (xhr, status) {              
        //             alert('There is some error.Try after some time.'); 
        //           }
        //     });


        //     })
        // });



        $("#Del_btn").click(function () {
            var _url = "{{ URL::to('delete-users') }}";
            var _form = $("#frmList");
            var _rc = confirm("Are you sure about this action? This cannot be undone!");
            if (_rc == true) {

                $.post(_url, _form.serialize(), function (data) {
                    if (data.success === true) {
                        $('#ajaxMessage').removeClass('alert-danger').addClass('alert-success').show().show();
                        $('#ajaxMessage').html(data.message);
                    } else {
                        $('#ajaxMessage').removeClass('alert-success').addClass('alert-danger').show();
                        $('#ajaxMessage').html(data.message);
                    }
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                }, "json");
            }

        })



    });
    function make_user_active(id) {
        var _url = "{{ URL::to('user-active') }}/" + id;
        var _rc = confirm("Are you sure about this action? This cannot be undone!");
        if (_rc == true) {

            $.get(_url, function (data) {
                if (data.success === true) {
                    $('#ajaxMessage').removeClass('alert-danger').addClass('alert-success').show().show();
                    $('#ajaxMessage').html(data.message);
                } else {
                    $('#ajaxMessage').removeClass('alert-success').addClass('alert-danger').show();
                    $('#ajaxMessage').html(data.message);
                }
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }, "json");
        }
    }

    function make_user_inactive(id) {
        var _url = "{{ URL::to('user-inactive') }}/" + id;
        var _rc = confirm("Are you sure about this action? This cannot be undone!");
        if (_rc == true) {

            $.get(_url, function (data) {
                if (data.success === true) {
                    $('#ajaxMessage').removeClass('alert-danger').addClass('alert-success').show().show();
                    $('#ajaxMessage').html(data.message);
                } else {
                    $('#ajaxMessage').removeClass('alert-success').addClass('alert-danger').show();
                    $('#ajaxMessage').html(data.message);
                }
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }, "json");
        }
    }


</script>


@endsection