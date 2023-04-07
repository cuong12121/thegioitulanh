<!doctype html>
<html lang="vi-vn">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="l5L7R0v5Clz_tEvf6c7FuMsH9D3RNKosfYTG12fY0sM" />

       
        @if(!empty($data->Name))

            <?php 
                $title_seo = $data->Name.' - '.'Thế Giới Tủ Lạnh';
               
            ?>
        @else
        
            @if(!empty($name_cate))


                <?php 

                    $title_seo = $name_cate.' chính hãng tại kho - Thế giới tủ lạnh';
                   
                ?>
            
            @endif     
        @endif
        <title>{{ !empty($title_seo)?$title_seo:'Thế Giới Tủ Lạnh - Tổng Kho Tủ Lạnh Chính Hãng, Giá Rẻ'  }}</title>
        <!--meta-->
        <meta name="title" content="Thế Giới Tủ Lạnh - Tổng Kho Tủ Lạnh Chính Hãng, Giá Rẻ"/>
        <meta name="description" content="Thế Giới Tủ Lạnh, mua sắm tủ lạnh online tại thegioitulanh.vn giá rẻ chính hãng phục vụ chuyên nghiệp. Nhiều ưu đãi, giao và lắp đặt miễn phí"/>
        <meta content="document" name="resource-type" />
        <meta content="1800" http-equiv="refresh" />
        <meta name="robots" content="index,follow" />
        <meta name="revisit-after" content="1 days" />
        <meta http-equiv="content-language" content="vi-vn" />
        <!-- <link rel="alternate" type="application/rss+xml" title="RSS Feed for https://dienmayabc.com" href="/product.rss" /> -->
        <meta property="fb:admins" content=""/>
        <meta property="fb:app_id" content="893882260753407" />
        <meta property="og:title" content="Thế Giới Tủ Lạnh - Tổng Kho Tủ Lạnh Chính Hãng, Giá Rẻ" />
        <meta property="og:type" content="website" />
       
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Array
            (
                [name] => home
                [view] => home
                [view_id] => 0
            )
            1 -->
        <!--style-->
        <link rel="shortcut icon" href="{{ asset('media/banner/cropped-logo.png')  }}">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{ asset('template/default/script/style.css') }}" rel="stylesheet">

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-E1HRZPN7JD"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-E1HRZPN7JD');
        </script>

        
        <style type="text/css">
            #ui-id-1{
                z-index: 999 !important;
                background: #fff;
                width: 20%;
            }

            .icon-mobile-bar{
                display: none;
            }



            @media only screen and (max-width: 768px) {

                .wrap{
                    width: 100% !important;
                }
                .header{
                    display: none;
                }
                .menu-top li{
                    width: 100%;
                }
                .icon-mobile-bar{
                    display: block;
                }

                .wrap ul{
                    display: none;
                    height: 258px;
                }

                .headers .wrap{
                    background: #DFA99E;
                }

                .wrapper{
                    min-width: 100% !important;
                }

            }  


            @media only screen and (min-width: 769px) {

                .headers{
                    display: none;
                }

            }    
 
        </style>

         @stack('css')
    </head>
    <body class="module-home view-home">
        <script src="{{  asset('http://code.jquery.com/jquery-1.10.2.js') }}"></script>

        <!-- <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
        <div class="wrapper">
            <div class="header">
                <meta name="google-site-verification" content="VZ6xUK4LvjzzKg4DnXDrU0eGXa37Bk4IGdXP8cUFcZ0" />
                <div class="wrap">
                    <a class="logo" href="/">
                        <h1 class="format"><img alt="thegioitulanh" src="{{ asset('media/banner/cropped-logo.png')  }}"/></h1>
                    </a>
                    <div class="box-search search">
                        <form method="get" action="{{ route('search-product-frontend') }}" enctype="multipart/form-data" name="searchForm">
                            <input name="key" id="ip1" class="ip1" value="" placeholder="Tìm sản phẩm, danh mục hay thương hiệu mong muốn..." />
                            <input class="btn" value="Tìm kiếm" type="submit" />
                        </form>
                        <div class="search-results">
                            <div class="search-results-list"></div>
                            <a href="javascript:;" onclick="document.searchForm.submit();" class="vmore-result">Xem thêm kết quả</a>
                        </div>
                    </div>
                    <div class="hotline">
                        Gọi đặt mua:
                        <span>096 884 5875</span>
                    </div>
                    <!-- <div class="account">
                        <i class="fa fa-user"></i>
                        <span><a rel="nofollow" href="/dang-nhap">Đăng nhập</a></span>
                        <a rel="nofollow" href="/taikhoan">
                        Tài khoản và đơn hàng
                        </a>
                    </div> -->

                    <?php 
                        $cart = Gloudemans\Shoppingcart\Facades\Cart::content();
                                                    
                        $number_cart_home = count($cart);

                    ?>
        
                    <div class="cart">
                        <a href="{{ route('cart-tgtl') }}" rel="nofollow"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                        <span id="count_shopping_cart_store">{{ $number_cart_home  }}</span>
                        </a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>


            <div class="headers">
               
                <div class="wrap">
                    <a class="logo" href="/">
                        <h1 class="format"><img alt="thegioitulanh" src="{{ asset('media/banner/cropped-logo.png')  }}"/></h1>
                    </a>
                   
                   

                    <?php 
                        $cart = Gloudemans\Shoppingcart\Facades\Cart::content();
                                                    
                        $number_cart_home = count($cart);

                    ?>
        
                    <div class="cart">
                        <a href="{{ route('cart-tgtl') }}" rel="nofollow"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                        <span id="count_shopping_cart_store">{{ $number_cart_home  }}</span>
                        </a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
          
            <div class="navigation">
                <div class="wrap menu-top">

                    <div class="icon-mobile-bar"><button><i class="fa fa-bars" aria-hidden="true"></i></button></div>
                    <ul>
                        <?php 
                            $listmenu = App\Models\groupProduct::where('parent_id', 35)->where('active', 1)->get();
                        ?>
                        @if($listmenu->count()>0)
                        @foreach($listmenu as $val)
                        <li>
                            <a href="{{ route('details', $val->link) }}">
                                <h2>{{ $val->name }}</h2>
                            </a>

                            <?php 
                                $listmenu1 = App\Models\groupProduct::where('parent_id', $val->id)->where('active', 1)->get();


                            ?>

                            <ul class="child">

                                @if($listmenu1->count()>0)
                                @foreach($listmenu1 as $val1)
                                <li>
                                    <ul class="group">
                                        <li class="name"><a href="{{ route('details', $val1->link) }}">{{ $val1->name }}</a></li>
                                        
                                    </ul>
                                    
                                </li>

                                @endforeach
                                @endif
                            </ul>

                            
                        </li>
                        @endforeach
                        @endif
                        
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
            <!--//navigation-->
            

        

            @yield('content')
        

            <div class="clear"></div>
            <div class="footer">
                <!-- <div class="wrap">
                    <div class="infor">
                        <p class="name txt_b">Mua Hàng Trực Tuyến </p>
                        <div class="img">
                            <img src="/media/lib/789_favicon.png" alt="" width="80" alt=""/>
                        </div>
                        <div class="cont txt_555 line_h22">
                           chúng tôi tích lũy kinh nghiệm hơn 20 năm, ấp ủ mong muốn mang những sản phẩm điện máy có chất lượng tốt, thân thiện với môi trường, thân thiện với cuộc sống của người dân Việt,  với mong muốn giúp người tiêu dùng Việt có được cuộc sống Tiện nghi – Thân thiện một cách đơn giản nhất.
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div> -->
                <!--//infor-->
                <div class="ft-column">
                    <div class="wrap">
                        <ul class="ft-group">
                            
                            <li><a href="#">Giới thiệu công ty</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                            <li><a href="#">Liên hệ góp ý</a></li>
                        </ul>
                        <ul class="ft-group">
                            <li class="name">Chính sách và quy định</li>
                            <li><a href="/chinh-sach-bao-mat">Chính sách bảo mật</a></li>
                            <li><a href="/chinh-sach-giao-hang">Chính sách vận chuyển</a></li>
                            <li><a href="chinh-sach-kiem-hang.html">Chính sách kiểm hàng</a></li>
                            <li><a href="/chinh-sach-doi-hang">Chính sách đổi hàng</a></li>
                            <li><a href="/chinh-sach-bao-hanh">Chính sách bảo hành</a></li>
                            <li><a href="/quy-dinh-thanh-toan">Quy định thanh toán</a></li>
                        </ul>
                        
                        
                      
                        <div class="clear"></div>
                    </div>
                    <div class="space10px"></div>
                    <div class="space5px"></div>
                    
                </div>
              
            </div>
            <a href="tel:0968845875" class="icon-call transition"><img src="/template/default/images/icon_goi-ngay_pc.png?v=1.1.1" style="max-width:122px;" alt=""></a>  
        </div>

        <!--Start of Tawk.to Script-->
        
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6010479ac31c9117cb72acf0/1esvpfdes';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->

        <div id="toTop" title="Lên đầu trang" class="transition"></div>

        @stack('js')

        <script defer src="/template/default/script/plugin.js?v=2.2.21"></script>
        <script defer src="/template/default/script/init.js?v=2.2.21"></script>
        <!--//end: plugin-->
        <!---global-->
        
        <script>
            $(document).ready(function(){ 
            $("input.p_check").click(function(){
            if($("input.p_check").is(":checked")){
            $("#compare_area_home").fadeIn();
            }else{
            $("#compare_area_home").fadeOut();
            } 
            });
            });
        </script>
        <input type="hidden" id="product_compare_list" value="" />
        
        <!---//script homepage-->
        <script>
            $(document).ready(function(){
            $('.bxhome').bxSlider({
            auto: true,
            autoControls: false
            });
            });
        </script>  



        <script type="text/javascript">
            $(document).ready(function(){
                $(function() {
                    $("#ip1").autocomplete({


                        minLength: 2,
                        
                        source: function(request, response) {
                            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }


                            });
                            $.ajax({

                               
                                url: "{{  route('sugest-click')}}",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    product:$('#ip1').val()
                                },
                                dataType: "json",
                                success: function (data) {

                                    var items = data;

                                    response(items);

                                    $('#ui-id-1').html();

                                    $('#ui-id-1').html(data);
                                
                                }
                            });
                        },
                        html:true,
                    });
                });


                $('.icon-mobile-bar button').click(function () {

                    if($('.menu-top ul').is(":visible")){

                        $('.menu-top ul').hide();
                    }
                    else{
                         $('.menu-top ul').show();
                    }

                })
            });    
        </script>
       
       
    </body>
</html>
