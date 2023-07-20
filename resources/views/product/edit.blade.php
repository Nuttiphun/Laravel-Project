@extends('layout.master')
@section('title')    Product | Edit    @endsection


@section('content')


{{-- 'action' => 'ProductController@onUpdate' --}}
{!!
    Form::model(
        $product, 
        array(
            'action' => 'App\Http\Controllers\ProductController@onUpdate', 
            'method' => 'post', 
            'enctype' => 'multipart/form-data'
        )
    ) 
!!}

    <ul class="breadcrumb">
        <li><a href="/product">หน้าสินค้า</a></li>
        <li><a href="#">แก้ไขสินค้า</a></li>
    </ul>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-header">
            <h1 style="margin: 40px 10px;">แก้ไขสินค้า</h1>
        </div>
        
        <div class="panel-body">
            <input type="hidden" name="id" value="{{ $product->id }}">
            <table>
                <tr>
                    <td>{{ Form::label('category_id', 'ประเภทสินค้า') }}</td>
                    <td>
                        {{ Form::select('category_id', $categories, Request::old('category_id'), ['class' => 'form-control']) }}
                    </td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('code', 'รหัสสินค้า') }} </td>
                    <td>{{ Form::text('code', $product->code, ['class' => 'form-control']) }}</td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('name', 'ชื่อสินค้า ') }}</td>
                    <td>{{ Form::text('name', $product->name, ['class' => 'form-control']) }}</td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('stock_qty', 'คงเหลือ') }}</td>
                    <td>{{ Form::text('stock_qty', $product->stock_qty, ['class' => 'form-control']) }} </td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('price', 'ราคาขายต่อหน่วย') }}</td>
                    <td>{{ Form::text('price', $product->price, ['class' => 'form-control']) }}</td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
                    <td>{{ Form::file('image') }}</td>
                </tr>
            </table>
        </div>

        <div class="panel-footer">
            <a href="/product" class="btn btn-danger">ยกเลิก</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        </div>
    </div>

{!! Form::close() !!}


@endsection