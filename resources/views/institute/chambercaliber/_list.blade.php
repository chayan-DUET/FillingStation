<?php if (!empty($dataset) && count($dataset) > 0) : ?>
   <div class="table-responsive">
            <table class="table table-bordered tbl_thin" id="check">
                <tbody>
                    <tr class="bg_gray" id="r_checkAll">
                        <th class="text-center" style="width:5%;">SL#</th>
                        <th class="{{ show_hide() }} text-center">Branch Name</th>
                        <th class="{{ show_hide() }} text-center">Tanklory Name</th>
                        <th class="text-center">Chamber Name</th>
                        <th class="text-center">MM</th>
                        <th class="text-center">Liter</th>
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
                        <td class="{{ show_hide() }} ">{{ $data->tanklory->tank_lory_name }}</td>
                        <td>{{ $data->chamber->chamber_name }}</td>
                        <td>{{ $data->mm }}</td>
                        <td>{{ $data->liter }}</td>
                        <td class="text-center hip">
                            <a class="btn btn-info btn-xs" href="chamber/{{ $data->_key }}/edit"><i class="fa fa-edit"></i> Edit</a>
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