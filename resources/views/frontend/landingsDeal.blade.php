@extends('frontend.layouts.apps')

@section('content') 
    @push('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=11">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=10"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}?ver=3">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homes.css') }}?ver=5">
        <style type="text/css">
           /* deal*/

            .actives-click{
                color: red !important;
            }

           .sale-time-flash{
                margin-bottom: 10px;
           }
           .text-er{
                font-weight: bold;
           }

           .div-pd{
            padding: 15px 0;
           }

            .actives{
                background: #fff;
            }

            .titles-time{
               /* border-top: 2px solid #ff9;*/
                margin-top: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
               /* background-color: #fb0707;*/
                margin-bottom: 7px;
                display: block;
                width: 100%;
                height: 80px;
            }

            .titles-time h3 {
                margin: 0;
                display: inline-block;
                color: #000000;
                font-size: 18px;
                text-transform: uppercase;
                padding: 0 13px;
                vertical-align: -3px;
                float: left;
                /*background-color: #ffea26;*/
                padding: 5px 13px;
                border-radius: 4px;
                
                cursor: pointer;
            }


            .titles-time .cat-child {
                padding: 2px 0;
                display: inline-block;
                margin-left: 2px;
            }

            .titles-time .cat-child a {
                line-height: 36px;
                color: #000000;
                background-color: #ff9;
                padding: 11px 10px;
                border-radius: 4px;
            }

            .titles-time .cat-child li {
                float: left;
                padding-right: 8vw;
            }

            /*.titles-time .minutes{
                font-weight: normal;
                color: #000;
            }*/




            .div-title-news{
                margin-bottom: 10px;
            }
            .texts p {
                height: 50px;
                line-height: 32px !important;
                padding-left: 10px;
            }   

            .col1-big-img img{
               /* width: auto !important;*/
            }
            .col1-big-img{
                text-align: center;
            }
            .big-title-href{
                height: 100%;
            }
            .result-labels{
                /*position: absolute ;
                left: 0;*/
                margin-bottom: 10px;
            }
            .icon_sale{
                
                padding: 3px;
                border-radius: 2px;
                font-size: 10px;
                color: #000;
                position: absolute;
                left: 10px;
                bottom: 30%;
                z-index: 1;
            }

            .flash-sale .flash-product .col-flash-2 .item .desc {
                width: 100%;
            }    

             .items-title .name {
                margin-top: 10px;
                height: 45px;
            }


           

            @media screen and (max-width: 767px) {
                .result-labels{
                    top: 43%;
                   
                } 

                .lists{
                    padding-right: 0 !important;
                }

                .lists .item{
                    width: 100%;
                    overflow: hidden;
                }

                .div-pd a{
                    text-decoration: none;
                }

                .flash-sale .item .img {
                    width: 100% !important;
                }    

                .flash-sale .item img {
                    position: relative;
                    top: 50%;
                    transform: inherit;
                    width: 100% !important;
                }  

                .flash-sale .flash-product .col-flash-2 .item {
                    display: block;
                }    

                .flash-sale .flash-product .col-flash-2 .item .desc {
                    padding: 0 !important;
                    text-align: center;
                 }   

                .titles-time h3 {
                    font-size: 10px;
                   
                }     
                .text-promotion{
                    font-size: 1.2em !important;
                }

                .titles-time .cat-child li{
                    padding: 0 0.8vw !important;
                }
                .banner-outer{
                    margin-bottom: 10px
                }

                .cIVWIZ{
                    background-repeat: no-repeat;
                    background-size: 100%;
                    padding-top: 78px !important;
                }
                .btn-buys{
                    display: none;
                }

                 .btn-buys{
                    display: none;
                }
                .navbar-collapse{
                    display: flex;
                }
                #navbarNavAltMarkup {
                     height: auto !important; 
                }
                .items-title span{
                    font-size: 16px !important;
                }
                .btn-buy-price{
                    width: 100% !important;
                }

            }

             @media screen and (min-width: 768px) {
                .titles-time h3 {
                    line-height: 29px;
                    margin-left: 10px;
                }  

                .flash-sale .flash-product .col-flash-2 .item .desc {
                    padding: 0;
                    
                }     

                .flash-sale .flash-product .col-flash-2 .item {

                    display: block;
                } 

                .flash-sale .flash-product .col-flash-2 .item .img {

                    width: auto;
                    height: 10vw;
                }  

               
                .result-labels{
                    top: 53%;
                   
                } 
                .homebanners{

                    height: auto;
                } 
                .homebanner{
                    height: auto;
                }   

                #sync1  .owl-item img {
                    height: 100% !important;
                    width: 100% !important;
                } 

                #sync1 .item img{
                    height: auto !important;
                }   


            }

            .banner-outer {
                height: 50px;
                position: sticky;
                top: calc(var(--banner-height-difference) * -1);
                display: flex;
                align-items: center;
                background-color: #fff;
                z-index: 1;
            }

            .banner-inner {
                height: 50px;
                position: sticky;
                margin: 0 auto;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                line-height: 1.25;
                width: 50%;
                background: #ffc75f;
                border-radius: 10px;
                border: 1px solid;
            }
            .text-promotion{
                font-size: 30px;
                font-weight: bold;
                color: #153464;
                text-transform: uppercase;
            }
        </style>

       
    @endpush
    <div class="locationbox__overlay"></div>
    <div class="locationbox">
        <div class="locationbox__item locationbox__item--right" onclick="OpenLocation()">
            <p>Chọn địa chỉ nhận hàng</p>
            <a class="cls-location" href="javascript:void(0)">Đóng</a>
        </div>
        <div class="locationbox__item" id="lc_title"><i class="icondetail-address-white"></i><span> Vui lòng đợi trong giây lát...</span></div>
        <div class="locationbox__popup" id="lc_pop--choose">
            <div class="locationbox__popup--cnt locationbox__popup--choose">
                <div class="locationbox__popup--chooseDefault">
                    <div class="lds-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
        <b id="h-provincename" style="display:none!important" data-provinceid="3">Hồ Chí Minh</b>
    </div>
    <div class="locationbox__popup new-popup hide" id="lc_pop--sugg">
        <div class="locationbox__popup--cnt locationbox__popup--suggestion new-locale">
            <div class="flex-block">
                <i class="icon-location"></i>
                <p>Hãy chọn <b>địa chỉ cụ thể</b> để chúng tôi cung cấp <b>chính xác</b> th&#x1EDD;i gian giao h&#xE0;ng v&#xE0; t&#xEC;nh tr&#x1EA1;ng h&#xE0;ng.</p>
            </div>
            <div class="btn-block">
                <a href="javascript:;" class="btn-location" onclick="OpenLocation()"><b>Chọn địa chỉ</b></a>
                <a href="javascript:;" class="btn-location gray" onclick="SkipLocation()"><b>Đóng</b></a>
            </div>
        </div>
    </div>

    <div class="homebanner-container">
        <!-- Banner chính -->
        <aside class="homebanner">
            <div id="sync1" class="slider-banner owl-carousel homebanners">
                <div class="item">
                    <a aria-label="slide" data-cate="0" data-place="1535" href="#"><img  src="https://dienmaynguoiviet.vn/uploads/banner/1660814133_1660797773_THAY-DOI-DIEN-MAO-MOI.png"  data-src="https://dienmaynguoiviet.vn/uploads/banner/1660814133_1660797773_THAY-DOI-DIEN-MAO-MOI.png" alt="Thay diện mạo - Nhiệt tình giảm giá"  ></a>
                </div>
            
            </div>
           
        </aside>
        <!-- End -->
    </div>

    <br>

    <?php 
       $now  = Carbon\Carbon::now();
        // $now  = \Carbon\Carbon::createFromDate('9-11-2022, 11:00');

        $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;
        $date_flashdeal = \Carbon\Carbon::create($date_string_flash_deal);

        $deal = Cache::get('deals')->sortByDesc('order');

        $add_date = $date_string_flash_deal;
        $time1_start = \Carbon\Carbon::createFromDate($add_date.', 9:00');
        $time1 = \Carbon\Carbon::createFromDate($add_date.', 12:00');
        $time2_start = \Carbon\Carbon::createFromDate($add_date.', 12:00');
        $time2 = \Carbon\Carbon::createFromDate($add_date.', 14:00');
        $time3_start = \Carbon\Carbon::createFromDate($add_date.', 14:00');
        $time3 = \Carbon\Carbon::createFromDate($add_date.', 17:00');
        $time4_start = \Carbon\Carbon::createFromDate($add_date.', 17:00');
        $time4 = \Carbon\Carbon::createFromDate($add_date.', 22:00');
        $define = [['start'=>'9h', 'endTime'=>$time1, 'startTime'=>$time1_start], ['start'=>'12h', 'endTime'=>$time2, 'startTime'=>$time2_start], ['start'=>'14h', 'endTime'=>$time3, 'startTime'=>$time3_start], ['start'=>'17h', 'endTime'=>$time4, 'startTime'=>$time4_start]];
    ?>

    @if($date_flashdeal->isToday())
    <section>

     <style type="text/css">

            .container-productbox{

                overflow: hidden;
            }


            .bg-light {
                background-color: #414142 !important;

                height: 64px;
            }
            .UCDJ9O {
                font-size: 1.5rem;
            }

            .navbar-nav{
                height: 80% !important;
            }
            .higiZo {
                text-transform: capitalize;
            }
            .oNZiNS {
                text-decoration: none;
                color: rgba(0,0,0,.87);
                display: block;
                background: #414142;
                color: #c3c3c3;
                display: flex;
                flex-direction: column;
                height: 3rem;
                justify-content: center;
                position: relative;
                text-align: center;
            }

            .navbar{
                width: 100%;
            } 

            .cIVWIZ, .zuQWXW {
                padding-top: 240px;
            }

            .VUCDM7 {
                width: 1200px;
                margin: 20px auto;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
            }
            .B3\+pb\+ {
                box-shadow: 0 1px 1px 0 rgb(0 0 0 / 5%);
                border-radius: 0.125rem;
                overflow: hidden;
                background-color: #fff;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                position: relative;
                margin-bottom: 10px;
                z-index: 1;
            }

            .PMpbYz {
                text-decoration: none;
                color: rgba(0,0,0,.87);
                display: block;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .cmjSHU, .qifRic {
                width: 280px;
                height: 280px;
            }

            .FSzItq {
                margin: 5px auto;
                position: relative;
            }

            .items-title span{
                font-size: 18px;
            }
            .div-pd{
                margin: 0 auto;
            }
            .list-pro{
                background: #F5F5F5;
            }
            .items-title{
                background: #fff;
            }
            .items-title span{
                color: #000;
            }
            .items-title{
                padding: 0 15px;
            }
            .navbar-light{
                padding: 0;
            }
            .actives{
                background: #ee4d2d;
                color: #fff !important;
            }
            .actives .UCDJ9O, .actives .higiZo{
                color: #fff !important;
            }




            .X7gzZ7 {
                background-color: rgba(255,212,36,.9);
            }

            .aS\+-QV {
                -webkit-transform: scale(1.4);
                transform: scale(1.4);
                padding: 7px 8px;
                font-weight: 400;
                position: absolute;
                top: 0;
                right: 0;
                z-index: 3;
            }


            .yV54ZD {
                width: 36px;
                height: 32px;
            }

            ._8PundJ {
                display: flex;
                flex-direction: column;
                text-align: center;
                position: relative;
                font-weight: 400;
                line-height: .8125rem;
                color: #ee4d2d;
                text-transform: uppercase;
                font-size: .75rem;
            }

            ._5ICO3M {
                display: inline-block;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                position: relative;
                padding: 4px 2px 3px;
                font-weight: 700;
            }

            .tSV5KQ {
                color: #fff;
            }

            .X7gzZ7:after {
                content: "";
                width: 0;
                height: 0;
                left: 0;
                bottom: -4px;
                position: absolute;
                border-color: transparent rgba(255,212,36,.9);
                border-style: solid;
                border-width: 0 18px 4px;

                width: 50px;
            }
            .__cate_1942{
                position: relative;
            }

            .X7gzZ7{
                position: absolute;
                top: 0;
                right: 0;

                width: 50px;
            }

            .yV54ZD {
                
                height: 40px;
            }
            .IKgh3U {
                
                color: rgba(0,0,0,.13);
                text-decoration: line-through;
                margin: 10px 0;
            }
            .price{
                font-size: 23px;
                font-weight: normal;
                color: #ee4d2d;
            }
            .price-sale{
                display: flex;
            }

            .btn-buys{
                line-height: 51px;
                width: 40%;
                text-align: right;

            }
            .btn-buys button{
                 font-size: 13px;
                height: 42px;
               width: 94%;
            }
            .btn-buy-price{
                width: 60%;
            }

            .btn-buy-click{
                background: #ee4d2d;
                border: 0;
            }
            .qOgYxF span{
                color: #ddd;
            }

            .lists{
                height: 325px;
            }
            .lists .item{
                height: 97%;
                background: #fff;
            }

            .progress {
                background-color: #FDBCA8;
                border-radius: 8px;
                position: relative;
               
                height: 12px;
                width: 100%;
                margin-top: 10px;
            }

            .progress-done {
                background: #E91B24;
                box-shadow: 0 3px 3px -5px #F2709C, 0 2px 5px #F2709C;
                border-radius: 20px;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                width: 0;
                opacity: 0;
                transition: 1s ease 0.3s;
            }

            .cIVWIZ{
                max-width: 1200px;
            }
            #navbarNavAltMarkup{
                height: 80px;
            }
            .navbar-nav{
                height: 100%;
            }
            .item-img_1942{
                text-align: center;
            }

            .items-title .name{
                margin-top: 10px;
            }

        </style>


        <?php 
            $saleFlash = DB::table('flash_deal')->get();
        ?>

        @foreach($saleFlash as $keys => $vals)

        
        @if($now < $time4)


            <?php 

                $groups_deal = 0;
                $k = 0;

                $flashDeal = App\Models\flashdeal::where('flash_deal_id', $vals->id)->where('flash_deal_time_id', 1)->where('active',1)->OrderBy('order','desc')->take(4)->get();

                       // Khi chưa đến giờ flashdeal kiểm tra để hiển thị deal

                $checksoon = 1;

            ?>


            <a href="{{ route('show-flash-deal') }}" target="_blank"><div class="container cIVWIZ" style="background-image: url(https://dienmaynguoiviet.vn/uploads/banner/1668001535_9ec673f17e637893c11a2a983045e7c6.jpg);"></div></a>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
       
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                   
                    @foreach($define as $key => $value)

                    @if($now<$value['endTime'])

                        <?php 
                            $k++;
                           
                            if($now->between($value['startTime'], $value['endTime'])){

                                $timestamp = $now->diffInSeconds($value['endTime']);
                                $hour =  floor($timestamp/3600);
                                $timestamp = floor($timestamp % 3600);
                                $minutes =floor($timestamp/60);
                                $timestamp = floor($timestamp % 60);
                                $seconds =floor($timestamp);

                                $groups_deal = $key;

                                $groups_deal+=1;


                                $flashDeal = App\Models\flashdeal::where('flash_deal_id', $vals->id)->where('flash_deal_time_id', $groups_deal)->where('active',1)->get();

                                 $checksoon = 0;
                            }

                    ?>  

                    
                    <div class="navbar-nav col-md-3 {{  $k==1?'actives':'' }} active_{{ $key+1 }}">
                        <div class="nav-item nav-link active div-pd" > 
                            <div>
                                <a class="deal{{ $vals->id }}" href="javascript:void(0)" onclick="clickDeal({{ $vals->id }},{{ $key+1 }}, {{ $k }})">
                                    <div class="UCDJ9O">{{ $value['start'] }}</div>
                                    <div class="higiZo">{{ $now->between($value['startTime'], $value['endTime'])?'Đang diễn ra':'sắp diễn ra'}}</div>
                                </a>
                            </div>
                        </div>


                    </div>

                     @endif
                    @endforeach
                   
                </div>
            </nav>

           

        <div class="container-productbox">

            <div class="row list-pro listpd">



                @foreach($flashDeal as $key => $value)

                                
                <div class="col-md-3 col-6 lists">
                    <div class="item  __cate_1942">
                        
                            
                            <div class="item-img item-img_1942"> <a href="{{ route('details', $value->link) }}" data-box="BoxCate" class="main-contain"><img class="thumb lazyloaded" data-src="{{ asset($value->image) }}" alt="Smart Tivi LG 75UQ8050PSB 75 inch 4K" style="width:auto; height: 184px;" src="{{ asset($value->image) }}" ></a> </div>
                            <div class="items-title">
                                <div class="name">
                                    <a href="{{ route('details', $value->link) }}" data-box="BoxCate" class="main-contain">
                                     <span> {{ $value->name }} </span>
                                    </a> 
                                </div>

                                <div class="IKgh3U"><div class="qOgYxF"><span>{{ @str_replace(',' ,'.', number_format($value->price)) }}</span><span class="-92Xgq">₫ </span></div></div>
                                <div class="price-sale">
                                    <div class="btn-buy-price">
                                        <?php 
                                            $str_len[7] = '?.???.000';
                                            $str_len[8] = '??.???.000';
                                            $str_len[9] = '???.???.000';

                                        ?>   

                                       


                                          @if($vals->price !=0)
                                        <strong class="price">{{ $checksoon ==1?'???.000':@str_replace(',' ,'.', number_format($vals->price)) }}&#x20AB</strong>
                                         @else

                                         <?php 
                                             $price_strlen = $str_len[strlen($value->deal_price)]??'???.000';
                                         ?>
                                         <strong class="price">{{   $checksoon ==1?$price_strlen:@str_replace(',' ,'.', number_format($value->deal_price)) }} &#x20AB</strong>
                                         @endif
                                        <div class="progress">

                                            <div class="progress-done" data-done="70">
                                                70%
                                            </div>
                                        </div>



                                    </div>
                                    <div class="btn-buys">
                                        <button type="button" class="btn btn-danger btn-buy-click" onclick="addToCart({{ $value->product_id }})">Mua ngay</button>
                                    </div>
                                    
                                </div>
                                
                               
                            </div>
                       
                        <div class="item-bottom"> <a href="#" class="shiping"></a> </div>

                        @if($checksoon==0)

                        <?php 
                            $percent = floor((intval($value->price)- intval($value->deal_price))/intval($value->price)*100);
                        ?>
                            @if($percent>0)
                                <div class="_5ICO3M yV54ZD X7gzZ7">
                                    <div class="_8PundJ"><span class="percent">{{ $percent }}%</span><span class="tSV5KQ">giảm</span></div>
                                </div>
                            @endif
                        @endif
                        <!-- <a href="javascript:void(0)" class="item-ss"> <i></i> So sánh </a> --> 
                    </div>
                </div>

                @endforeach

                

            </div>
            <!-- <div class="view-more "> <a href="javascript:;">Xem thêm <span class="remain">133</span> Tivi</a> </div> --> 
        </div>

        @endif
        @endforeach

    @endif    

    </section>
   
    <!-- End -->
    <!-- Hiệu ứng ... rơi -->
    <!-- <div class="falling-container" aria-hidden="true">
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
    </div> -->
    <!-- End -->
    
    
     <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @if (session('success'))


        <script type="text/javascript">
            swal({ title: '{{ session("success") }}', type: 'success' });
          
        </script>
        <?php
        Session::forget('success');
        ?>

        
    @endif



    @if(!empty($deal))
    
    @push('script')

    
        <script type="text/javascript">
            


            loop = {{ $deal->count() }};

            times = [];
                      
            time = {{ $timestamp??15500 }};
            number_deal_product =10;
            //in time 
          
            setInterval(function(){
                for (var i = 0 ; i < loop; i++) {
                    run(i);
                }

                @foreach($define as $key => $value)

                runs('.key{{ $key }}');

                @endforeach
                
                
            }, 1000);

            function runs(key) {

                var hour =  $(key+' .hour').text();
                var minutes =  $(key+' .minutes').text();
                var second =  $(key+' .second').text();


                h =  parseInt(hour);
                m = parseInt(minutes);
                s = parseInt(second);
                s--;
                /*BƯỚC 1: CHUYỂN ĐỔI DỮ LIỆU*/
                  // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
                  //  - giảm số phút xuống 1 đơn vị
                  //  - thiết lập số giây lại 59
                if (s === -1){
                      m -= 1;
                     
                      s = 59;
                }

                // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
                //  - giảm số giờ xuống 1 đơn vị
                //  - thiết lập số phút lại 59
                if (m === -1){
                    h -= 1;
                    m = 59;
                }

                hour =  h.toString();

                minutes =  m.toString();
                
                seconds =  s.toString();
              
                let currentHour = h<10?'0'+hour:''+hour;
                let currentMinutes = m<10?'0'+minutes:''+minutes;
                let currentSeconds = s<10?'0'+seconds:''+seconds;

        
                let currentTimeStr ='<span class="hour">'+ currentHour+'</span>:<span class="minutes">'+currentMinutes+'</span>:<span class="second">'+currentSeconds+'</span>';
                $(key+' .clock').html(currentTimeStr);
            }  

            function addToCart(id) {
    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            
                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart') }}",
                    data: {
                        product_id: id,
                        gift_check:$('#gift_checked').val()
                           
                    },
                    beforeSend: function() {
                       
                        $('.loader').show();

                    },
                    success: function(result){
            
                       //  numberProductCart = $(".number-cart").text();
            
                       //  console.log(numberProductCart);
                       
                       // numberCart = result.find(numberProductCart);
            
                        $('#tbl_list_cartss').append(result);
            
                        const numberCart = $('#number-product-cart').text();
            
                        $('.number-cart').text(numberCart);
            
                        $('#exampleModal').modal('show'); 
                        $('.loader').hide();
                        
                    }
                });
            }  


            function clickDeal(flash_deal_id, id, dem) {

                // $(this).addClass('actives');

                classname =  $(this).attr('class');

                $('.deal'+flash_deal_id+' h3').removeClass('actives-click');

                $('.deal'+flash_deal_id+' .active_'+id).addClass('actives-click');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('showDealClick') }}",
                    data: {
                        product_id: id,
                        flash_deal_id:flash_deal_id,
                        key:dem,
                           
                    },
                    success: function(result){
                       // numberCart = result.find($("#number-product-cart").text());

                       $('.deal-view'+flash_deal_id).html(result);

                        var owl = $('.deal-view'+flash_deal_id+' .flash-sale-banner');
                        owl.owlCarousel({
                            loop:false,
                            margin:10,
                            nav:true,
                            dots:false,
                            autoplay:false,
                            
                            navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
                            responsive:{
                                0:{
                                    items:2
                                },

                                 600:{
                                    items:2
                                },
                               
                                1000:{
                                    items:4
                                }
                            }
                        });
                    }
                });    
            }

            function run(key) {
                var hour =  $('.time'+key+' .hourss').text();
                var minutes =  $('.time'+key+' .minutess').text();
                var second =  $('.time'+key+' .secondss').text();
                h =  parseInt(hour);
                m = parseInt(minutes);
                s = parseInt(second);
                s--;
                /*BƯỚC 1: CHUYỂN ĐỔI DỮ LIỆU*/
                  // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
                  //  - giảm số phút xuống 1 đơn vị
                  //  - thiết lập số giây lại 59
                if (s === -1){
                      m -= 1;
                     
                      s = 59;
                }

                // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
                //  - giảm số giờ xuống 1 đơn vị
                //  - thiết lập số phút lại 59
                if (m === -1){
                    h -= 1;
                    m = 59;
                }

                 if (h < 0){
                    $('.time'+key).remove();

                    priceSet =  $('.desc-deal'+key+' .price-old').text();

                    $('.desc-deal'+key+' .price-old').css('text-decoration','none');

                    $('.desc-deal'+key+' .price-new').text(priceSet);

                  }  

                hour =  h.toString();

                minutes =  m.toString();
                
                seconds =  s.toString();
                $('.time'+key+' .hourss').text(h<10?'0'+hour:''+hour);
                $('.time'+key+' .secondss').text(s<10?'0'+seconds:''+seconds);
                $('.time'+key+' .minutess').text(m<10?'0'+minutes:''+minutes); 
            }
           
                                                                                                                                                                     
            if(window.innerWidth>768){
                $('.bar-top-lefts').show();
            } 


            $('.banner-sale').owlCarousel({
                loop:true,
                items:2.5,
                margin:10,
                nav:true,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                responsive:{
                    0:{
                        items:2.5
                    },
                    600:{
                        items:2.5
                    },
                    1000:{
                        items:5
                    }
                }
            });
           
           
            $('.homebanners').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                // dots:true,
                // dotsData: true,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                responsive:{
                    0:{
                        items:1
                    },

                     600:{
                        items:1
                    },
                   
                    1000:{
                        items:1
                    }
                }
            });

            $('.flash-sale-banner').owlCarousel({
                loop:false,
                margin:10,
                nav:true,
                dots:false,
                autoplay:false,
                
                navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
                responsive:{
                    0:{
                        items:2
                    },

                     600:{
                        items:2
                    },
                   
                    1000:{
                        items:4
                    }
                }
            });


            function clickDeal(flash_deal_id, id, dem) {


                $('#navbarNavAltMarkup .navbar-nav').removeClass('actives');


                $('.active_'+id).addClass('actives');

                // classname =  $(this).attr('class');

                // $('.deal'+flash_deal_id+' h3').removeClass('actives-click');

                // $('.deal'+flash_deal_id+' .active_'+id).addClass('actives-click');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('showDealClick') }}",
                    data: {
                        product_id: id,
                        flash_deal_id:flash_deal_id,
                        key:dem,
                        checksoon:{{ $checksoon??1 }}
                           
                    },
                    success: function(result){
                       // numberCart = result.find($("#number-product-cart").text());

                       $('.listpd').remove();

                       // console.log(result);

                       $('.container-productbox').append(result);


                        // var owl = $('.deal-view'+flash_deal_id+' .flash-sale-banner');
                        // owl.owlCarousel({
                        //     loop:false,
                        //     margin:10,
                        //     nav:true,
                        //     dots:false,
                        //     autoplay:false,
                            
                        //     navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
                        //     responsive:{
                        //         0:{
                        //             items:2
                        //         },

                        //          600:{
                        //             items:2
                        //         },
                               
                        //         1000:{
                        //             items:4
                        //         }
                        //     }
                        // });
                    }
                });    
            }

            if ($(window).width < 600){
            

                $('#navbarNavAltMarkup').removeClass('collapse');

            }
        </script>
        @endpush
     

    @else
    <!-- end check flashdeal theo thời gian thực -->
    <div style="text-align: center;"><h3 class="text-er">Chưa đến thời gian Deal, xin vui lòng quay lại sau</h3></div> 
    @endif 
@endsection      