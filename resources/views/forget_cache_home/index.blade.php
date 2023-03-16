@extends('frontend.layouts.apps')

@section('content') 
    @push('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=11">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=10"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}?ver=3">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homes.css') }}?ver=5">
        <style type="text/css">
           /* deal*/
            .titles-time{
                border-top: 2px solid #ff9;
                margin-top: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
                background-color: #fb0707;
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
                background-color: #ffea26;
                padding: 5px 13px;
                border-radius: 4px;
                line-height: 29px;
                margin-left: 10px;
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
                padding: 0 4px;
            }
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
            @media screen and (max-width: 767px) {
                .result-labels{
                    top: 43%;
                   
                }    
            }
             @media screen and (min-width: 768px) {
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

                @if(isset($banners))

                @foreach($banners as $value)
                <div class="item" data-dot="<span>{{ $value->title }}</span>">
                    <a aria-label="slide" data-cate="0" data-place="1535" href="{{ $value->link }}"><img  src="{{ asset($value->image) }}"  data-src="{{ asset($value->image) }}" alt="{{ $value->title }}"  ></a>
                </div>
                @endforeach
                @endif
                
            </div>
            <div id="sync2" class="slider-banner owl-carousel">
                @if(isset($banners))
                @foreach($banners as $value)
                <div class="item">
                    <h3>
                        {{  $value->title }}
                    </h3>
                </div>
                @endforeach
                @endif
                
            </div>
        </aside>
        <!-- End -->
    </div>
    
    <section>
        <div class="bar-top">
           <!--  <div class="bar-top-left-none"></div> -->
           
            <div class="preorder-hot"> 
                @if(isset( $bannersRight ))

                @foreach( $bannersRight as $values)

                <a  aria-label="slide" data-cate="0" data-place="1539" href="{{ $values->link }}">
                    <img  src="{{ asset($values->image) }}" data-src="{{ asset($values->image) }}"  alt="{{ $values->title }}" >
                </a>
                @endforeach
                @endif
            </div>
        </div>
        <section class="menus-banner">
            <strong class="name-box">Có thể bạn quan tâm</strong>
            <ul>
               
                @if(!empty($bannerUnderSlider))
                @foreach($bannerUnderSlider as $slider)
                <li class="col-">
                    <a href="{{ $slider->link }}">
                        <picture>
                            <source media="(min-width:1201px)" >
                            <img src="{{ asset($slider->image) }}" alt="" data-src="{{ asset($slider->image) }}">
                        </picture>
                    </a>
                    <p>
               &nbsp; <a href="{{ $slider->link }}">{{ $slider->title }}</a></p>
                    
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ $slider->link }}"><strong class="strongtitle">{{ @$slider->slogan }}</strong>
                    @if(!empty($slider->slogan))
                    <span aria-label="Next" class="Next">›</span>
                    @endif
                   </a>
                </li>
                @endforeach
                @endif
               
            </ul>
        </section>
       

        <?php 
           
            $now  = Carbon\Carbon::now();
            
            if(!empty($deal)){
                $timeDeal_star = Cache::get('deal_start');
                $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);
                $timeDeal_end = $deal->first()->end;
                $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);
                $timestamp = $now->diffInSeconds($timeDeal_end);
            }
        ?>


        @if(!empty($deal_check) && $deal_check->count()>0 && $now->between($deal_check[0]->start, $deal_check[0]->end))
        <!-- flash sale -->
            <div class="img-flashsale mobiles" style="width: 100%;">
                <a href="{{ route('details', 'deal') }}"><img src="{{ asset('images/template/flashsalemb.jpg') }}" style="width: 100%"></a>

            </div>
           <!--  <div class="title titles-time">
                <h3>
                    <span>12:00</span>
                    <br>
                    <span>01:00:59</span>
                </h3>
                
                <ul class="cat-child">
                    <li>
                        <h3>
                            <span>15:00</span>
                            <br>
                            <span>Sắp diễn ra</span>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <span>18:00</span>
                            <br>
                            <span>Sắp diễn ra</span>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <span>21:00</span>
                            <br>
                            <span>Sắp diễn ra</span>
                        </h3>
                    </li>
                </ul>
            </div> -->

            <div class="">
                <div class="flash-sale" style="height: 305px;">
                    
                    <span id="banner-flash-sale"><a href="{{ route('dealFe') }}">
                    <img width="256" src="{{  asset('images/background-image/Flash_Sale_Theme_256x396.jpg')}}" style="width: auto; height: 300px" alt="banner-fs">
                    </a></span>
                    <div class="flash-product nk-product-of-flash-sales">
                        <div class="col-flash col-flash-2 active">
                            <div id="sync1S" class="slider-banner owl-carousel flash-sale-banner">

                                @foreach($deal as $key => $value)
                               
                                @if( !empty($value->active) && $value->active ==1 && $now->between($value->start, $value->end))

                                <?php 
                                    $timestamp = $now->diffInSeconds($value->end);
                                    $hour =  floor($timestamp/3600);
                                    $timestamp = floor($timestamp % 3600);
                                    $minutes =floor($timestamp/60);
                                    $timestamp = floor($timestamp % 60);
                                    $seconds =floor($timestamp);
                                ?>

                                <div class="item">
                                    <a href="{{ route('details', $value->link) }}">
                                        <div class="img">
                                            <img width="327" src="{{ asset($value->image) }}"  data-src="{{ asset($value->image) }}" title="{{ $value->name }}">
                                        </div>
                                    </a>
                                    <div class="desc desc-deal{{$key}}">
                                      <a href="{{ route('details', $value->link) }}">
                                        <h4 class="title">{{ $value->name }}</h4>
                                        <div class="container-price">
                                               <div>
                                                   <span class="price-old">{{ @str_replace(',' ,'.', number_format($value->price)) }}&#x20AB;</span>
                                               </div>
                                        </div>
                                        <div style="margin-top: 11px">
                                            <div class="nk-top-stickers"><span class="nk-sticker nk-new">Mới</span></div><div>
                                                    <p class="title-shock-price">Giá sốc online</p>
                                                    <span class="price-new">{{ @str_replace(',' ,'.', number_format($value->deal_price)) }}&#x20AB;</span>
                                                </div>
                                        </div>
                                        <div class="review_product star">
                                           <p>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </p>
                                            <div class="line_break">|</div>
                                                <div class="reviewCount">0 đánh giá</div>
                                            </div>
                                            <div class="container-timeline">
                                            <span class="timeline"><span style="width: 2%"></span></span>
                                           <!--  <p>Đã bán <span style="color: #EE1E25">2</span> / 100 sản phẩm</p> -->
                                        </div>
                                        <div style="width: 100%; height: 1px; background: #ECECEC; margin-top: 8px"></div>
                                        <div class="countdown-flash-sale">
                                            <div class="time-cd time-fl time{{ $key }}">

                                                <span class="timestamp" style="display: none;">{{   $now->diffInSeconds($value->end) }}</span>
                                               
                                               
                                                <div class="time">
                                                    <span class="hours">
                                                        <span class="hourss"> {{ $hour }}</span>
                                                        
                                                        <div style="margin-top: 2px; width:100%; height:1px; background: #FF3647"></div>
                                                        <span>Giờ</span>
                                                    </span>
                                                    <p style="font-size: 28px; line-height: 55px;font-weight: bold;color: #101010; margin: 0 7px" >:</p>

                                                    <span class="hours">
                                                        <span class="minutess">{{ $minutes }}</span>
                                                        <div style="margin-top: 2px; width:100%; height:1px; background: #FF3647"></div>
                                                        <span>phút</span>
                                                    </span>
                                                    <p style="font-size: 28px; line-height: 55px;font-weight: bold;color: #101010; margin: 0 7px">:</p>
                                                    <span class="hours">
                                                        <span class="secondss"> {{ $seconds }}</span>
                                                        <div style="margin-top: 2px; width:100%; height:1px; background: #FF3647"></div>
                                                        <span>giây</span>
                                                    </span>
                                                   
                                                  
                                                </div>
                                            </div>
                                        </div>
                                      </a>
                                    </div>
                                </div>

                                @endif

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <!--  end flash  -->
         @endif 
          
        <div class="clearfix"></div> 

        <div class="prd-promo has-banner" style="background-color:#FFF3EE; " data-html-id="3109">

            <div class="prd-promo__top clearfix" >

                <a data-cate="0" data-place="1868" href="#" ><img style="cursor:pointer" src="{{ asset($bannerUnderSale[0]['image']) }}" alt="banner-summer" width="1200"></a>                
            </div>
           
           @if(!empty($product_sale)&&$product_sale->count()>0)
           
            <div class="listproduct slider-promo owl-carousel banner-sale" data-size="20">

                @foreach($product_sale as  $value)
                @if($value->active==1)
                <div class="item">
                    <span class="icon_sale">
                        <img class="sale-banner ls-is-cached lazyloaded" alt="hot" data-src="{{ asset('images/background-image/xahang.png') }}" src="{{ asset('images/background-image/xahang.png') }}">
                    </span>
                    <a href='{{ route('details', $value->Link) }}' class=" main-contain" data-s="OnlineSavingCMS" data-site="2" data-pro="3" data-cache="False" data-name="M&#xE1;y gi&#x1EB7;t LG Inverter 8.5 kg FV1408S4W" data-id="227121" data-price="8840000.0" data-brand="LG" data-cate="M&#xE1;y gi&#x1EB7;t" data-box="BoxHome">
                        <div class="item-label">
                        </div>
                        <div class="item-img">
                            <img data-src="{{ asset($value->Image) }}"   class="lazyload"  data-src="{{ asset($value->Image) }}" alt="{{ $value->Name }}" width=210 height=210>
                        
                        </div>
                        <h3>{{ $value->Name }}</h3>
                        <strong class="price">{{  @str_replace(',' ,'.', number_format($value->Price))  }}.&#x20AB;</strong>
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
                @endif

                @endforeach
                
            </div>
            @endif

            <div class="prd-promo__top clearfix" >
                <a class="readmore-btn" href="{{ route('sale-home') }}"><span>Xem tất cả</span></a>                
            </div>
            
        </div>
        

        <div  class="owl-slider-count" style="display: none;">{{ @$group->count() }}</div> 
        @foreach($group as $key => $groups)

            <?php
                
                
                Cache::forget('hot'.$groups->id);
                Cache::forget('data'.$groups->id);
                if(!Cache::has('hot'.$groups->id) ){
                    $hot = DB::table('hot')->select('product_id')->where('group_id', $groups->id)->get()->pluck('product_id');
                    Cache::put('hot'.$groups->id, $hot, 10000);
                }
                 $hot = Cache::get('hot'.$groups->id);
                if(!Cache::has('data'.$groups->id)){
                    $datas =  DB::table('products')->whereIn('id', $hot)->where('active', 1)->get();
                    $datas = Cache::put('data'.$groups->id,  $datas, 10000);
                }
               
                $data = Cache::get('data'.$groups->id);
            ?>
        @if(!empty($data) && $data->count()>0)

         
        <div class="box-common _cate_1942">
            <ul class="box-common__tab box-tab-mobile">
                <li class="active-tab" data-cate-id="1942"><a href="{{  @$groups->link }}">{{  @$groups->name }}</a></li>
                <?php 
                    if(empty(Cache::get('listGroupsShow'.$groups->id))){
                        $listGroupsShows =   App\Models\groupProduct::select('name', 'link')->where('parent_id', $groups->id)->get();
                        Cache::put('listGroupsShow'.$groups->id,  $listGroupsShows, 10000);
                    }
                    $listGroupsShow = Cache::get('listGroupsShow'.$groups->id);
                ?>

                @if(!empty($listGroupsShow))
                @foreach($listGroupsShow as $valueslist)

                <li data-cate-id="2162" data-prop-value-ids="90016" class="desk-t"><a href="{{ route('details', $valueslist->link) }}">{{ @$valueslist->name }}</a></li>
                @endforeach
                @endif
            </ul>
            <div class="box-common__main relative">
                <div class="preloader">
                    <div class="loaderweb"></div>
                </div>
                <div class="box-common__content">
                    <div class="listproduct slider-home owl-carousel" id="banner-product_{{ $key }}" data-size="10">
                        @foreach($data as $datas)
                        @if($datas->active==1)
                        
                        <div class="item"  data-pos="1">
                            <a href='{{ route('details', $datas->Link) }}'>
                                @if($datas->Price>=3000000)
                                <span class="icon_tragop">Trả góp <i>0%</i></span>
                                @endif
                                <div class="item-img">
                                    <img data-src="{{ asset($datas->Image) }}" class="lazyload"   alt="{{ $datas->Name }}" width=210 height=210>
                                    
                                </div>
                               <p class="result-labels"><img class="sale-banner ls-is-cached lazyloaded" alt="hot" data-src="{{ asset('images/background-image/hot.jpg') }}" src="{{ asset('images/background-image/hot.jpg') }}"></p>
                                <h3>{{ $datas->Name }}</h3>
                                @if($groups->id<5)
                                <?php
                                        if($groups->id == 1){
                                            $searchstring = 'inch';
                                        }
                                        else{
                                            $searchstring = 'inverter';
                                        }
                                       
                                    $infoName  = str_replace($datas->ProductSku,'', strstr($datas->Name, $datas->ProductSku));
                                    if(!empty($infoName)){
                                        $arNames = [];
                                        if(strpos($datas->Name, $searchstring)){
                                            $arNames = explode($searchstring, $infoName);
                                        }
                            
                                    }
                                ?>
                               
                                <div class="item-compare">
                                    @if(!empty($arNames))
                                    <span>{{ @$arNames[0] }} {{ !empty($arNames)?$searchstring:'' }}</span>
                                    <span>{{ @$arNames[1] }}</span>
                                    @endif
                                    
                                </div>
                                
                                @endif
                                <strong class="price">{{ @number_format($datas->Price , 0, ',', '.')}}&#x20AB;</strong>

                           
                                <div class="item-rating">
                                    <p>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </p>
                                </div>

                                <?php  
                                    if(!Cache::has('gifts_Fe_'.$datas->id)){
                                        $gifts = gift($datas->id);
        
                                        if(empty($gifts)){
                                            $gifts = groupGift($groups->id);
                                            
                                            if(empty($gifts)){
                                                $gifts =[];
                                            }
                                        }
                                        Cache::put('gifts_Fe_'.$datas->id, $gifts,100);
                                    }
                                   
                                    $gift = Cache::get('gifts_Fe_'.$datas->id);
                                ?>

                                @if(!empty($gift))

                                    <?php 
                                        $gifts = $gift['gifts'];
                                        $gift = $gift['gift']; 
                                    ?>

                                    {{ $gifts->type ==1?'k/m chọn 1 trong 2':'' }}
                                    <div class="option-gift">

                                         @foreach($gift as $gifts)

                                        <div class="quatang"><img src="{{ asset($gifts->image) }}"></div>
                                        @endforeach
                                    </div>
                                   
                                @endif
                                
                            </a>
                        </div>
                        @endif
                        @endforeach
                        
                        
                    </div>
                    <a class="readmore-txt blue" href="{{ route('details', @$groups->link)  }}"><span>Xem tất cả {{ @$groups->name }}</span></a>
                </div>
            </div>
        </div>

       
        @endif
        @endforeach
        <!-- End  -->
     
    
        <!-- Banner dọc 2 bên -->
        <div class="sticky-sidebar" style="display: none;">
            <a data-cate="0" data-place="1863" href="#" class="banner-left"><img style="cursor:pointer" src="#" alt="Theme Giáng Sinh Trái" width="79" height="271"></a>
            <a data-cate="0" data-place="1864" href="#" class="banner-right"><img style="cursor:pointer" src="#" alt="Theme Giáng Sinh Phải" width="79" height="271"></a>        
        </div>
        
        <?php  
           
            $post = Cache::remember('post_home',10000, function() {
                return App\Models\post::where('active',1)->where('hight_light', 1)->OrderBy('created_at', 'desc')->select('link', 'title', 'image')->limit(6)->get()->toArray();
            }); 
        ?>
                    
        @if(isset($post) && count($post)>0)
        <div class="applications">
            <div class="col1">
                <!-- Tư vấn chọn mua -->
                <div class="ttl-main">
                    <h4 class="title-layout">Tin tức nổi bật</h4>
                    <a href="{{ route('tin') }}" class="readmore-txt blue">Xem thêm</a>
                </div>

                <div class="col1-big div-title-news">
                    <a href="{{ route('details', $post[0]['link']) }}" class="col1-big big-title-href">
                        <div class="span texts">
                            <p class="text-blog">{{ $post[0]['title'] }}</p>
                        </div>
                    </a>
                </div>
                    

                <div class="col1__ct" data-size="4">
                    <a href="{{ route('details', $post[0]['link']) }}" class="col1-big">
                        <div class="col1-big-img">
                            <img data-src="{{ asset( $post[0]['image'])  }}" class=" ls-is-cached lazyloaded" alt="{{ $post[0]['title'] }}" src="{{ $post[0]['image'] }}">
                        </div>
                        
                    </a>
                    <div class="col1-simple">

                        @for($i=1; $i<count($post); $i++)

                        <a href="{{ route('details', $post[$i]['link']) }}" class="">
                            <div class="spl-item__img">
                                <img data-src="{{ asset($post[$i]['image']) }}" class=" lazyloaded" alt="{{ $post[$i]['title'] }}" src="{{ asset($post[$i]['image']) }}">
                            </div>
                            <div class="spl-item__content">
                                <p class="spl-item-title">{{ $post[$i]['title'] }}</p>
                            </div>
                        </a>

                        @endfor
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>
        
         @endif
        <div class="bottom-search">
            <p>Tìm kiếm nhiều:</p>

            <?php 
                if(empty(Cache::get('link_much'))){
                    $links=   DB::table('muchsearch')->get(); 
                    Cache::put('link_much',  $links, 10000);
                }
              
                $link = Cache::get('link_much');
             ?>

            @isset($link)
            @foreach($link as $links)
            <a href="{{ $links->link }}" target="_blank">• {{@$links->title  }}</a> 
            @endforeach
            @endif
        
        </div>
        
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


    @push('script')



    <script type="text/javascript">
      
        loop = {{ $deal->count() }};
        times = [];
                  
        time = {{ $timestamp }};
        number_deal_product =10;
        //in time 
      
        setInterval(function(){
            for (var i = 0 ; i < loop; i++) {
                run(i);
            }
        }, 1000);
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
        var number_slider =  parseInt($('.owl-slider-count').text());
        for (i = 0; i < number_slider; i++) {
            $('#banner-product_'+i).owlCarousel({
                
                margin:10,
                nav:false,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                loop: true,
                items:2,
                
                responsive:{
                   
                    600:{
                        items:3
                       
                    },
                    1000:{
                        items:5
                    }
                }
            });
            
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
                    items:1
                },
                 600:{
                    items:2
                },
               
                1000:{
                    items:2
                }
            }
        });
        
    </script>
    @endpush
@endsection      
