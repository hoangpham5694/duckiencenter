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
img.head-bill{
  vertical-align: middle;

}
table tr td{
  border:none;
}
</style>
</head>
<body>
    <table width="800px" cellpadding="0" cellspacing="0" border="3">
        <tbody>
          <tr>
            <td>
             
              <p style="margin:0;float:right;">http://www.duckien.edu.vn.http://www.duckien.edu.vn.http://www.duckien.edu.vn.<img class="head-bill" src="{{ asset('public/images/logo.png') }}" alt=""></p>
              
              <div class="clearfix"></div>
            </td>
          </tr>
          <tr>
            <td>

                <font face="Times New Roman" size="4.8pt">
                    <div style="text-align:center">
                        CHI NHÁNH CÔNG TY TNHH MTV<BR>

                                <b>Hỗ trợ giáo dục – Thương mại Đức Kiến</b><br>
                                -------------------
                    </div>
                    <div style="text-align:center; font-size:25px; font-weight:bold">
                        @yield('title')
                       <p style="font-size:17px;margin:0">--oOo--</p>
                    </div>
                    <br>
                    <div class="bill-info">
                         @yield('content')
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
                            <td align="center" style="width:50%">
                              <b>@yield('foot-left')</b>  <br> <br> <br> <br> <br> <br> <br><br><br> 

                            </td>
                            <td align="center" style="width:50%">
                               <b>@yield('foot-right')</b><br> <br> <br> <br> <br> <br> <br><br><br> 
                            </td>
                        </tr>
                    </tbody></table>

                </font>

            </td>
        </tr>
    </tbody>
</table>
    
    

</body>