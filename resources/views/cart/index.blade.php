@extends("layouts.master") 
@section('title') BikeShop | ตะกร้าสินค้า @stop
@section('content')
    <div class="container">
        <h1>สินค้าในตะกร้า</h1>
        <div class="breadcrumb">
            <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i>หน้าร้าน</a></li>
            <li class="active">สินค้าในตะกร้า</li>
        </div>
        <div class="panel panel-default">
            @if(count($orderdetail))
                <?php $sum_price = 0 ?>
                <?php $sum_qty = 0 ?>
            <table class="table bs-table">
                <thead>
                    <tr>
                        <th>รูปสินค้า</th>
                        <th>รหัส</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderdetail as $c)
                    @if ($c->status == 0)
                    <tr>
                        <td><img src="{{ URL::to($c->products->image_url) }}" height="36"></td>
                        <td>{{ $c->products->code }}</td>
                        <td>{{ $c->products->name }}</td>
                        <td><input type="text" class="form-control" value="{{ $c->qty }}" style="width:100px" onKeyUp="updateCart({{$c->id}}, this)"></td>
                        <td>{{ number_format($c->t_price, 0) }}</td>
                        <td>
                            <a href="{{ URL::to('cart/delete/'.$c->id) }}" class="btn btn-danger">
                            <i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php $sum_price += $c->t_price ?>
                    <?php $sum_qty += $c->qty ?>
                        
                    @endif
                       
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">รวม</th>
                        <th>{{ number_format($sum_qty, 0) }}</th>
                        <th>{{ number_format($sum_price, 0) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            @else
            <div class="panel-body"><strong>ไม่พบรายการสินค้า !</strong></div>
            @endif
        </div>
        <a href="{{ URL::to('/home') }}" class="btn btn-default">ย้อนกลับ </a>
            <div class="pull-right">
                <a href="{{ URL::to('cart/checkout') }}"class="btn btn-primary">ชําระเงิน <i class="fa fa-chevron-right"></i></a>
            </div>
    </div>
@endsection
<script>
    function updateCart(id, qty) {
        window.location.href = '/cart/update/' + id + '/' + qty.value;
    }
</script>