<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: "Garuda", sans-serif;
        }
        table tr th {
            padding: 5px;
            background-color: #f7f7f7;
        }
        table tr td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <table border="0" width="100%">
        <tr>
            <td colspan="2" align="center"><h1>ใบสั่งซื้อ</h1><h2>(Purchase Order)</h2>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" width="100%">
                    <tr><td><strong>ชื่อลูกค้า :</strong></td><td>{{ $cust_name }}</td></tr>
                    <tr><td><strong>อีเมล:์</strong></td><td>{{ $cust_email }}</td></tr>
                </table>
            </td>
            <td>
                <table border="0" width="100%">
                    <tr><td><strong>เลขที่:</strong></td><td>{{ $po }}</td></tr>
                    <tr><td><strong>วันที่:</strong></td><td>{{ $po_date }}</td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table border="1" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <th>ลําดับ </th>
                        <th>ชื่อสินค้า </th>
                        <th>ราคา/หน่วย</th>
                        <th>จํานวน</th>
                        <th>รวมเงิน</th>
                    </tr>
                    @foreach($orderdetail as $c)
                    @if ($c->status == 0)
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->products->name }}</td>
                        <td align="right">{{ number_format($c->products->price, 0) }}</td>
                        <td align="right">{{ number_format($c->qty, 0) }}</td>
                        <td align="right">{{ number_format($c->t_price,0) }}</td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <h4>หมายเหตุ</h4>
                <ul>
                    <li>ชําระเงินโดยโอนเข้าบัญชีXXX ธนาคาร YYY สาขา ZZZ (ออมทรัพย)์</li>
                    <li>กรุณาชําระเงินภายใน 7 วัน หลังจากที่สั่งซื้อ</li>
                    <li>ชําระเงินแล้วส่งหลักฐานมาที่ sales@bikeshop.com หรือ LINE: @bikeshop</li>
                </ul>
            </td>
            <td align="right"><strong>จํานวนเงินรวมทั้งสิ้น</strong> <h1>{{  number_format($total_amount,0) }} บาท</h1></td>
        </tr>
    </table>
</body>
</html>


