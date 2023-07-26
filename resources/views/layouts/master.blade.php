{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
</head>
<body>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <div class="container">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">หน้าแรก</a></li>
                    <li><a href="#">ข้อมูลสินค้า</a></li>
                    <li><a href="#">รายงาน</a></li>
                </ul>
            </div>
        </nav>
        <a href="#" class="btn btn-default"><i class="fa fa-home"></i> หน้าหลัก </a>
        <a href="#" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</a>
        <a href="#" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>หัวข้อ </strong>
                </div>
            </div>
            <div class="panel-body">
                 เราใส่เนื้อหาที่นี่
            </div>
        </div> 
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคาขาย</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>P001</td>
                    <td>ชุดจักรยาน ขนาด XL</td>
                    <td>2500.00</td>
                </tr>
                <tr>
                    <td>P002</td>
                    <td>หมวดกันน็อก รุ่น DL330</td>
                    <td>2500.00</td>
                </tr>
                <tr>
                    <td>P003</td>
                    <td>ชุดเกียร์ Shimamo รุ่น SH-001</td>
                    <td>4500.00</td>
                </tr>
            </tbody>
        </table>
        <a href="#" class="btn btn-default">Default</a>
        <a href="#" class="btn btn-primary">Primary</a>
        <a href="#" class="btn btn-info">Info</a>
        <a href="#" class="btn btn-success">Success</a>
        <a href="#" class="btn btn-warning">Warning</a>
        <a href="#" class="btn btn-danger">Danger</a>
        <div class="form-group has-error">
            <label>ชื่อ-นามสกุล</label>
            <input type="text" class="form-control">
            <div class="help-block">กรุณากรอกชื่อ-นามสกุล</div>
        </div>
        <div class="form-group has-error">
            <label>ที่อยู่</label>
            <textarea rows="4" class="form-control"></textarea>
            <div class="help-block">กรุณากรอกที่อยู่</div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">เพิ่มข้อมูล</button>
        </div>
    </div>
    
</body>
</html> --}}


<!doctype html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title", "BikeShop | จําหน่ายอะไหล่จักรยานออนไลน์")</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
<!-- css -->
<!-- js -->
</head>

<body>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <div class="container">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li>
                   
                    @guest 
                    @else
                    <li><a href="{{ URL::to('product') }}">จัดการข้อมูลสินค้า </a></li>
                    <li><a href="#">รายงาน</a></li> 
                    @if (Auth::user()->role == '1')
                    <li><a href="{{ URL::to('admin/orderdetail') }}">แสดงการสั้งซื้อสินค้า</a></li>
                    @endif
                    @if (Auth::user()->role == '1')
                    <li><a href="{{ URL::to('/admin/user') }}">ข้อมูลผู้ใช้</a></li>    
                    @endif
                        
                    @endguest
                    
                    
                </ul>
                <ul class="nav navbar-nav navbar-right"> @guest
                    <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                    <li><a href="{{ route('register') }}">ลงทะเบียน</a></li> @else
                    <li><a href="{{URL::to('/orderdetail')}}">{{ Auth::user()->name }} </a></li>
                    <li><a href="{{ route('logout') }}">ออกจากระบบ </a></li> @endguest
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ URL::to('cart/view') }}"> <i class="fa fa-shopping-cart"></i> ตะกร้า
                            
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <center><h3>นายพงศธร ผ่องศรี 6306021622011</h3></center>
        @yield("content")
        
    </div>
    <!-- js -->
    @if(session('msg'))
        @if(session('ok'))
            <script>toastr.success("{{ session('msg') }}")</script>
        @else
            <script>toastr.error("{{ session('msg') }}")</script>
        @endif
    @endif
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- js -->
</body>
</html>