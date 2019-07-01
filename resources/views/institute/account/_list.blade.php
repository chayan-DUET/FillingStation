<?php if (!empty($dataset) && count($dataset) > 0) : ?>
    <div class="table-responsive">
            <table class="table table-bordered tbl_thin" id="check">
                <tbody>
                    <tr class="bg_gray" id="r_checkAll">
                        <th class="text-center" style="width:5%;">SL#</th>
                        <th class="{{ show_hide() }} text-center">Bank Name</th>
                        <th class="{{ show_hide() }} text-center">Branch Name</th>
                        <th class="{{ show_hide() }} text-center">Acconut Name</th>
                        <th class="{{ show_hide() }} text-center">Account No</th>
                        <th class="{{ show_hide() }} text-center">Account Type</th>
                        <th class="text-center">Deep Name</th>
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
                    ?>   
                    <tr>
                        <td>{{ $counter }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->institute->name }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->bank->bank_name }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->category->branch_name }}</td>
                        <td class="{{ show_hide() }} ">{{ $data->product->account_name }}</td>
                        <td>{{ $data->account_no }}</td>
                        <td>{{ $data->account_type }}</td>
                        <td class="text-center hip">
                            <a class="btn btn-info btn-xs" href="account/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-success btn-xs" href="deep/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> view</a>
                        </td>
                        <td class="text-center hip"><input type="checkbox" name="data[]" value="{{ $data->id }}"></td>
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