
        {{-- <h1>@{ message }</h1>
        <input type="text" class="form-control" ng-model="message">

        <input type="text" class="form-control" ng-model="query.name" placeholder="ค้นหา">
        
        <table class="table table-bordered" ng-if="data_products.length">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า </th>
                    <th>ราคาขาย</th>
                    <th>จำนวนคงคลัง</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tr ng-repeat="p in data_products|filter:query">
                <td>@{ p.code }</td>
                <td>@{ p.name }</td>
                <td>@{ p.price|number:2 }</td>
                <td>@{ p.stock_qty|number:0 }</td>
                <td>
                    <span 
                        ng-if="p.stock_qty > 5"
                        class="label label-success"
                    >
                        ปกติ
                    </span>
                    <span 
                        ng-if="p.stock_qty > 0 && p.stock_qty <= 5"
                        ng-class="{'label label-warning': p.stock_qty > 0 && p.stock_qty <= 5}"
                    >
                        สินค้าใกล้หมด
                    </span>
                    <span 
                        ng-if="p.stock_qty == 0"
                        ng-class="{'label label-danger': p.stock_qty == 0}"
                    >
                        สินค้าหมด
                    </span>
                </td>
            </tr>
        </table>
        <h3 ng-if="!data_products.length">No Items Of Products</h3> --}}
