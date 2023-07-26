@extends("layouts.master") @section('title') BikeShop | เพิ่มข้อมูลประเภทสินค้า @stop
@extends("layouts.master")
<div class="container">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">BikeShop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">หน้าแรก</a></li>
                <li><a href="{{ URL::to('product/category') }}">ข้อมูลประเภทสินค้า </a></li>
                <li><a href="#">รายงาน</a></li>
            </ul>
        </div>
    </nav>
    <h1>เพิ่มประเภทสินค้า</h1>
    <h2>นายปัญจพล สุริยะฉาย 6306021610071 </h2>
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('product/category') }}">หน้าแรก</a></li>
        <li class="active">แก้ไขสินค้า </li>
    </ul>
    {!! Form::open(array('action' => 'App\Http\Controllers\CategoryController@insert','method'=>'post', 'enctype' => 'multipart/form-data')) !!}
        <table>
            <tr>
                <td>{{ Form::label('name', 'ชื่อประเภทสินค้า ') }}</td>
                <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
            </tr>
        </table>
        <div class="panel-footer">
            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> บันทึก</button>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
    {!! Form::close() !!}
</div>
