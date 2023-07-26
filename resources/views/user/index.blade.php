@extends("layouts.master") @section('title') BikeShop | เพิ่มข้อมูลสินค้า @stop
@section('content')
    <h1>รายการข้อมูลผู้ใช้</h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><strong>รายการ</strong></div>
        </div>
        <div class="panel-body">
            <a href="{{ URL::to('admin/user/edit') }}" class="btn btn-success pull-right">เพิ่มผู้ใช้
            </a>
        </div>
    </div>
    {{ csrf_field() }}
    <table class="table table-bordered bs-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>ชื่อ</th>
                <th>อีเมลล์</th>
                <th>วันที่สร้าง</th>
                <th>สถานะการชำระเงิน</th>
                <th>การทํางาน</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $p)
                <tr>
                    <td>{{ $p['id'] }}</td>
                    <td>{{ $p['name']}}</td>
                    <td>{{ $p['email'] }}</td>
                    <td>{{ $p['time'] }}</td>
                    @if ($p['status'] == 0 )
                        <td style="background-color:silver">ยังไม่ชำระเงิน</td>
                    @else
                        <td style="background-color:palegreen">ชำระเงินแล้ว</td>
                    @endif 
                    <td class="bs-center">
                        <a href="{{ URL::to('admin/user/edit/'.$p['id']) }}" class="btn btn-info">
                        <i class="fa fa-edit"></i> แก้ไข</a>
                        <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p['id'] }}">
                            <i class="fa fa-trash"></i> ลบ</a>
                    </td>
                </tr> 
            @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <div class="panel-footer">
    </div>


    <script>
        $('.btn-delete').on('click', function() { 
            if(confirm("คุณต้องการลบข้อมูลสินค้าหรือไม่?")) {
                var url = "{{ URL::to('admin/user/remove') }}"
                + '/' + $(this).attr('id-delete'); window.location.href = url;
            }
        });
    </script>
@endsection