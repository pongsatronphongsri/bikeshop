@extends("layouts.master") @section('title') BikeShop | แก้ไขข้อมูลประเภทสินค้า @stop
@section('content')
<div class="container">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">BikeShop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">หน้าแรก</a></li>
                <li><a href="{{ URL::to('product/category') }}">ข้อมูลประเภทสินค้า</a></li>
                <li><a href="#">รายงาน</a></li>
            </ul>
        </div>
    </nav>
    <h1>แก้ไขประเภทสินค้า </h1>
    <h2>นายปัญจพล สุริยะฉาย 6306021610071 </h2>
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('product/category') }}">หน้าแรก</a></li>
        <li class="active">แก้ไขสินค้า </li>
    </ul>
    {!! Form::model($categories, array('action' => 'App\Http\Controllers\CategoryController@update','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
        <input type="hidden" name="id" value="{{ $categories->id }}">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>ข้อมูลประเภทสินค้า </strong>
                </div>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>{{ Form::label('name', 'ชื่อสินค้า ') }}</td>
                        <td>{{ Form::text('name', $categories->name, ['class' => 'form-control']) }}</td>
                    </tr>
                </table>    
            </div>
            <div class="panel-footer">
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> บันทึก</button>
            </div>
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
@endsection