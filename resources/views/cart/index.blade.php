@extends('layout.master')

@section('title') BikeShop | ตะกร้าสินค้า @endsection

@section('tag_head')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@endsection

@section('content')

<div class="container" ng-app="app" ng-controller="controller">
    <h1>สินค้าในตะกร้า</h1>
    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
        <li class="active">สินค้าในตะกร้า</li>
    </div>

    {{-- @if(count($cart_items)) --}}

    <div class="panel panel-default">
        <table class="table bs-table">
            <thead>
                <tr class="bg-second">
                    <th>รูปสินค้า </th>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า </th>
                    <th>จํานวน</th>
                    <th>ราคา</th>
                    <th width="50px"></th>
                </tr>
            </thead>
            <tbody class="cart_tbody">
                {{-- @foreach($cart_items as $item) --}}
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">รวม</th>
                    <th class="cart_total_item">{{-- number_format($sum_qty, 0) --}}</th>
                    <th class="cart_total_price" style="transform: scale(1,1)">{{-- number_format($sum_price, 0) --}}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{-- <div class="panel-body"><strong>ไม่พบรายการสินค้า !</strong></div> --}}
        <!-- buttons -->
        <a href="{{ URL::to('/home') }}" class="btn btn-default">
            ย้อนกลับ
        </a>

        <div class="pull-right">
            <a href="{{ URL::to('cart/checkout') }}" class="btn btn-primary">
                ชําระเงิน 
                <i class="fa fa-chevron-right"></i>
            </a>
        </div>

    </div>

</div>


@endsection