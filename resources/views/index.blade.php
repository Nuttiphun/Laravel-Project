@extends('layout.master')

@section('title')    Title: index    @endsection


@section('content')
                    

        <h2 style="width: 100%; text-align: center; margin-top: 200px;">
            ยินดีต้อนรับเข้าสู่ @Bikeshop <br><br>
            เว็บขายจักรยานอันดับต้น ๆ แห่งประเทศไทย <br><br>
            <a href="/home">ดูสินค้า</a>
        </h2>
        {{-- <div class="panel-heading">
            <div class="panel-title">
                <strong>หัวข้อ</strong>
            </div>
        </div>
        
        <div class="panel-body">        
            <a href="#" class="btn btn-default"><i class="fa-solid fa-house"></i> หน้าหลัก </a>
            <a href="#" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</a>
            <a href="#" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
        </div> --}}

@endsection
