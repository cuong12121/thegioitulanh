@extends('frontend.layouts.apps')

@section('content')
        <style type="text/css">
            
            
            .header__cart {
                border: 0 !important;
            }    
            .content-1 {

                background-position: unset !important;
            }  
            .listproduct .item{
                position: relative;
            }  
            
        </style>

         <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}"> 
       
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/deal.css') }}">
       
       
        <style>
           
            .priority .item .item-img img {height: auto;}ul li .iconup img {
            height: 18px !important;
            }
            .icon-star-half {
            background-repeat: no-repeat;
            display: inline-block;
            line-height: 30px;
            vertical-align: middle;
            background-size: 300px 250px;
            background-position: -280px -1px;
            height: 12px;
            width: 13px;
            }
            .multiple-hotsale .normal .list-time-fs li.w280, .multiple-hotsale .normal .list-time-fs li.w280 .cate-tab img {
            width: 280px;
            }
            .cache .fs .cate li {
            padding-bottom: 55px;
            }
            .owl-theme .owl-controls .owl-buttons div {
            top: -365px;
            }
            .title-product {   
            height: 50px;
            line-height: 22px;
            }
            span.prop {
            font-size: 19px;
            line-height: 25px;
            }
            .wrapper.content-2 .cache._posi > h3 {
            height: 135px!important;
            }
            .multiple-hotsale .normal .list-time-fs li.tab1 {
            width: calc(9% - 4px);
            }
            .wrapper.content-2 .cache._posi {
            margin-top: 40px;
            }
            .scroll-menu._17thBD>a:nth-child(1), .scroll-menu._17thBD>a:nth-child(2), .scroll-menu._17thBD>a:nth-child(3), .scroll-menu._17thBD>a:nth-child(4), .scroll-menu._17thBD>a:nth-child(5), .scroll-menu._17thBD>a:nth-child(6), .scroll-menu._17thBD>a:nth-child(7) {
            width: calc(100%/5 - 110px) !important;
            margin: 0 44px;
            }
            .scroll-menu._17thBD>a:nth-child(4), .scroll-menu._17thBD>a:nth-child(6) {
            display: none;
            }
            .scroll-menu._17thBD {    
            text-align: center;
            }
            .scroll-menu{display:none;}
            a#hc-link {
            top: 26%;
            right: calc((100% - 1200px)/2 + 267px);
            height: 25px;
            width: 88px;
            }
            .one4all.fs {
            background: #AF1622;
            }
            .wrapper .sticky-menu-top a.active {
            background-color: #AF1622;
            border: 1px solid #AF1622;
            }
            .item-img.item-img_2002 img {
            margin-top: 15px;
            width: 100%;
            width: 100%;
            }

            .item-img_1942{

                height: 220px;
                line-height: 220px;
            }

            .prodCol_5 .item-img img{
                max-width: 100%;
                height: auto;
            } 

            .bg-desktop{
                background-size: 100%;
                height: 5in;
            }

            .priority .item {

                background-image: url('{{ asset("images/background-image/fsfsfsfsa.jpg")  }}');
            }

            @media screen and (max-width:768px) {

                .priority .item {

                    background-image: none;
                }
                
                .icon_tragop {
                    right: 35px;
                    top: 77px;
                }   
                .priority .item {
                    padding: 0;
                 }
                 .priority .item a .item-img { 
                    width: auto;
                 }
                 .item-img_1942 {
                   
                    line-height: 300px;
                }  
                .priority .item h3 {
                    width: 100%;
                }  
               
                .priority .item .item-img img {
                    
                    width: 100%;
                } 
                .list-child{
                    text-align: center;

                }
                .bg-desktop{
                    height: 1in;
                }

            }   
        </style>
    </head>
    <body>
       
    
        <div class="wrapper content-1 sx cssback bg-desktop " style="background-image: url({{  asset('images/background-image/pop-upbanner.jpg')}}); " >

        </div>
        <div class="wrapper content-2 bg-hotsale-multi" style="background-image: url('')">
            <div class="cache _posi multiple-hotsale">
                
                <div class="row-product">
                    <div class="tagline" id="noibat">
                        <div class="wrap" id="normal-ds">
                            <div class="one4all normal">
                                
                                <div id="list-normal" class="" data-group="2300" data-column="5" data-firstgroup="True" data-lazy="False">
                                    <div class="loading-hotsale hide">
                                        <p class="csslder">
                                            <span class="csswrap">
                                            <span class="cssdot"></span>
                                            <span class="cssdot"></span>
                                            <span class="cssdot"></span>
                                            </span>
                                        </p>
                                    </div>
                                   
                                    


                                    <ul class="pros-hotsale-key  list priority">

                                        <?php  
                                            $hight_light = DB::table('landing_product')->where('hight_light', 1)->get()
                                        ?>
                                        @if(count($hight_light)>0&& isset($hight_light))
                                        @foreach($hight_light as $val)
                                        <div class="item">
                                            <a href="{{ route('details', $val->link) }}" class=" main-contain" data-s="Nomal" data-site="2" data-pro="3" data-cache="False" data-name="Smart Tivi QLED 4K 55 inch Samsung QA55Q65A" data-id="235642" data-price="19900000.0" data-brand="Samsung" data-cate="Tivi" data-box="BoxHiddenPromotion">
                                               
                                                <div class="item-img item-img_1942">
                                                    <img src="{{ asset($val->image) }}" loading="lazy" class="lazyload" alt="{{ $val->name }}" width=210 height=210>
                                                    <img src="{{ asset($val->image) }}" width="40" height="40" class="lazyload lbliconimg lbliconimg_1942" />
                                                </div>
                                                
                                                <h3>{{ $val->name }}</h3>
                                                <div class="item-compare">
                                                    <span>55 inch</span>
                                                    <span>4K</span>
                                                </div>
                                             <!--    <p class="item-txt-online">Online gia&#x301; re&#x309;</p>
                                                <div class="box-p">
                                                    <p class="price-old black">25.900.000&#x20AB;</p>
                                                    <span class="percent">-23%</span>
                                                </div> -->
                                                <strong class="price">{{  @number_format($val->price , 0, ',', '.')  }}&#x20AB;</strong>
                                                <div class="item-rating">
                                                    <p>
                                                       <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </p>
                                                    <p class="item-rating-total">87</p>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach
                                        @endif
                                        
                                    </ul>


                                    <div  class="prdWrapper prodCol_5 row">
                                        <?php  

                                            $products = DB::table('landing_product')->where('hight_light', 0)->get();
                                        ?>
                                        @if(isset($products) && count($products)>0)
                                        @foreach($products as $val)
                                        <div class="item col-md-3 col-6 list-child">
                                            <a href="{{ route('details', $val->link) }}" class=" main-contain" data-name="{{ $val->name }}" data-id="235792" data-price="{{ $val->price }}" data-brand="Samsung" data-cate="Tivi" data-box="BoxHiddenPromotion">
                                               <span class="icon_tragop">Trả góp <i>0%</i></span>
                                                <div class="item-img item-img_1942">
                                                    <img src="{{ asset($val->image) }}" loading="lazy" class="lazyload" alt="{{ $val->name }}" width=210 height=210>
                                                   
                                                </div>
                                                
                                                <h3>{{ $val->name }}</h3>
                                                <!-- <div class="item-compare">
                                                    <span>55 inch</span>
                                                    <span>4K</span>
                                                </div> -->
                                               <!--  <p class="item-txt-online">Online gia&#x301; re&#x309;</p>
                                                <div class="box-p">
                                                    <p class="price-old black">21.900.000&#x20AB;</p>
                                                    <span class="percent">-21%</span>
                                                </div> -->
                                                <strong class="price">{{  @number_format($val->price , 0, ',', '.')  }}&#x20AB;</strong>
                                                <div class="item-rating">
                                                    <p>
                                                       <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </p>
                                                    
                                                </div>
                                            </a>
                                        </div>

                                        @endforeach
                                        @endif
                                        
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
           
        </div>
        <div id="videos"></div>
       
      
       
    
@endsection
