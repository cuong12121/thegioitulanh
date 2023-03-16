


@extends('frontend.layouts.apps')
@section('content') 


@push('style')
<link href="https://www.cooky.vn/dist/css/market.search.min.css?v=3340808760" rel="stylesheet">
    <link href="https://www.cooky.vn/dist/css/shared.market.min.css?v=3340808760" rel="stylesheet">

<style type="text/css">
    position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
        .fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
        .fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_dialog_advanced{border-radius:8px;padding:10px}.fb_dialog_content{background:#fff;color:#373737}.fb_dialog_close_icon{background:url(https://connect.facebook.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{left:5px;right:auto;top:5px}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(https://connect.facebook.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent}.fb_dialog_close_icon:active{background:url(https://connect.facebook.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #365899;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(https://connect.facebook.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{height:100%;left:0;margin:0;overflow:visible;position:absolute;top:-10000px;transform:none;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(https://connect.facebook.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{background:none;height:auto;min-height:initial;min-width:initial;width:auto}.fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner{width:100%}.fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content{background:none}.loading.centered #fb_dialog_loader_close{clear:both;color:#fff;display:block;font-size:18px;padding-top:20px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .4);bottom:0;left:0;min-height:100%;position:absolute;right:0;top:0;width:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_mobile .fb_dialog_iframe{position:sticky;top:0}.fb_dialog_content .dialog_header{background:linear-gradient(from(#738aba), to(#2c4987));border-bottom:1px solid;border-color:#043b87;box-shadow:white 0 1px 1px -1px inset;color:#fff;font:bold 14px Helvetica, sans-serif;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:linear-gradient(from(#4267B2), to(#2a4887));background-clip:padding-box;border:1px solid #29487d;border-radius:3px;display:inline-block;line-height:18px;margin-top:3px;max-width:85px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{background:none;border:none;color:#fff;font:bold 12px Helvetica, sans-serif;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(https://connect.facebook.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #4a4a4a;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f5f6f7;border:1px solid #4a4a4a;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}#fb_dialog_loader_spinner{animation:rotateSpinner 1.2s linear infinite;background-color:transparent;background-image:url(https://connect.facebook.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);background-position:50% 50%;background-repeat:no-repeat;height:24px;width:24px}@keyframes rotateSpinner{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
        .fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,.fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}.fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}.fb_iframe_widget_lift{z-index:1}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}
        .fb_mpn_mobile_landing_page_slide_out{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_out_from_left{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out_from_left;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_up{animation-duration:500ms;animation-name:fb_mpn_landing_page_slide_up;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_in{animation-duration:300ms;animation-name:fb_mpn_bounce_in;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out{animation-duration:300ms;animation-name:fb_mpn_bounce_out;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out_v2{animation-duration:300ms;animation-name:fb_mpn_fade_out;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_v2{animation-duration:300ms;animation-name:fb_bounce_in_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_from_left{animation-duration:300ms;animation-name:fb_bounce_in_from_left;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_v2{animation-duration:300ms;animation-name:fb_bounce_out_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_from_left{animation-duration:300ms;animation-name:fb_bounce_out_from_left;transition-timing-function:ease-in}.fb_invisible_flow{display:inherit;height:0;overflow-x:hidden;width:0}@keyframes fb_mpn_landing_page_slide_out{0%{margin:0 12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;margin:0 24px;width:60px}}@keyframes fb_mpn_landing_page_slide_out_from_left{0%{left:12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;left:12px;width:60px}}@keyframes fb_mpn_landing_page_slide_up{0%{bottom:0;opacity:0}100%{bottom:24px;opacity:1}}@keyframes fb_mpn_bounce_in{0%{opacity:.5;top:100%}100%{opacity:1;top:0}}@keyframes fb_mpn_fade_out{0%{bottom:30px;opacity:1}100%{bottom:0;opacity:0}}@keyframes fb_mpn_bounce_out{0%{opacity:1;top:0}100%{opacity:.5;top:100%}}@keyframes fb_bounce_in_v2{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}50%{transform:scale(1.03, 1.03);transform-origin:bottom right}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}}@keyframes fb_bounce_in_from_left{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}50%{transform:scale(1.03, 1.03);transform-origin:bottom left}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}}@keyframes fb_bounce_out_v2{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}}@keyframes fb_bounce_out_from_left{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}}@keyframes slideInFromBottom{0%{opacity:.1;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}@keyframes slideInFromBottomDelay{0%{opacity:0;transform:translateY(100%)}97%{opacity:0;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}
</style>
@endpush

<?php 

            $data = Cache::remember('sale_products',10, function(){

                // return DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();
                 return DB::table('products')->where('active',1)->Orderby('id', 'desc')->take(20)->get();
            });    



           

        ?>

<div class="page-container">
    <div class="page-wrapper">
        <div class="content-tab m-b-50">
            <div class="title"></div>
            <ul class="nav custom-horizontal-scrollbar">
                <li id="cate-0" class="active">
                    <div class="img-container"><img src="/react/images/icons/tab-all.svg"></div>
                    <a href="#">Tất cả</a>
                </li>
                <li id="cate-44" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/9c35f2ad-89b1-4d9f-bab2-cc776cb23d75.png"></div>
                    <a href="#">Tết 2023</a>
                </li>
                <li id="cate-1" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/b8586b21-eb0b-497b-8f3b-c90d578e1dc4.png"></div>
                    <a href="#">Trái Cây</a>
                </li>
                <li id="cate-7" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/5e90165b-f287-4eef-afaa-a04a4ff14a1b.png"></div>
                    <a href="#">Rau Củ</a>
                </li>
                <li id="cate-3" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/8adbc4a5-9cc1-4426-bf13-fe4f4fd116af.png"></div>
                    <a href="#">Hải Sản</a>
                </li>
                <li id="cate-4" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/4ad2e1c9-84ab-4b53-a4ad-f6bef08d71c8.png"></div>
                    <a href="#">Thịt Heo</a>
                </li>
                <li id="cate-2" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/7e72fc58-b4bf-48da-acec-f9b1b99a630d.png"></div>
                    <a href="#">Gà Vịt</a>
                </li>
                <li id="cate-5" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/1cb41d17-4c7b-4779-8f38-3fff600be836.png"></div>
                    <a href="#">Bò Dê</a>
                </li>
                <li id="cate-39" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/37a3c42e-1ae3-40bc-8263-f67e93830e2a.png"></div>
                    <a href="#">Món Canh</a>
                </li>
                <li id="cate-38" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/4ca17211-ea46-4887-a4da-ebf13ff95c64.png"></div>
                    <a href="#">Combo</a>
                </li>
                <li id="cate-6" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/09ed0a7a-17a6-46ca-b0e7-2a85ffee2da4.png"></div>
                    <a href="#">Trứng/Đậu</a>
                </li>
                <li id="cate-22" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/1a0b7305-3dee-42fb-80e2-a16172888bcc.png"></div>
                    <a href="#">Lẩu</a>
                </li>
                <li id="cate-24" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/cc09851e-03ec-4bba-9b2d-25ed2b472801.png"></div>
                    <a href="#">Món Chay</a>
                </li>
                <li id="cate-51" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/b75541da-15ef-415d-b54a-4dbc4c95bcac.png"></div>
                    <a href="#">Bếp</a>
                </li>
                <li id="cate-50" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/a586a315-8d74-4628-9a44-81622f69803e.png"></div>
                    <a href="#">Chè &amp; Rau Câu</a>
                </li>
                <li id="cate-77" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/d5afb0e1-282b-4ca8-ae01-3096a7ae0982.png"></div>
                    <a href="#">Sữa/Pho Mai</a>
                </li>
                <li id="cate-10" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/0451d214-d3f6-482f-8f99-ed1a2ac68571.png"></div>
                    <a href="#">Đồ Uống</a>
                </li>
                <li id="cate-12" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/d1b3dc41-c4b7-425c-8013-689ded32c830.png"></div>
                    <a href="#">Gia Vị</a>
                </li>
                <li id="cate-13" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/416e050c-5427-4ae5-b2c5-f15d87d02d5c.png"></div>
                    <a href="#">Lương Thực</a>
                </li>
                <li id="cate-11" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/4a64beb5-35e1-432f-983f-1d6e3ab1dff9.png"></div>
                    <a href="#">Bánh</a>
                </li>
                <li id="cate-18" class="">
                    <div class="img-container"><img src="https://image.cooky.vn/icon/s60x60/ff46066d-4807-4580-a083-1355400fa3a5.png"></div>
                    <a href="#">Nhà Cửa</a>
                </li>
            </ul>
            <div class="sub-cates-box custom-horizontal-scrollbar">
                <div class="sub-cate-item">FlashSale</div>
                <div class="sub-cate-item">Just Ordered</div>
                <div id="sub-cate-3352" class="sub-cate-item">Thực Phẩm &amp; Gia Dụng 5K</div>
                <div id="sub-cate-14972" class="sub-cate-item">Chợ Đồ Tươi</div>
                <div id="sub-cate-14973" class="sub-cate-item">Cơm Gia Đình</div>
                <div id="sub-cate-14974" class="sub-cate-item">Mở Tiệc Tại Gia</div>
                <div id="sub-cate-14309" class="sub-cate-item">Ưu Đãi Món Chay</div>
            </div>
            <div class="content-pane">
                <div>
                    <div class="package-kind">
                        <div class="kind-name" id="kind-box-2"><b>Tất cả - Pack Sơ Chế</b> &nbsp; (3 sản phẩm)<img src="/React/Images/Icons/toggle-up.svg" class="icon-toggle"></div>
                        <div class="promotion-container">
                            <div class="promotion-box" style="margin-left: -10px; margin-right: -10px;">
                                <div class="package-list" id="package-list-2">

                                     @if(isset($data))

                                     @foreach($data as $value)
                                    <div class="package ">
                                        <div class="cover-photo">
                                            <div class="promotion-photo">
                                                <div class="package-default"><img src="https://image.cooky.vn/posproduct/g0/17282/s200x200/2b0e0d7f-82b9-4c98-8f7a-68ed0d02cb0d.jpeg" class="img-fit" loading="lazy"></div>
                                            </div>
                                            <a class="link-absolute" target="_self" href="https://cooky.vn/market/set-com-viet-k-17282"></a>
                                        </div>
                                        <div class="overview">
                                            <div class="name two-lines"><a class="link-absolute" target="_self" href="https://cooky.vn/market/set-com-viet-k-17282"></a>{{ $value->Name  }}</div>
                                            <div class="d-flex-center-middle">
                                                <div class="price p-g-v ">
                                                    <!-- <div class="weight-serving">3 món/2 người</div> -->
                                                    <div class="price-container">
                                                        <div class="sale-price">{{ number_format(str_replace("\xc2\xa0",'',$value->Price) , 0, ',', '.')}}{{ $value->Price!=0?'đ':''   }}</div>
                                                        <!-- <div class="unit-price">137k</div> -->
                                                    </div>
                                                </div>
                                                <button class="btn-add-to-cart n-btn " title="Bấm để thêm vào giỏ hàng">
                                                    <div style="position: relative; z-index: 3;"><img src="/React/Images/Icons/plus-filled-red.svg"></div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sort-pane">
                    <div class="fixed-sort-box">
                        <div class="rSort rFocus">Danh mục</div>
                    </div>
                    <div class="fixed-sort-box">
                        <div class="rSort">Vừa đặt <img src="/React/Images/Icons/sort.svg"></div>
                    </div>
                    <div class="format-view r-border l-border"><img src="/React/Images/Icons/list-view.svg"></div>
                    <div class="format-view r-border"><img src="/React/Images/Icons/grid-view-active.svg"></div>
                </div>
                <ul class="kind-sl-box ">
                    <li class="is-active"><a href="#">Vừa đặt</a><img src="/React/images/icons/select.svg"></li>
                    <li class=""><a href="#">Bán chạy</a></li>
                    <li class=""><a href="#">Mới nhất</a></li>
                </ul>
                <ul class="kind-sl-box cate-box ">
                    <li class="is-active"><a href="#">Tất cả</a><img src="/React/images/icons/select.svg"></li>
                    <li class=""><a href="#">Tết 2023</a></li>
                    <li class=""><a href="#">Trái Cây</a></li>
                    <li class=""><a href="#">Rau Củ</a></li>
                    <li class=""><a href="#">Hải Sản</a></li>
                    <li class=""><a href="#">Thịt Heo</a></li>
                    <li class=""><a href="#">Gà Vịt</a></li>
                    <li class=""><a href="#">Bò Dê</a></li>
                    <li class=""><a href="#">Món Canh</a></li>
                    <li class=""><a href="#">Combo</a></li>
                    <li class=""><a href="#">Trứng/Đậu</a></li>
                    <li class=""><a href="#">Lẩu</a></li>
                    <li class=""><a href="#">Món Chay</a></li>
                    <li class=""><a href="#">Bếp</a></li>
                    <li class=""><a href="#">Chè &amp; Rau Câu</a></li>
                    <li class=""><a href="#">Sữa/Pho Mai</a></li>
                    <li class=""><a href="#">Đồ Uống</a></li>
                    <li class=""><a href="#">Gia Vị</a></li>
                    <li class=""><a href="#">Lương Thực</a></li>
                    <li class=""><a href="#">Bánh</a></li>
                    <li class=""><a href="#">Nhà Cửa</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

