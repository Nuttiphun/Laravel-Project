@extends('layout.master')
@section('title')    Category | Edit    @endsection



@section('content')


{{-- 'action' => 'ProductController@onInsert' --}}
{!! 
    Form::open(
        array(
            'url' => 'product/category/edit', 
            'method' => 'post', 
            'enctype' => 'multipart/form-data'
        )
    ) 
!!}

    <ul class="breadcrumb">
        <li><a href="/product/category">ประเภทสินค้า</a></li>
        <li><a href="#">แก้ไขประเภทสินค้า</a></li>
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
            <h1 style="margin: 40px 10px;">แก้ไขประเภทสินค้า</h1>
        </div>
        
        <div class="panel-body">
            <table>
                <input type="hidden" name="id" value="{{ $category->id }}">
                <tr style="height: 48px;">
                    <td style="width: 140px">
                        {{ Form::label('name', 'ชื่อประเภทสินค้า') }}
                    </td>
                    <td>
                        {{ Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'ชื่อประเภทสินค้า']) }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="panel-footer">
            <a href="/product/category" class="btn btn-danger">ยกเลิก</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        </div>
    </div>

{!! Form::close() !!}


@endsection