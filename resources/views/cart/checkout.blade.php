@extends("layouts.master")
@section('content')

    <div class="container">
        <h1>ชำระเงิน</h1>
        <div class="breadcrumb">
            <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
            <li><a href="{{ URL::to('cart/view') }}">สินค้าในตะกร้า</a></li>
            <li class="active">ชำระเงิน</li>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class = "panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>รายการสินค้า </strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>รหัส</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวน</th>
                                    <th class="bs-price">ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sum_price = 0; $sum_qty = 0; ?>
                                @foreach($orderdetail as $c)
                                @if ($c->status == 0)
                                    <tr>
                                        <td><img src="{{ URL::to($c->products->image_url) }}" width="32"></td>
                                        <td>{{ $c->products->code }}</td>
                                        <td>{{ $c->products->name }}</td>
                                        <td>{{ number_format($c->qty, 0) }}</td>
                                        <td class="bs-price">{{ number_format($c->t_price, 0) }}</td>
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
                                    <th class="bs-price">{{ number_format($sum_price, 0) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {{-- ข้อมูลผู้ซื้อสินค้า --}}
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>ข้อมูลลูกค้า </strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>ชื่อ-รามสกุล</label>
                            <input type="text" class="form-control" id="name" value="{{Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label>อีเมล</label>
                            <input type="text" class="form-control" id="email" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <a href="{{ URL::to('cart/view') }}" class="btn btn-default">ย้อนกลับ</a>
        <div class="pull-right">
            <a href="javascript:complete()" class="btn btn-warning">พิมพ์ใบสั่งซื้อ</a>
            <a href="{{URL::to('/cart/finish')}}" class="btn btn-primary"><i class="fa fa-check"></i>จบการขาย</a>
        </div>

    </div>
@stop
<script>
function complete(){
    window.open(
    "{{URL::to('/cart/complete')}}?name="+$('#name').val()+'&email='+$('#email').val(),"_blank",
    )
    //window.location.href= "{{URL::to('/cart/finish')}}";
}
</script>