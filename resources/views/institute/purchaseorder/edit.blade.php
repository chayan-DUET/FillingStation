@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('<?= url('view-clear') ?>')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title">Update Product </h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Product</span></li>
        </ul>                            
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Product Order Information</div>
        <div class="panel-body">
            {!! Form::open(['method' => 'PUT', 'url' => 'purchaseorder/'.$data->id, 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <div class="form-group" >
            <input type="hidden" value="{{$data->institute_id}}" name="institute_id">
            <input type="hidden" value="{{$data->id}}">
                <div class="col-md-4">
                <label for="company">Company Name</label>
                    <select id="company" class="form-control" name="company_id" required>
                        <option value="">Select Company</option>
                        @foreach($companys as $Company)
                        <?php $sel = ($Company->id == $data->company_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$Company->id}}" {{$sel}}>{{$Company->company_name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-md-4">
                <label for="supplier">Supplier Name</label>
                    <select id="supplier" class="form-control" name="supplier_id" required>
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                        <?php $sel = ($supplier->id == $data->supplier_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$supplier->id}}" {{$sel}}>{{$supplier->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                <label for="company">Employee Name</label>
                    <select class="form-control" name="employee_id" required>
                        <option value="">Select Company</option>
                        @foreach($employees as $Employee)
                        <?php $sel = ($Employee->id == $data->employee_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$Employee->id}}" {{$sel}}>{{$Employee->employee_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
            <div class="form-group" >
            
                <div class="col-md-4">
                <label for="InstituteList">Order No.</label>
                    <input type="text" class="form-control" value="{{$data->order_no}}" name="order_no" required>
                </div>
           
                <div class="col-md-4">
                <label for="category">Pay type</label>
                    <select id="category" class="form-control" name="pay_type" required>
                        <option value="">Select Pay type</option>
                        <option <?php ($data->pay_type == '1') ? 'selected="selected"' : ''; ?> value="1" >Cash</option>
                        <option <?php ($data->pay_type == '2') ? 'selected="selected"' : ''; ?> value="2" >Bank</option>
                        <option <?php ($data->pay_type == '3') ? 'selected="selected"' : ''; ?> value="3" >due</option>
                    </select>
                </div>
                <div class="col-md-4">
                <label for="category">Date</label>
                <input type="text" class="form-control pickdate" value="{{$data->request_date}}" name="request_date" required>
                  
                </div>
            </div> 
            <div class="form-group">
            </div>
            <div class="form-group">
                <table class="table table-bordered" id="tableID" >
                    <tr>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Payorder NO</th>
                        <th>Bank Description</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th style="width: 80px;"><button class="add_field_button form-control btn btn-success btn-sm" style="width: 80px;">Add More <i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                    </tr>
                    <tbody class="input_fields_wrap">
                        @foreach($itemdata as $itemdatas)
                    <tr>
                        <td> 
                        <select name="category_id[]" id="categorylist" class="form-control categorylist" required>
                            
                        <option value="">Select Category</option>
                        @foreach($categorys as $Category)
                        <?php $sel = ($Category->id == $itemdatas->category_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$Category->id}}" {{$sel}}>{{$Category->category_name}}</option>
                        @endforeach
                        </select>
                        </td>
                        <td> 
                        <select name="product_id[]" id="product" class="form-control product" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                        <?php $sel = ($product->id == $itemdatas->product_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$product->id}}" {{$sel}}>{{$product->product_name}}</option>
                        @endforeach
                        </select>
                        </td>
                    
                    <td>
                        <input type="text" class="form-control" value="{{$itemdatas->payorder_no}}" name="payorder_no[]" required>
                    </td>
                    <td>
                        <textarea class="form-control" name="bank_description[]">{{$itemdatas->bank_description}}</textarea>
                    </td>
                    <td>
                        <input type="number" value="{{$itemdatas->order_quantity}}" class="form-control quantity" name="order_quantity[]" required>
                    </td>
                    <td>
                        <input type="text" value="{{$itemdatas->order_amount}}" class="form-control amount" name="order_amount[]" required>
                    </td>
                        <td><a href="#" class="remove_field btn btn-danger btn-sm">Remove</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tr>
                        <td colspan="4"></td>
                        <td><input type="number" placeholder="Total quantity" id="total_quantity" class="form-control" value="{{$data->total_quantity}}" readonly="" name="total_quantity"></td>
                        <td><input type="text" placeholder="Total Amount" id="total_amount" class="form-control" value="{{$data->grand_total}}" readonly="" name="grand_total"></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <div class="col-md-8">
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

 $(document).on("change", "#categorylist", function () {
           var $row = $(this).closest("tr"); 
            var id= $(this).closest('tr').find('.categorylist').val();
            $.ajax({
                url: "{{ URL::to('product/product') }}",
                type: "post",
                data: {'category': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $row.find('.product').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });


        $(document).on("change", "#company", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('supplier/supplier') }}",
                type: "post",
                data: {'supplier': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#supplier').html(data);
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
                $(wrapper).append('<tr><td><select name="category_id[]" id="categorylist" class="form-control categorylist" required><option value="">Select Category</option>@foreach($categorys as $Category)<option value="{{$Category->id}}">{{$Category->category_name}}</option> @endforeach</select></td><td> <select name="product_id[]" id="product" class="form-control product" required><option value="">Select Product</option> </select></td><td><input type="text" class="form-control" name="payorder_no[]" required></td><td><textarea class="form-control" name="bank_description[]"></textarea></td><td><input type="number" class="form-control quantity" name="order_quantity[]" required></td><td><input type="text" class="form-control amount" name="order_amount[]" required></td><td><a href="#" class="remove_field btn btn-danger btn-sm">Remove</a></td>'+'</tr>');
                     //add input box
            }
            $("#InstituteList").trigger("click");
        });
 $('body').delegate('.remove_field', 'click', function () {
        $(this).parent().parent().remove(); 
        totalqunatity();
        totalamount();
            //gt().remove();        
    });
      
    });

    $("#reset_from").click(function () {
        var _form = $("#frm_product");
        _form[0].reset();
    });
 $(document).ready(function(){

  $(document).on('keyup','.quantity',function(){
totalqunatity();

});
  $(document).on('keyup','.amount',function(){
totalamount();
});
});

    function totalqunatity(){ 
            var tpd=0;
            $('#tableID .quantity').each(function(i,e){
                var b=$(this).val();
                if(!b){
                    b=0;
                }
                tpd+=parseFloat(b);
            });
            $('#total_quantity').val(tpd.toFixed(2));
          
    } 
    function totalamount(){ 
            var tpd=0;
            $('#tableID .amount').each(function(i,e){
                var b=$(this).val();
                if(!b){
                    b=0;
                }
                tpd+=parseFloat(b);
            });
            $('#total_amount').val(tpd.toFixed(2));
          
    }

</script>

@endsection