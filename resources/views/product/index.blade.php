@extends('layout.master')
@section('title')    Product    @endsection




@section('bottom-script-area')

    @if (session('msg'))
        @if(session('ok'))
            <script>
                toastr.success("{{ session('msg') }}")
            </script>
        @else
            <script>
                toastr.error("{{ session('msg') }}")
            </script>
        @endif
    @endif


@endsection




@section('content')


<ul class="breadcrumb">
    <li><a href="/product">หน้าสินค้า</a></li>
</ul>


<div>

    <h1>รายการสินค้า </h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>รายการ</strong>
            </div>
        </div>
        <div class="panel-body">
            <form action="{{ URL::to('product/search') }}" method="POST" class="form-inline" style="width:100%; display: flex; justify-content: flex-end;">
                @csrf
                <input type="text" name="word_search" class="form-control" placeholder="ค้นหาสินค้าที่ต้องการ">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
            </form>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>รูปสินค้า</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    {{-- <th>ประเภท</th> --}}
                    {{-- <th>คงเหลือ</th> --}}
                    <th>ราคาต่อหน่วย</th>
                    <th>เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_products as $item)
                    <tr>
                        <td>
                            @if ($item->image_url)
                                <img src="{{ $item->image_url }}" alt="" width="50px">
                            @else
                                <img src="upload/images/no-img.jpg" alt="" width="50px">
                            @endif
                        </td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        {{-- <td>{{ $item->qty }}</td> --}}
                        <td>{{ $item->price }}</td>
                        <td>
                            <a href="/product/action/{{ $item->id }}" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn_delete btn btn-danger">
                                <input type="hidden" class="product_id" value="{{ $item->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                {{-- <tr>
                    <td>ราคารวม</td>
                    <td>{{ number_format($data_products->sum('price')) }}</td>
                </tr> --}}
            </tfoot>
        </table>
        <div class="panel-footer">
            {{ $data_products->links() }}
            <div style="width: 100%; display: flex; justify-content: flex-end;">
                <a href="/product/action" class="btn btn-success" style="font-size: 17px;">
                    <i style="margin-right: 4px;" class="fa-solid fa-plus"></i>
                    เพิ่มข้อมูลสินค้า
                </a>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">

    let btnDel = document.querySelectorAll('.btn_delete')
    
    for (let i = 0; i < btnDel.length; i++) {
        btnDel[i].addEventListener('click', () => {
            if (confirm('คุณต้องการลบข้อมูลสินค้าหรือไม่')) {
                window.location.href = `product/delete/${btnDel[i].querySelector('.product_id').value}`;
            }
        })
    }

</script>

@endsection