@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('/en/site/clear_cache')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
        <a href="{{ url('/purchasechallan') }}/{{ $data->_key }}/edit" class="btn btn-primary btn-xs">Edit</a>
        <button class="btn btn-primary btn-xs" onclick="printDiv('print_area')"><i class="fa fa-print"></i> Print</button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 cxs_10 text-center">
        <h2 class="page-title"></h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 cxs_12 no_pad">
        <ul class="text-right no_mrgn">
            <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> <span class="divider">/</span></li><li><span><i class="fa fa-file"></i> Purchase Order</span></li>
        </ul>                            
    </div>
</div>
    

    <div id="print_area">
<div class="user_information" style=" height: 100%;  width: 800px;margin: 0px auto">
    <div class="row">
        <h3 class="text-center">{{$data->institute->name}}</h3>
        <h5 class="text-center">Address: {{$data->institute->address}}, Mobile: {{$data->institute->mobile}}, Email: {{$data->institute->email}}</h5>
        <h3 class="text-center" style="background: lightgreen ; width:100px; margin: 0px auto">Invoice</h3>
       
    </div>
    <div style="width: 900px;margin: 0px auto">

        <div class="col-md-4" style="width: 300px;float: right;">
                <!-- Default panel contents -->
                <h4 style="background: gray;width: 170px; color: #fff;padding: 5px;">Order Information</h4>
                <h5><span>Order No: </span> {{$data->purchaseorder->order_no}}</h5>
                <h5><span>Order Date: </span> {{date_dmy($data->purchaseorder->request_date)}}</h5>
                <h5><span>Supplier Name: </span> {{$data->supplier->supplier_name}}</h5>
            </div>
            <div class="col-md-3" style="width: 300px;">
                <!-- Default panel contents -->
                <h4 style="background: gray;width: 180px; color: #fff;padding: 5px;">Challan Information</h4>
                <!-- Table -->
                 <h5><span>Challan No: </span> {{$data->challan_no}}</h5>
                <h5><span>Challan Date:  </span> {{date_dmy($data->pay_date)}}</h5>
                <h5><span>Delar Name: </span> {{$data->company->company_name}}</h5>
                <h5><span>Product:  </span> {{$data->product->product_name}}</h5>
                
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                <h2 class="text-center"><small style="background: gray;width: 200px; color: #fff;padding: 5px;">Purchase Details</small></h2>
                    <table class="table table-bordered">
                        <tr>
                            <thead>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Pay Order No</th>
                                <th>Order Quantity (L)</th>
                                <th>Order Amount (TK)</th>
                                <th>Per Amount</th>
                                <th>Quantity (L)</th>
                                <th>Amount (TK)</th>
                            </thead>
                        </tr>
                        <tr>
                            <td>{{$data->category->category_name}}</td>
                            <td>{{$data->product->product_name}}</td>
                            <td>{{$itemdata->payorder_no}}</td>
                            <td>{{$itemdata->order_quantity}}</td>
                            <td>{{$itemdata->order_amount}}</td>
                            <td>{{$data->per_liter_amount}}</td>
                            <td>{{$data->quantity}}</td>
                            <td>{{$data->amount}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" style="border: none;">
                        <tr>
                            <thead>
                                <th>Suplly Chain Name</th>
                                <th>By Whom</th>
                                <th>Vehicle Type</th>
                                <th>Vehicle No</th>
                                <th>Driver Name</th>
                            </thead>
                        </tr>
                        <tr>
                            <td>{{$data->employee->employee_name}}</td>
                            <td>{{$data->by_whom}}</td>
                            <td>{{$data->vehicle_type}}</td>
                            <td>{{$data->vehicle_no}}</td>
                            <td>{{$data->driver_name}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="width: 850px;">
                <div style="width: 350px; float: left;">
                    <h4><small>Supply Chain Sign</small></h4>
                </div>
                <div style="width: 250px; float: left;">
                    <h4><small>Manager Sign</small></h4>
                </div>
                <div style="width: 150px;float: right;">
                    <h4><small>Diractor Sign</small></h4>
                </div>
            </div>
         
    </div>
</div>

@endsection