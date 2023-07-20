@extends('layout.master')
@section('title')    Category    @endsection





@section('bottom-script-area')
    
    @if (session('message'))
        @if(session('status'))
            <script>
                toastr.success("{{ session('message') }}")
            </script>
        @else
            <script>
                toastr.error("{{ session('message') }}")
            </script>
        @endif
    @endif

@endsection




@section('content')


{{ $data_category->links() }}

<div>

    <h1>รายการประเภทสินค้า</h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>รายการ</strong>
            </div>
        </div>
        <div class="panel-body">
            <form action="{{ URL::to('/product/category/search') }}" method="POST" class="form-inline" style="width:100%; display: flex; justify-content: flex-end;">
                @csrf
                <input type="text" name="word_search" class="form-control" placeholder="ค้นหาสินค้าที่ต้องการ">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
            </form>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>รหัสประเภท</th>
                    <th>ชื่อประเภท</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="/product/category/edit/{{ $item->id }}" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="/product/category/del/{{ $item->id }}" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <div class="panel-footer">
            <div style="width: 100%; display: flex; justify-content: flex-end;">
                <a href="/product/category/add" class="btn btn-success" style="font-size: 17px;">
                    <i style="margin-right: 4px;" class="fa-solid fa-plus"></i>
                    เพิ่มข้อมูลประเภทสินค้า
                </a>
            </div>
        </div>
    </div>

</div>

@endsection