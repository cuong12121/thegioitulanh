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

    @if( Auth::user()->id ==1)
    <div><a href="javascript:void(0)" onclick="testApi()"><button>testApi</button></a></div>
    @endif
    <table width="100%">
        <tbody>
            <tr>
                <!--start cot trai-->
                <td valign="top" width="55%">
                    <!--Start don hang-->
                    <div class="pic icon_arrow left"></div>
                    <div class="text_arrow left">Đơn hàng mới nhất:  (<a href="{{ route('order_list') }}">Xem toàn bộ danh sách</a>)</div>
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">
                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="190">Khách hàng</td>
                                    <td width="100">Thời gian đặt hàng</td>

                                    <td width="130">Quà tặng của đơn hàng</td>
                                    <td>Giá trị đơn hàng</td>
                                    <td width="120">Xem chi tiết</td>
                                </tr>
                                <?php 
                                    $key =0;

                                   
                                ?>
                                @if(isset($order))
                                    @foreach($order as $keys => $orders)
                                    <?php $key++; ?>
                                <tr>
                                   
                                    <td width="40">{{ $key }}</td>
                                    <td width="190">{{ @$orders->name }}</td>
                                    
                                    <td width="130">{{ @$orders->created_at }}</td>

                                    <td>{{ json_decode($orders->product)[$keys]->gift??'' }}</td>
                                    <td>{{str_replace(',' ,'.', number_format($orders->total_price)) }}</td>
                                    <td width="120"><a href="{{ route('order_list_view', $orders->id) }}">Xem</a></td>
                                    
                                </tr>

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">Hiện tại chưa có đơn hàng mới nào !</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!--End don hang-->
                    <!--Start don hang tra gop-->
                    <!--<div>&nbsp;</div>
                        <div class="pic icon_arrow left"></div>
                        <div class="text_arrow left">Đơn hàng trả góp:  (<a href="?opt=payinstall&view=order">Xem toàn bộ danh sách</a>)</div>
                        <div class="clear"></div>
                        <div style="border:1px solid #6a8ab9 ">
                        
                            <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                                <tr bgcolor=#EEEEEE>
                                    <td width=20px>STT</td>
                                    <td width=160px>Thời gian</td>
                                    <td width=160px>Loại hình</td>
                                    <td>Sản phẩm</td>
                                    <td width=100px>xem chi tiết</td>
                                </tr>
                        
                                
                            </table>
                        
                        </div>-->
                    <!--End don hang tra gop-->
                    <!--Start khach hang-->
                    <div>&nbsp;</div>
                    <div class="pic icon_arrow left"></div>
                    <div class="text_arrow left">Khách hàng liên hệ qua website (<a href="?opt=customer&amp;view=customer-contact">Xem toàn bộ danh sách</a>)</div>
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">
                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="190">Khách hàng</td>
                                    <td width="130">Điện thọai</td>
                                    <td width="130">Email</td>
                                    <td>Nội dung</td>
                                    <td width="120">Xem chi tiết</td>
                                </tr>
                                <?php 
                                    $lienhe = DB::table('lienhe')->take(6)->orderBy('id', 'desc')->get()->toArray();
                                    $viewcall = DB::table('callphone')->where('active', 0)->take(6)->orderBy('id', 'desc')->get()->toArray();
                                  
                                ?>

                                @if(isset($lienhe))
                                @foreach($lienhe as $lienhes)
                                <tr>
                                    <td width="40"></td>
                                    <td width="190">{{ $lienhes->contact_name }}</td>
                                    <td width="130">{{ $lienhes->contact_tel }}</td>
                                    <td width="130">{{ $lienhes->contact_email }}</td>
                                    <td width="130">{{ $lienhes->contact_message  }}</td>
                                    <td width="130"></td>
                                </tr>

                                @endforeach

                                @else
                                <tr>
                                    

                                    <td colspan="4">Hiện tại chưa có liên hệ mới nào !</td>
                                </tr>
                                @endif    
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="text_arrow left">Khách hàng yêu cầu gọi lại</div>
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">
                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="190">Khách hàng</td>
                                    <td width="130">Điện thọai</td>
                                    <td width="130">Sản phẩm</td>
                                    <td>Thời gian</td>
                                    <td width="120">Hoạt động</td>

                                </tr>
                                <?php 
                                    $lienhe = DB::table('lienhe')->take(6)->orderBy('id', 'desc')->get()->toArray();
                                  
                                ?>

                                @if(isset($viewcall))
                                @foreach($viewcall as $viewcalls)
                                <tr>
                                    <td width="40"></td>
                                    <td width="190">{{ $viewcalls->name }}</td>
                                    <td width="130">{{ $viewcalls->phone }}</td>
                                    <td width="130"><a href="{{ route('details', App\Models\product::find($viewcalls->product_id)->Link) }}" target="_blank">{{ App\Models\product::find($viewcalls->product_id)->Name }}</a></td>
                                    <td>{{ $viewcalls->created_at }}</td>
                                    <td width="130"><a href="{{ route('updateCall', $viewcalls->id) }}">xóa</a></td>
                                </tr>
                                @endforeach

                                @else
                                <tr>
                                    <td colspan="4">Hiện tại chưa có liên hệ mới nào !</td>
                                </tr>
                                @endif    
                                
                            </tbody>
                        </table>
                    </div>


                    <!--End khach hang-->
                    <!--Start khach hang đánh giá-->
                    <div>&nbsp;</div>
                    <div class="pic icon_arrow left"></div>
                    <div class="text_arrow left">Trao đổi chưa duyệt</div>
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">
                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="120">Khách hàng</td>
                                    <td>Nội dung</td>
                                    <td width="80">Xem</td>
                                </tr>

                                <?php  

                                    $rate = App\Models\rate::where('active', '0')->Orderby('id','desc')->take(10)->get()
                                ?>

                                @if(!empty($rate))
                                @foreach($rate as $rates)
                                <tr onmouseover="this.className='row-hover'" onmouseout="this.className=''" class="">
                                    <td class="stt">1</td>
                                    <td class="email">
                                        {{ $rates->name }}<br>
                                        <br>
                                        {{ $rates->updated_at->format('d/m/Y') }}                          
                                    </td>
                                    <td class="content">

                                        {!! $rates->content  !!}                       
                                    </td>
                                    <td>
                                        <a href="{{ route('rate-client') }}">
                                           xem
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                    <!--End khach hang đánh giá-->
                </td>
                <!--end cot trai-->
                <!--start cot phai-->
                <td width="20">&nbsp;</td>
                <td valign="top">
                    <!--Start thống kê-->
                    <div class="div-box">
                        <div id="tabMenuDmPro">
                            <div class="bgg">
                                <ul>
                                    <li id="select_1" class="curent"><a onclick="ajax_cate(1);" style="cursor:pointer"><span>Sản phẩm xem nhiều</span></a></li>
                                    <li id="select_2"><a onclick="ajax_cate(2); home_report('visitor');" style="cursor:pointer"><span>Truy cập web</span></a></li>
                                    <li id="select_4"><a onclick="ajax_cate(4); home_report('referer')" style="cursor:pointer"><span>Web giới thiệu</span></a></li>
                                    <li id="select_5"><a onclick="ajax_cate(5); home_report('search')" style="cursor:pointer"><span>Từ khóa</span></a></li>
                                    <li id="select_6"><a onclick="ajax_cate(6); home_report('article')" style="cursor:pointer"><span>Bài viết</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="space"></div>
                        <div style="display:block; padding: 0 45px; width: 68% ;" id="content_1">
                            <?php  
                                $views = App\Models\product::select('Name','views', 'Link')->Orderby('views', 'desc')->take(10)->get();
                            ?>

                            <table cellpadding="5" id="tb_padding" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse;">
                                <tbody>
                                    <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                                        <td>STT</td>
                                        <td>Sản phẩm</td>
                                        <td>Lượt xem</td>

                                    </tr>
                                    <?php  
                                        $i =0;
                                        
                                    ?>
                                    @foreach($views as $view)   
                                    <?php 
                                        $i++;
                                    ?> 
                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td><a href="{{ route('details', $view->Link) }}" target="_blank">{{ $view->Name }}</a></td>
                                        <td>{{ $view->views }}</td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>    
        
                          
                        </div>
                        <div class="" style="display:none;" id="content_2">
                            <div id="home_report_visitor">
                                <table cellpadding="5" id="tb_padding" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse;">
                                    <tbody><tr bgcolor="#EEEEEE" style="font-weight:bold;">
                                        <td width="40px">STT</td>
                                        <td>Ngày</td>
                                        <td width="140px">Số truy cập</td>
                                    </tr>
                                    <?php 

                                        $data_client = App\Models\viewsite::Orderby('id', 'desc')->take(10)->select('views','updated_at', 'created_at')->get();
                                        $count = 0;
                                    ?>


                                    @foreach($data_client as $views)
                                    <?php 
                                        $count++;
                                    ?>
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $views->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $views->views }}</td>
                                    </tr>
                                    @endforeach
                                
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="" style="display:none;" id="content_3">
                            <div>Sản phẩm mua nhiều nhất trong 30 ngày qua</div>
                            <div id="home_report_product_buy"></div>
                        </div>
                        <div class="" style="display:none;" id="content_4">
                            <div>Website mang người dùng đến</div>
                            <div id="home_report_referer">
                                <table cellpadding="5" id="tb_padding" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse;">
                                    <tbody>
                                        <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                                            <td>STT</td>
                                            <td>Nguồn</td>
                                            <td>Lượt giới thiệu</td>
                                        </tr>

                                        <?php 
                                            $k =0;
                                            $website = App\Models\referer::Orderby('count', 'desc')->take(10)->get();

                                        ?>

                                        @if($website != null)
                                        @foreach($website as $vals)
                                        <?php  $k++; ?>
                                        <tr>
                                            <td>{{ $k }}</td>
                                            <td>{{ $vals->website }}</td>
                                            <td>{{ $vals->count }}</td>
                                        </tr>
                                        @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="" style="display:none;" id="content_5">
                            
                            <div id="home_report_search">
                                <table cellpadding="5" id="tb_padding" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse;">
                                    <tbody>
                                        <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                                            <td>STT</td>
                                            <td>Từ khóa</td>
                                            <td>Lượt tìm kiếm</td>
                                        </tr>
                                        <?php 
                                            $j = 0;
                                            $keyword = App\Models\searchkey::select('search', 'count')->Orderby('count', 'desc')->take(10)->get();
                                        ?>
                                        @if(!empty($keyword))
                                        @foreach($keyword as $values)
                                        <?php $j++; ?>
                                        <tr>
                                            <td>{{ $j }}</td>
                                            <td>{{ $values->search }}</td>
                                            <td>{{ $values->count }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>

                                </table>
                            </div>
                        </div>
                        <div class="" style="display:none;" id="content_6">
                           
                             <?php  

                                $views_post = App\Models\post::select('title','views', 'link')->Orderby('views', 'desc')->take(10)->get();


                            ?>

                            <table cellpadding="5" id="tb_padding" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse;">
                                <tbody>
                                    <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                                        <td>STT</td>
                                        <td>Bài viết</td>
                                        <td>Lượt xem</td>

                                    </tr>
                                    <?php  
                                        $z =0;
                                        
                                    ?>
                                    @foreach($views_post as $views)   
                                    <?php 
                                        $z++;
                                    ?> 
                                    <tr>

                                        <td>{{ $z }}</td>
                                        <td><a href="{{ route('details', $views->link) }}" target="_blank">{{ $views->title }}</a></td>
                                        <td>{{ $views->views }}</td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>        
                        </div>
                    </div>
                    
                    <!--End thống kê-->
                    
                    <!--Start thong bao tu hurasoft-->
                    <div>&nbsp;</div>
                    <div class="pic icon_arrow left"></div>
                    
                    <!--End thong bao tu hurasoft-->
                </td>
                <!--End cot phai-->
            </tr>
        </tbody>
    </table>
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