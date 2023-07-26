@extends("layouts.master")
@section('content')

    <div class="container">
        <h1>รายละเอียดการสั่งซื้อสินค้า</h1>
        <div class="breadcrumb">
            <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
            <li><a href="{{ URL::to('admin/orderdetail') }}">แสดงการสั่งซื้อสินค้า</a></li>
            <li class="active">รายละเอียดการสั่งซื้อสินค้า</li>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class = "panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>รายการสินค้า </strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(count($orderdetail))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>รหัส</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>จำนวน</th>
                                    <th>วันเวลาที่ซื้อ</th>
                                    <th>status</th>
                                    <th class="bs-price">ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sum_price = 0; $sum_qty = 0; ?>
                                @foreach($orderdetail as $c)
                                    <tr>
                                        <td><img src="{{ URL::to($c->products->image_url) }}" width="32"></td>
                                        <td>{{ $c->products->code }}</td>
                                        <td>{{ $c->products->name }}</td>
                                        <td>{{ $c->products->price }}</td>
                                        <td>{{ number_format($c->qty, 0) }}</td>
                                        <td>{{ $c->created_at }}</td>
                                        <td>@if ( $c->status == 0 )
                                            ยังไม่ชำระเงิน
                                        @else
                                            ชำระเงินแล้ว
                                        @endif</td>
                                        <td class="bs-price">{{ number_format($c->t_price, 0) }}</td>
                                    </tr>
                                    <?php $sum_price += $c->t_price ?>
                                    <?php $sum_qty += $c->qty ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">รวม</th>
                                    <th colspan="3">{{ number_format($sum_qty, 0) }}</th>
                                    <th class="bs-price">{{ number_format($sum_price, 0) }}</th>
                                </tr>
                            </tfoot>
                            @else
                            <strong>ไม่มีรายการซื้อสินค้า </strong>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
