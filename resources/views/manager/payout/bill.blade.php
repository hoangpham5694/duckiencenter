<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Hóa đơn thanh toán</title>
<style>
    .bill-info ul li{
        margin: 5px 0;
    }
    .bill-info table{
        width:100%;
    }
.clearfix{
    clear:both;
}
 .bill-info .col{
    float:left;
    width:50%;
}
</style>
</head>
<body>
    <table width="800px" cellpadding="0" cellspacing="0" border="3">
        <tbody><tr>
            <td>

                <font face="Times New Roman" size="4.8pt">
                    <div style="text-align:center">
                        CÔNG TY TNHH HỖ TRỢ GIÁO DỤC - THƯƠNG MẠI<BR>

                                <b>ĐỨC KIẾN</b><br>
                                -------------------
                    </div>
                    <div style="text-align:center; font-size:25px; font-weight:bold">
                        HÓA ĐƠN THANH TOÁN
                       <p style="font-size:17px;margin:0">--oOo--</p>
                    </div>
                    <br>
                    <div class="bill-info">
                        <ul>
                            <li style="list-style-type:none">
                                <div class="col">
                                    Tên giáo viên:&nbsp;&nbsp;
                               <strong>{{ $payout->lastname }} {{ $payout->firstname }}</strong>
                                     
                                </div>
                                <div class="col">
                                     Mã giáo viên:&nbsp;&nbsp;
                               <strong>{{ $payout->username }}</strong> 
                                </div>
            <div class="clearfix"></div>
                               
                            </li>

                            <li style="list-style-type:none">
                               Số tiền rút:&nbsp;&nbsp;
                               <strong>
                                     {{number_format( $payout->paid_money,0)  }} VND
                               </strong>
                            </li>                            
                            <li style="list-style-type:none">
                               Số tiền còn lại:&nbsp;
                               <strong>
                                      {{number_format($payout->amount,0)  }} VND
                               </strong>
                            </li>
                     
                            <li style="list-style-type:none">
                                Người thanh toán:&nbsp;&nbsp;
                                <strong>
                                       {{ $payout->name }}
                                </strong>
                            </li>
                            <li style="list-style-type:none">
                               Ngày rút tiền:&nbsp;&nbsp;
                               <strong>
                                  {{ Carbon\Carbon::parse($payout->created_at)->format('d/m/y - h:i') }}
                               </strong>
                            </li>
                            
                            <li style="list-style-type:none">
                               Trạng thái:&nbsp;&nbsp;
                               <strong>
                                     @if($payout->is_paid == 1)
                                        Đã thanh toán
                                    @else
                                      Chưa thanh toán
                                    @endif
                               </strong>
                            </li>
                        </ul>
                    </div>

        

                <table width="800px" cellpadding="0" cellspacing="0" border="0">
                    <tbody><tr style="height: 30px">
                        <td align="left">
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Đà Nẵng, Ngày&nbsp;&nbsp;&nbsp;Tháng&nbsp;&nbsp;&nbsp;Năm   

                        </td>
                        <td>
                            
                        </td>
                        </tr>

                    </tbody>
                </table>
                <br>
                    <table width="800px" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr style="height: 30px">
                            <td align="center">
                              <b>GIÁO VIÊN</b>  <br> <br> <br> <br> <br> <br> <br><br><br> 

                            </td>
                            <td align="center">
                               <b>NHÂN VIÊN</b><br> <br> <br> <br> <br> <br> <br><br><br> 
                            </td>
                        </tr>
                    </tbody></table>

                </font>

            </td>
        </tr>
    </tbody>
</table>
    
    

</body>