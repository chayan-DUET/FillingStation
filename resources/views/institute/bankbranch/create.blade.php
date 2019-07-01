@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Create New Branch</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i>Branch</span></li>
        </ul>                            
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Branch Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'url' => 'bankbranch', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <div class="form-group" style="width:95%;">
                <label for="InstituteList" class="col-md-2 control-label">Branch</label>
            @if( is_Admin() )
                <div class="col-md-4">
                    <select name="institute_id" id="InstituteList" class="form-control" required>
                        <option value="">Select Branch</option>
                        @foreach ($insList as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('institute_id') }}</small>
                </div>
            @endif
                <label for="bank" class="col-md-2 control-label">c Name</label>
                <div class="col-md-4">
                    <select id="bank" class="form-control" name="bank_id" required>
                        @if ( !is_Admin() )
                        <option value="">Select Branch</option>
                        @foreach($Banks as $Bank)
                        <option value="{{$Bank->id}}">{{$Bank->bank_name}}</option>
                        @endforeach
                        @else
                        <option value="">Select Bank</option>
                        @endif
                    </select>
                </div>
            </div> 
            <div class="form-group">
                
            </div>
            <div class="form-group">
                <table class="table table-bordered" style="width: 80%; margin: 0px auto;">
                    <tr>
                        <th>Branch Name</th>
                        <th style="width: 80px;"><button class="add_field_button form-control btn btn-success btn-sm" style="width: 80px;">Add More <i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                    </tr>
                    <tbody class="input_fields_wrap">
                    <tr>
                        <td> <input type="text" placeholder="Product Name" class="form-control" name="branch_name[]" required></td>
                
                        <td><button type="button" disabled="s" class="btn btn-danger btn-sm">remove <i class="fa fa-min" aria-hidden="true"></i></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-1">
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
                url: "{{ URL::to('bank/bank') }}",
                type: "post",
                data: {'institute': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#bank').html(data);
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
                $(wrapper).append('<tr><td><input type="text" placeholder="Product Name" class="form-control" name="branch_name[]" required></td><td><a href="#" class="remove_field btn btn-danger btn-sm">Remove</a></td></tr>'); //add input box
            }
        });
 $('body').delegate('.remove_field', 'click', function () {
        $(this).parent().parent().remove(); 
            //gt().remove();        
    });
        // $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        //     e.preventDefault();
        //     $(this).parent('tr').remove();
        //     x--;
        // })

    });

    $("#reset_from").click(function () {
        var _form = $("#frm_product");
        _form[0].reset();
    });

</script>
@endsection