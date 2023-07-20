@extends('layout.master')

@section('title')    Title: Home    @endsection

@section('tag_head')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@endsection

@section('content')
    
    <div class="container" ng-app="app" ng-controller="controller">

        
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item"
                        ng-class="{'active': category_onSelect == null}" ng-click="getProductList(null)"
                    >
                        ทั้งหมด
                    </a>
                    <a href="#" class="list-group-item" ng-repeat="item in data_category"
                        ng-click="getProductList(item)" ng-class="{'active': category_onSelect.id == item.id}"
                    >
                        @{item.name}
                    </a>
                </div>
            </div>

            
            <div class="col-md-9">
                <div style="width: 100%; display: flex; justify-content: flex-end;">
                    <input 
                        type="text" class="form-control" ng-model="query"
                        ng-keyup="searchProduct($event)" style="width:190px" placeholder="พิมพ์ชื่อสินค้าเพื่อค้นหา"
                    >
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3" ng-if="data_products.length === 0" style="width: 100%;text-align: center; margin-top: 40px;">
                        <h4>- ไม่มีข้อมูลสินค้า -</h3>
                    </div>
                    <div class="col-md-3" ng-repeat="item in data_products">
                        <!-- product card -->
                        <div class="panel panel-default bs-product-card">
                            <div class="panel-body">
                                <img 
                                    src="@{ item.image_url || 'upload/images/no-img.jpg' }" 
                                    class="img-responsive"
                                    style="width: 100%; object-fit: cover; height: 120px;"
                                />
                                <br>
                                <h4><a href="#">@{ item.name }</a></h4>
                                
                                <div class="form-group">
                                    <div>คงเหลือ: @{ item.stock_qty }</div>
                                    <div>ราคา <strong>@{ item.price }</strong> บาท</div>
                                </div>
                                
                                <input class="valueItem" type="hidden" value="@{ getJSON(item) }">
                                
                                @guest
                                    <a href="#" 
                                        style="
                                            position: flex;
                                            cursor: not-allowed
                                        "
                                        class="btn btn-success btn-block btnKeepItemToCart">
                                        <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า
                                        <p class="msgNotAllowedKeepItemToCart" style="
                                            display: none;
                                            position: absolute;
                                            top: 28px;
                                            left: 0px;
                                            color: white;
                                            background: #222;
                                            padding: 6px 12px;
                                            border-radius: 10px;
                                        ">
                                            โปรดเข้าสู่ระบบก่อน !
                                        </p>
                                    </a>
                                @else
                                    <a onclick="addToCart(this)" class="btn btn-success btn-block">
                                        <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า
                                    </a>
                                @endguest
                            
                            </div>
                        </div>
                    
                    <!-- end product card -->
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>


@endsection


@section('script-area')

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}

@endsection




<script>
    setTimeout(() => {
        document.querySelectorAll('.btnKeepItemToCart').forEach(element => {
            element.addEventListener('mouseover', (e) => {
                e.target.querySelector('.msgNotAllowedKeepItemToCart').style.display = 'block';
            })
            element.addEventListener('mouseout', (e) => {
                e.target.querySelector('.msgNotAllowedKeepItemToCart').style.display = 'none';
            })
        });
    }, 1000);
</script>