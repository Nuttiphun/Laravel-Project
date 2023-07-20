@extends('layout.master')

@section('title') BikeShop | ตะกร้าสินค้า @endsection
@section('content')

<div class="container">
    <h1>ชําระเงิน</h1>

    {{-- {{ $cart_items }} --}}

    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
        <li><a href="{{ URL::to('cart/view') }}">สินค้าในตะกร้า</a></li>
        <li class="active">ชําระเงิน</li>
    </div>

    <div class="row">

        {{-- Left Content --}}
        <div class="col-md-6">
            
            <table class="table bs-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>รหัส</th>
                        <th>ชื่อสินค้า </th>
                        <th>จํานวน</th>
                        <th class="bs-price">
                            ราคา
                        </th>
                    </tr>
                </thead>
                <tbody class="cart_tbody disabled_input">
                    {{-- $sum_price = 0; 
                    $sum_qty = 0; --}}
                </tbody>
                <tfoot>
                    {{-- <tr> --}}
                        <th colspan="3">รวม</th>
                        <th class="cart_total_item">{{-- number_format($sum_qty, 0) --}}</th>
                        <th class="cart_total_price bs-price">{{-- number_format($sum_price, 0) --}}</th>
                    {{-- </tr> --}}
                </tfoot>
            </table>

        </div>
        

        {{-- Right content --}}
        <div class="col-md-6">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>ข้อมูลลูกค้า </strong>
                    </div>
                </div>
                <div class="panel-body">
                    
                    <form id="formCheckout" action="./finish" method="POST">
                        @csrf
                        <input name="jsonDataCart" type="hidden" class="jsonDataCart" />
                        <input name="cust_userid" type="hidden" 
                        id="cust_userid" value="{{Auth::user()->id}}" 
                        readonly hidden />

                        <div class="form-group">
                            <label>ชื่อ-นามสกุล</label>
                            <input name="cust_name" type="text" 
                            class="form-control" id="cust_name" 
                            value="{{Auth::user()->name}}" placeholder="ชื่อ-นามสกุล" />
                        </div>
                        <div class="form-group">
                            <label>อีเมล</label>
                            <input name="cust_email" type="text" 
                            class="form-control" id="cust_email" 
                            value="{{Auth::user()->email}}" placeholder="อีเมล์ของท่าน" />
                        </div>
                    </form>

                </div>
            </div>

        </div>
        
    </div>

    <a href="{{ URL::to('cart/view') }}" class="btn btn-default">ย้อนกลับ </a>
    <div class="pull-right">
        {{-- <a id="btnExportReport" href="#" class="btn btn-warning">พิมพ์ใบสั่งซื้อ</a> --}}
        <a id="btnFinish" href="#" class="btn btn-primary"><i class="fa fa-check"></i> จบการขาย</a>
    </div>

</div>

@endsection



<script>
    setTimeout(() => {
        
        document.querySelectorAll('.btnDelItemCart').forEach(item => {
            item.style.display = 'none';
        });
        // console.log(document.querySelector('#btnExportReport'))
        // document.querySelector('#btnExportReport').addEventListener('click', () => {

        //     let cust_name = document.querySelector('#cust_name').value;
        //     let cust_email = document.querySelector('#cust_email').value;

        //     if(cust_name == '' || cust_email == ''){
        //         alert('กรุณากรอกข้อมูลลูกค้า');
        //         return;
        //     }

        //     // window.open(`/cart/complete?cust_name=${cust_name}&cust_email=${cust_email}`, '_blank');
            
        //     let formCheckout = document.querySelector('#formCheckout');
        //     formCheckout.submit();
        // });

        document.querySelector('#btnFinish').addEventListener('click', () => {
            
            let cust_name = document.querySelector('#cust_name').value;
            let cust_email = document.querySelector('#cust_email').value;

            if(cust_name == '' || cust_email == ''){
                alert('กรุณากรอกข้อมูลลูกค้า');
                return;
            }

            let formCheckout = document.querySelector('#formCheckout');

            formCheckout.action = './finish'
            formCheckout.submit();

        });

    }, 1000);
</script>
