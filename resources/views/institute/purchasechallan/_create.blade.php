
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading"><h4 class="panel-title text-center">Product Challan Information</h4></div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'url' => 'purchasechallan', 'id' => 'frm_product'  , 'class' => 'form-horizontal']) !!} 
            {{ csrf_field() }}
            <input type="hidden" value="{{$Purchaseitem->purchase_order_id }}" name="purchase_order_id"><input type="hidden" value="{{$Purchaseitem->institute_id }}" name="institute_id">
            <input type="hidden" value="{{$Purchaseitem->company_id }}" name="company_id">
            <input type="hidden" value="{{$Purchaseitem->supplier_id }}" name="supplier_id">
            <input type="hidden" value="{{$Purchaseitem->payorder_no }}" name="pay_order_no">
            <div class="form-group" >
                <div class="col-md-4">
                <label for="company">Challan No</label>
                    <input type="text" class="form-control" name="challan_no" required>
                </div>
                <div class="col-md-4">
                <label for="supplier">Date</label>
                     <input type="text" placeholder="(dd-mm-yyyy)" class="form-control pickdate" size="30" name="pay_date" required>
                </div>
                <div class="col-md-4">
                <label for="company">Supply Chain Name</label>
                    <select class="form-control" name="employee_id" required>
                        <option value="">Select Supply Chain</option>
                        @foreach($employees as $Employee)
                        <option value="{{$Employee->id}}">{{$Employee->employee_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
            <div class="form-group" >
                <div class="col-md-3">
                <label for="InstituteList">By Whom</label>
                    <input type="text" class="form-control" name="by_whom" required>
                </div>
                <div class="col-md-3">
                <label for="category">Vehicle Type</label>
                     <input type="text" class="form-control" name="vehicle_type" required>
                </div>
                <div class="col-md-3">
                <label for="category">Vehicle No</label>
                <input type="text" class="form-control" name="vehicle_no" required>
                </div>
                <div class="col-md-3">
                <label for="category">Driver Name</label>
                <input type="text" class="form-control" name="driver_name" required>
                </div>
            </div> 
            <div class="form-group">
            </div>
            <div class="form-group">
                <table class="table table-bordered" id="tableID" >
                    <tr>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Order Quantity</th>
                        <th>Order Amount</th>
                        <th>Per Liter Amount</th>
                        <th>Challan Quantity</th>
                        <th>Challan Amount</th>
                    </tr>
                    <tbody class="input_fields_wrap">
                       
                    <tr>
                        <td> 
                        <select id="categorylist" class="form-control categorylist" required name="category_id">
                       <option value="">Select Category</option>                  
                        @foreach($categorys as $cs)
                        <?php $sel = ($cs->id == $Purchaseitem->category_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$cs->id}}" {{$sel}}>{{$cs->category_name }}</option>
                        @endforeach
                        
                        </select>
                        </td> 
                        <td> 
                        <select id="product" name="product_id" class="form-control" required>
                        <option value="">Select Product</option>
                        @foreach($products as $cs)
                        <?php $sel = ($cs->id == $Purchaseitem->product_id) ? 'selected="selected"' : ''; ?>
                        <option value="{{$cs->id}}" {{$sel}}>{{$cs->product_name }}</option>
                        @endforeach
                        </select>
                        </td>

                    <td>
                        <input type="number" value="{{$Purchaseitem->order_quantity}}" class="form-control" readonly="">
                    </td>
                    <td>
                        <input type="number" class="form-control"  value="{{$Purchaseitem->order_amount}}" readonly="">
                    </td>
                    <td>
                        <input type="number" class="form-control per_liter" name="per_liter_amount">
                    </td>
                    <td>
                        <input type="number" value="{{$Purchaseitem->order_quantity}}" class="form-control quantity" name="quantity">
                    </td>
                    <td>
                        <input type="number" value="{{$Purchaseitem->order_amount}}" class="form-control amount" name="amount" readonly="">
                    </td>
                    </tr>
                    
                    
                    </tbody>
                  
                </table>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    <input type="submit" class="btn btn-primary" name="btnSave" value="Save">
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!} 


<script type="text/javascript">

    $('.pickdate').datepicker({
        format: 'dd-mm-yyyy',
        //startDate: '-3d'
        autoclose: true,
        orientation: 'bottom',
    });

    $("#reset_from").click(function () {
        var _form = $("#frm_product");
        _form[0].reset();
    });
 $(document).ready(function(){

  $(document).on('keyup','.quantity',function(){
                var tq=0; 
                var $row = $(this).closest("tr"); 
                var amount=$(this).val();
                var qty=$(this).closest('tr').find('.per_liter').val();
                if(!qty){
                    qty=0;
                }
                tq=amount*qty;
                
              $row.find(".amount").val(tq.toFixed(2));
             
totalamount();
totalqunatity();

});

  $(document).on("change", "#categorylist", function () {
            var id = $(this).val();
            $.ajax({
                url: "{{ URL::to('product/product') }}",
                type: "post",
                data: {'category': id, '_token': '{{ csrf_token() }}'},
                success: function (data) {
                    //enable("#subhead");
                    $('#product').html(data);
                },
                error: function (xhr, status) {
                    alert('There is some error.Try after some time.');
                }
            });
        });


    });


    function totalamount(){
                
          
    }

    function totalamount(){ 
            var tpa=0;
            $('#tableID .quantity').each(function(i,e){
                var tpaq=$(this).val();
                var tpal=$('.per_liter').val();
                if(!tpaq){
                    tpaq=0;
                }
                tpa+=tpaq*tpal;
            });
            $('.totalamount').val(tpa.toFixed(2));
          
    }
    function totalqunatity(){ 
            var tpq=0;
            $('#tableID .quantity').each(function(i,e){
                var b=$(this).val();
                if(!b){
                    b=0;
                }
                tpq+=parseFloat(b);
            });
            $('.totalquantity').val(tpq.toFixed(2));
          
    } 
    

</script>
