<?php if (!empty($dataset) && count($dataset) > 0) : ?>
  <div class="table-responsive">
            <table class="table table-bordered tbl_thin" id="check">
                <tbody>
                    <tr class="bg_gray" id="r_checkAll">
                        <th class="text-center" style="width:5%;">SL#</th>
                        <th class="{{ show_hide() }} text-center">Date</th>
                        <th class="{{ show_hide() }} text-center">Branch Name</th>
                        <th class="{{ show_hide() }} text-center">Category Name</th>
                        <th class="{{ show_hide() }} text-center">Order No</th>
                        <th class="text-center">Prodcut Name</th>
                        <th class="text-center">Payorder No</th>
                        <th class="text-center">Bank Description</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Amount</th>
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
                        <td class="{{ show_hide() }} ">{{ $data->category->category_name }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->purchaseorder->order_no }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->product->product_name }}</td>
                        <td>{{ $data->payorder_no }}</td>
                        <td>{{ $data->bank_description }}</td>
                        <td>{{ $data->order_quantity }}</td>
                        <td>{{ $data->order_amount }}</td>
                        <td class="text-center hip">@if( $data->is_edible == 0 )
                                <input type="checkbox" name="data[]" value="{{ $data->id }}">
                                @endif
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