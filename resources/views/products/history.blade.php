@extends('layouts.app')

@section('content')

<style type="text/css">

    .div-box {
        border: 1px solid #a0a0a0;
    }

    #tabMenuDmPro {
        border-bottom: 0 solid #999;
        width: 100%;
    }

    .text_arrow {
        color: #000039;
        font-weight: 700;
        margin-bottom: 6px;
        margin-top: 6px;
    }

    #tabMenuDmPro a:hover span, #tabMenuDmPro .curent a span {
        background-position: 100% -29px;
        color: #000;
        text-decoration: none;
    }

    #tabMenuDmPro a:hover, #tabMenuDmPro .curent a {
        background-position: 0 -29px;
    }

    .div-box {
        border: 1px solid #a0a0a0;
    }

    #tabMenuDmPro .bgg {
        
        height: 29px;
        width: 100%;
        border-left: 0 solid #b1b1b1;
        border-right: 0 solid #b1b1b1;
    }

    #tabMenuDmPro a span {
        background: url({{ asset('images/template/bgg_tk_right.jpg')  }}) right top no-repeat;
        display: block;
        color: #000;
        text-decoration: none;
        float: none;
        padding: 10px 7px 4px 6px;
    }

    #tabMenuDmPro a {
        float: left;
        background: url({{ asset('images/template/bgg_tk_left.jpg')  }}) left top no-repeat;
        text-decoration: none;
        padding: 0 0 0 8px;
    }

    td{
        font-size: 12px;
    }

    span{
        font-size: 12px;
    }

    ul, ol {
        list-style: none;
    }


</style>

<div class="paddings">
    <style type="text/css">
        .div-box table { width:100%;}
    </style>

  
    <table width="100%">
        <tbody>
            <tr>
                <!--start cot trai-->
                <td valign="top" width="55%">
                    <!--Start don hang-->
                    <div class="pic icon_arrow left"></div>
                   
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">

                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="190">Sản phẩm </td>
                                    <td width="100">Giá cũ</td>

                                    <td width="130">Thời gian sửa</td>
                                    <td width="130">Người sửa</td>
                                    
                                </tr>
                                <?php 

                                    $key =0;
                                ?>
                                @foreach($data as $value)
                                    <?php 
                                        $key++;
                                    ?>
                                <tr>
                                    <td width="40">{{ $key }}</td>
                                    <td width="190">{{ App\Models\product::find($value->product_id)->Name }}</td>
                                    
                                    <td width="130">{{ str_replace(',' ,'.', number_format($value->price_old)) }} đ</td>

                                    <td>{{ $value->updated_at }}</td>
                                    <td> {{ App\User::find($value->user_id)->name }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
               
            </tr>
        </tbody>
    </table>

    <a href="{{ route('products.index') }}">về trang sản phẩm</a>
    <script type="text/javascript">
        function testApi() {
            $.ajax({
                type: 'POST',
                dataType:"jsonp",
                contentType:'application/json',
                cors: true ,
                secure: true,
                url: 'https://dienmaynguoiviet.gencrm.com/modules/api/insert',
                headers:{ 

                    'Access-Control-Allow-Origin': '*',        
                  
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ('Authorization', 'Basic Z2VuY3JtX2drczpnZW5jcm1fZ2tzQDIwMTYj');
                },
                data:{
                        
                    "api_id":"qr4SP88JRWzDzd/u4AyG8djhaaj5eJHfFiudnB2klPQ=",
                    "vcustomers_insert_individual": {
                        "di_dong": "0987654321",
                        "ten_khach_hang": "cuong test api" 
                    },
                    "hop_dong": [
                        {
                            "col162": "12 tháng",
                            "col112": "Hợp đồng mua bán",
                            "col142": "19/10/2022",
                            "col121": "Hợp đồng mua bán",
                            "col132": "CHOGIAOHANG",
                            "chi_tiet": [
                                {
                                    "ma_nsp": "65UP7550PTC",
                                    "ten_nsp": "Smart tivi LG 65UP7550PTC 65 inch 4K",
                                    "ma_sp": "65UP7550PTC",
                                    "ten_sp": "LG 65UP7550PTC",
                                    "don_gia": "500000",
                                    "so_luong": "1"
                                }
                            ]
                        }
                    ]
                        
                },
                dataType: 'json',
                success: function (data, status, xhr) {
                    alert('thành công')
                }
            });


        }

        function home_report(w){
            $.get("/admin/ajax/report_home.php", {
                action : w
            }, function(data) {
                $("#home_report_"+w).html(data);
            } );
        }
        
           function report_top_article(type, period, holder, limit, from_date, to_date){
               $('#'+holder).html('<img src=/includes/images/awaiting.gif> vui lòng chờ ...');
               $.get("/admin/ajax/report.php",{
                   action : "report-top-article",
                   type : type ,
                   period : period,
                   limit : limit,
                   from_date : from_date,
                   to_date : to_date
               },function(data){
                   $('#'+holder).html(data);
               });
           }
        
       
    </script>   
    <input type="hidden" id="current_use1" value="1">
    <script>
        function ajax_cate(idmau) {
          var current_use = document.getElementById('current_use1').value;
          document.getElementById('select_'+current_use).className = '';
          document.getElementById('current_use1').value = idmau;
          document.getElementById('select_'+idmau).className = 'curent';
          document.getElementById('content_'+current_use).style.display = 'none';
          //document.getElementById('content_'+idmau).style.display = 'block';
          $("#content_"+idmau).fadeIn("slow");
        
          if(idmau == 6) {
             report_top_article('visit','mo', 'top_article_visit', 10);
          }
        }
    </script>
</div>
@endsection