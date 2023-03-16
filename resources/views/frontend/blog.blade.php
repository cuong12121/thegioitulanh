

    @extends('frontend.layouts.apps')

    @section('content') 
    @push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/dienmay.css')}}?ver=1"> 
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=8881288.8883.151">
    <link rel="stylesheet" href="{{ asset('css/customs.css') }}?v=245754.75.52928">
    @endpush
   
     <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}"> 

        <link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}?ver=1"> 
         <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=1"> 
    <style type="text/css">
        .header__top-mobile{
            height: 133px;
        }
    </style>
    <!-- end header -->
    <!-- begin main -->
    <main class="bg-fff">
        <!-- Begin menu blog -->
        <div class="menu_blog">
            <ul class="dm_container">
                <li>
                    <a href="/tu-van-ti-vi">
                    <img src="{{ asset('images/template/logo/tivi.png') }}" alt="">
                    <span>Tư vấn
                    <br> tivi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('details', 'tu-van-tu-lanh') }}">
                    <img src="{{ asset('images/template/logo/tu-lanh.png') }}" alt="">
                    <span>Tư vấn
                    <br> tủ lạnh</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('details', 'tu-van-may-giat') }} ">
                    <img src="{{ asset('images/template/logo/may-giat.png') }}" alt="">
                    <span> Tư vấn
                    <br> máy giặt</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('details', 'tu-van-dieu-hoa') }}">
                    <img src="{{ asset('images/template/logo/dieu-hoa.png') }}" alt="">
                    <span>Tư vấn
                    <br> điều hòa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('details', 'tu-van-gia-dung') }}">
                    <img src="{{ asset('images/template/logo/gia-dung.png') }}" alt="">
                    <span>Tư vấn
                    <br> gia dụng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('details', 'tu-van-mua-sam') }}">
                    <img src="{{ asset('images/template/logo/mua-sam.png') }}" alt="">
                    <span>Tư vấn
                    <br> mua sắm</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('details', 'meo-vat-gia-dinh') }}">
                    <img src="{{ asset('images/template/logo/meo-vat.png') }}" alt="">
                    <span>Mẹo vặt
                    <br> gia đình</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('details', 'tin-khuyen-mai') }}">
                    <img src="{{ asset('images/template/logo/khuyen-mai.png') }}" alt="">
                    <span>Tin
                    <br> Khuyến Mại</span>
                    </a>
                </li>
                <li>
                    <a href="#">
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
                       <!--  <ul class="ulcatemenu">
                            <li class="active"><a>Tư vấn mua sắm</a></li>
                        </ul> -->
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="main-blog-list">
                        <div style="width:100%; height: 50px;">
                            <h1 class="title">{{ $name_cates_cate??'Tin Tức' }}</h1>
                        </div>
                        
                        @isset($data)
                        @foreach($data as $value)
                        @if($value->category!=5)
                        
                        <div class="blog-list-item">
                            <a href="{{ route('details', $value->link) }}" class="img">
                            <img src="{{ asset($value->image) }}" data-src ="{{ asset($value->image) }}" alt="{{ $value->title }}">
                            </a>
                            <div class="blog-flex">
                                <a href="{{ route('details', $value->link) }}" class="name">{{ $value->title }}</a>
                                
                                
                                <a href="{{ route('details', $value->link) }}" class="linkview">Xem chi tiết ›</a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endisset
                        
                        {{ $data->links() }}

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

    @endsection
   
    


<!-- Load time: 0.126 seconds  / 4 mb-->
<!-- Powered by HuraStore 7.4.4, Released: 12-Aug-2018 / Website: www.hurasoft.vn -->