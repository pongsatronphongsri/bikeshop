@extends("layouts.master") 
@section('title') BikeShop | แสดงการสั่งซื้อสินค้า @stop
@section('content')
    <div class="container">
        <h1>แสดงการสั่งซื้อสินค้า</h1>
        <div class="breadcrumb">
            <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i>หน้าร้าน</a></li>
            <li class="active">แสดงการสั่งซื้อสินค้า</li>
        </div>
        <div class="panel panel-default">
            @if(count($order))
            <?php 
                $sum_price =0;
                $sum_qty =0;
            ?>
            <table class="table bs-table">
                <thead>
                    <tr>
                        <th>ออเดอร์ไอดี</th>
                        <th>เลขที่ใบสั่งซื้อ</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>วันที่สั้งซื้อ</th>
                        
                        <th>รายละเอียด</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->order_name}}</td>
                            <td>{{ $c->users->name }}</td>
                            <td>{{ $c->created_at}}</td>
                            <td>
                                <button type="button" class="btn btn-success"><a href="{{URL::to('admin/orderdetail/finish'.'/'.$c->id)}}" style="color:aliceblue">
                                    ชำระเงินแล้ว</a></button>
                                <button type="button" class="btn btn-secondary"><a href="{{URL::to('admin/orderdetail/status'.'/'.$c->id)}}">
                                    ยังไม่ชำระเงิน</a></button>
                                <a href="{{URL::to('admin/orderdetail/check'.'/'.$c->id)}}" class="btn btn-danger">
                                    ดู</a>
                            </td>

                            <td>
                                @if ( $c->status == 0 )
                                
                                        ยังไม่ชำระเงิน
                                    @else
                                        ชำระเงินแล้ว
                                    
                                    
                                @endif
                            </td>
                        </tr>
                        <?php $sum_price += $c['price'] ?>
                        <?php $sum_qty += $c['qty'] ?>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="panel-body"><strong>ไม่พบรายการสินค้า !</strong></div>
            @endif
        </div>
    </div>
@endsection