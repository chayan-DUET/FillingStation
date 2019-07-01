@extends('admin.layouts.master')
@section('content')

<div id="breadcrumbBar" class="breadcrumb site_nav_links no_bdr_rad clearfix">
    <div class="col-md-3 col-sm-3 col-xs-2 cxs_2 no_pad">
        <button class="btn btn-info btn-xs" type="button" onclick="history.back()" title="Go Back"><span class="visible-xs"><i class="fa fa-arrow-left"></i></span><span class="hidden-xs">Back</span></button>
        <button class="btn btn-info btn-xs" onclick="redirectTo('/en/site/clear_cache')" title="Refresh" type="button"><span class="visible-xs"><i class="fa fa-refresh"></i></span><span class="hidden-xs">Refresh</span></button>
        <a href="{{ url('/purchaseorder') }}/{{ $data->_key }}/edit" class="btn btn-primary btn-xs">Edit</a>
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
<div class="user_information">
    <div class="row">
        <div class="col-md-8 col-sm-offset-2">
            <div class="panel panel-success">
                <!-- Default panel contents -->
                <div class="panel-heading text-center"><h4>Purchase Order Information</h4></div>
                <!-- Table -->
                <table class="table table-bordered" style="margin-bottom: 20px;">
                <thead>
                    <tr>
                <th class="text-center" colspan="6"><h3>Branch Name: {{$data->institute->name}}</h3></th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <th>Company Name:</th>
                            <td>{{$data->company->company_name}} </td>
                            <th>Supplier Name: </th>
                            <td>{{$data->supplier->supplier_name}}</td>
                            <th> Employee Name: </th>
                            <td>{{$data->employee->employee_name}}</td>
                        </tr>
                        <tr>
                            <th>Order No:</th>
                            <td>{{$data->order_no}} </td>
                            <th>Pay type </th>
                            <td>
                            @if($data->pay_type== 1)
                                Cash
                                @elseif($data->pay_type== 2)
                                Bank
                                @else
                                Due
                                @endif
                            </td>
                            <th> Date </th>
                            <td>{{$data->request_date}}</td>
                        </tr>
                </tbody>
                </table>
            <table class="table table-bordered table-striped" style="margin-bottom:20px;">
                    <tr>
                        <th class="text-center">Category</th>
                        <th class="text-center">Product</th>
                        <th class="text-center">Payorder NO</th>
                        <th class="text-center">Bank Description</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Amount</th>
                    </tr>
                    <tbody>
                        @foreach($itemdata as $item)
                        <tr>
                            <td class="text-center">{{$item->category->category_name}}</td>
                            <td class="text-center">{{$item->product->product_name}}</td>
                            <td class="text-center">{{$item->payorder_no}}</td>
                            <td class="text-center">{{$item->bank_description}}</td>
                            <td class="text-right">{{$item->order_quantity}}</td>
                            <td class="text-right">{{$item->order_amount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</div>
@endsection