@extends("layouts.master")
@section('title') BikeShop | รายการสินค้า @stop
@section('content')
    <div class="container">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">หน้าแรก</a></li>
                    <li><a href="#">ข้อมูลประเภทสินค้า</a></li>
                    <li><a href="#">รายงาน</a></li>
                </ul>
            </div>
        </nav>
        <h1>ประเภทสินค้า</h1>
        <h2>นายปัญจพล สุริยะฉาย 6306021610071 </h2>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><strong>รายการ</strong></div>
            </div>
            <div class="panel-body">
                <form action="{{ URL::to('product/category/search')}}" class="form-inline" method="post">
                    {{-- @csrf --}}
                    {{ csrf_field() }}
                    <input type="text" name="q" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                    <a href="{{ URL::to('product/category/edit') }}" class="btn btn-success pull-right">เพิ่มสินค้า
                    </a>
                </form>
            </div>
        </div>
        <table class="table table-bordered bs-table">
            <thead>
                <tr>
                    <th>เลข </th>
                    <th>ประเภท</th>
                    <th>การทำงาน </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->name }}</td>
                        <td class ="bs-center">
                            <a href="{{ URL::to('product/category/edit/'.$p->id) }}" class="btn btn-info">
                                <i class="fa fa-edit"></i> แก้ไข</a>
                            <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p->id }}">
                                <i class="fa fa-trash"></i> ลบ</a>
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
        <div class="panel-footer">

        </div>
        {{ $categories->links() }}
    </div>
    <script>
        $('.btn-delete').on('click', function() { 
            if(confirm("คุณต้องการลบข้อมูลสินค้าหรือไม่?")){
                var url = "{{ URL::to('product/category/remove') }}" + '/' + $(this).attr('id-delete'); window.location.href = url;
            }
        });
    </script>
@endsection
