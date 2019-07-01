<?php if (!empty($dataset)): ?>
  <div class="table-responsive">
            <table class="table table-bordered tbl_thin" id="check">
                <tbody>
                    <tr class="bg_gray" id="r_checkAll">
                        <th class="text-center" style="width:5%;">SL#</th>
                        <th class="{{ show_hide() }} text-center">Date</th>
                        <th class="{{ show_hide() }} text-center">Branch Name</th>
                        <th class="{{ show_hide() }} text-center">Company Name</th>
                        <th class="text-center">Supplier Name</th>
                        <th class="text-center">Order No</th>
                        <th class="text-center">Pay Type</th>
                        <th class="text-center">Total Quantity</th>
                        <th class="text-center">Grand Total</th>
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
                        <td class="{{ show_hide() }} ">{{ $data->request_date }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->institute->name }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->company->company_name }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->supplier->supplier_name }}</td>
                        <td>{{ $data->order_no }}</td>
                        <td>{{ $data->pay_type }}</td>
                        <td>{{ $data->total_quantity }}</td>
                        <td>{{ $data->grand_total }}</td>
                            <td class="text-center hip">
                            <input type="hidden" class="reset_id" value="{{ $data->_key }}">
                            @if( $data->is_edible == 0 )
                                <a class="btn btn-danger btn-xs prosesse_id" id="prosesse_id"><i class="fa fa-edit"></i> Prossess</a>
                                <a class="btn btn-info btn-xs" href="purchaseorder/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-success btn-xs" href="purchaseorder/{{ $data->_key }}"><i class="fa fa-eye"></i> Veiw</a>
                            
                            @elseif( $data->is_edible == 1 )
                            <a class="btn btn-success btn-xs" href="purchaseorder/{{ $data->_key }}"><i class="fa fa-eye"></i> Veiw</a>
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
<?php else: ?>
    <div class="alert alert-info">No records found!</div>
<?php endif; ?>
<script type="text/javascript">
    $(".reset_del").click(function () {
            var id= $(this).closest('tr').find('.reset_id').val();
            var _rc = confirm("Are you sure about this action? This cannot be undone!");

            if (_rc == true) {

                 $.ajax({
                type:'get',
                url: "{{ URL::to('/purchasereset') }}",
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
                url: "{{ URL::to('/purchaseprossess') }}",
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
</script>