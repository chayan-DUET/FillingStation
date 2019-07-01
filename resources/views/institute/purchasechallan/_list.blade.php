<?php if (!empty($dataset) && count($dataset) > 0) : ?>
    <div class="table-responsive">
            <table class="table table-bordered tbl_thin" id="check">
                <tbody>
                    <tr class="bg_gray" id="r_checkAll">
                        <th class="text-center" style="width:5%;">SL#</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Challan No</th>
                        <th class="text-center">Branch Name</th>
                        <th class=" text-center">Company Name</th>
                        <th class="text-center">Pay Order No</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Amount</th>
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
                    @if($data->status==0)   
                    <tr>
                        <td>{{ $counter }}</td>
                        <td>{{ $data->pay_date }}</td>
                        <td>{{ $data->challan_no }}</td>
                        <td>{{ $data->institute->name }}</td>
                        <td>{{ $data->company->company_name }}</td>
                        <td>{{ $data->pay_order_no }}</td>
                        <td>{{ $data->category->category_name }}</td>
                        <td>{{ $data->product->product_name }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ $data->amount }}</td>
                            <td class="text-center hip">
                                <input type="hidden" class="reset_id" value="{{ $data->_key }}">
                                @if( $data->is_edible == 0 )
                                <a class="btn btn-danger btn-xs prosesse_id" id="prosesse_id"><i class="fa fa-edit"></i> Prossess</a>
                                <a class="btn btn-info btn-xs" href="purchasechallan/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-primary btn-xs" href="purchasechallan/{{ $data->_key }}"><i class="fa fa-edit"></i> Challan</a>
                                @elseif( $data->is_edible == 1 )
                                <a class="btn btn-primary btn-xs" href="purchasechallan/{{ $data->_key }}"><i class="fa fa-edit"></i> Challan</a>
                                <button type="button" class="btn btn-danger btn-xs reset_del"><i class="fa fa-arrow-left"></i> reset</button>
                                @endif
                            </td>
                        <td class="text-center hip">
                                <input type="checkbox" name="data[]" value="{{ $data->id }}">
                               
                            </td>
                    </tr>
                    @endif
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
    $(document).ready(function () {
        $(".reset_del").click(function () {
            var id= $(this).closest('tr').find('.reset_id').val();
            var _rc = confirm("Are you sure about this action? This cannot be undone!");

            if (_rc == true) {

                 $.ajax({
                type:'get',
                url: "{{ URL::to('/challanreset') }}",
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
                url: "{{ URL::to('/challanprossess') }}",
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