

    @extends('frontend.layouts.apps')

    @section('content') 


    <link rel="stylesheet" type="text/css" href="{{asset('css/dienmay.css')}}?ver=4"> 
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}?">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=8881288.8883.159">
    <link rel="stylesheet" href="{{ asset('css/customs.css') }}?v=245754.75.52928">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&subset=vietnamese" rel="stylesheet">
    
    
    <!-- end header -->
    <!-- begin main -->

     <style type="text/css">
        .header__top-mobile{
            height: 133px;
        }
    </style>
    <main class="bg-fff">
        <!-- Begin menu blog -->
        <div class="menu_blog">
            <ul class="dm_container">
                <li>
                    <a href="/tu-van-tivi/">
                    <img src="{{ asset('images/template/logo/tivi.png') }}" alt="">
                    <span>Tư vấn
                    <br> tivi</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-tu-lanh/">
                    <img src="{{ asset('images/template/logo/tu-lanh.png') }}" alt="">
                    <span>Tư vấn
                    <br> tủ lạnh</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-may-giat/">
                    <img src="{{ asset('images/template/logo/may-giat.png') }}" alt="">
                    <span> Tư vấn
                    <br> máy giặt</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-dieu-hoa/">
                    <img src="{{ asset('images/template/logo/dieu-hoa.png') }}" alt="">
                    <span>Tư vấn
                    <br> điều hòa</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-gia-dung/">
                    <img src="{{ asset('images/template/logo/gia-dung.png') }}" alt="">
                    <span>Tư vấn
                    <br> gia dụng</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-mua-sam/">
                    <img src="{{ asset('images/template/logo/mua-sam.png') }}" alt="">
                    <span>Tư vấn
                    <br> mua sắm</span>
                    </a>
                </li>
                <li>
                    <a href="/meo-vat-gia-dinh/">
                    <img src="{{ asset('images/template/logo/meo-vat.png') }}" alt="">
                    <span>Mẹo vặt
                    <br> gia đình</span>
                    </a>
                </li>
                <li>
                    <a href="/tin-khuyen-mai/">
                    <img src="{{ asset('images/template/logo/khuyen-mai.png') }}" alt="">
                    <span>Tin
                    <br> Khuyến Mại</span>
                    </a>
                </li>
                <li>
                    <a href="">
                    <img src="{{ asset('images/template/logo/video.png') }}" alt="">
                    <span>Video
                    <br>clip</span>
                    </a>
                </li>
            </ul>
        </div>


        <!-- End menu blog -->
        <div class="blog-list dm_container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="sidebar-left">
                        <figure>
                            <img src="" alt="">
                        </figure>
                        <ul class="ulcatemenu">
                            <li class="active"><a>{{  $data->category==5?'':$name_cate}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="main-blog-list">
                        <div style="width:100%; height: 50px;">
                            <h1 class="title">{{  $data->category==5?'':$name_cate}}</h1>
                        </div>
                        
                        <div class="blog-detail">
                            <div class="detail-head">
                                <h1>{{ $data->title }}</h1>
                                <time>{{ $data->created_at->format('d-m-Y, H:i') }}</time>
                                <div id="fb-root" class=" fb_reset">
                                    <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                                        <div></div>
                                    </div>
                                </div>
                              
                               
                            </div>
                            <div class="emtry_content Description nd">
                                <?php 

                                    $content = preg_replace("/<a(.*?)>/", "<a$1 target=\"_blank\">",  $data->content);
                                ?>
                            
                                {!!   $content  !!}
                            </div>
                            <div class="blog-related">
                                <h3>Tin tức liên quan</h3>
                                <ul>
                                    @if(isset($related_news))
                                    @foreach($related_news as $news)
                                    @if($news->id != $data->id)
                                    <li><a href="{{ route('details', $news->link) }}">{{ $news->title }}</a></li>
                                    @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                       <!--  <div class="bloglist-page">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="pagingIntact"><a>Xem trang</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingViewed">1</td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=2">2</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=3">3</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=4">4</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=5">5</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=6">6</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=7">7</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingFarSide" align="center">...</td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=2">Tiếp theo</a></td>
                                </tr>
                            </table>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="banner-blog">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- end main -->
    <!--<hr>-->
    <!-- begin footer -->
    @push('script')
     <script type="text/javascript">
        $('img').closest('p').css('text-align', 'center');
        
    </script>


    @endpush
   
    @endsection




   
