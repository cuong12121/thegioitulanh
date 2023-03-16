<!DOCTYPE html>
<html lang="vi-VN">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../images/Favicon.ico" rel="shortcut icon" type="image/x-icon">
        <title>Giỏ hàng</title>
        <meta name="csrf-param" content="_csrf">
        <meta name="csrf-token" content="YmNIVjUuXElIe-MIrpMQzYJ2vVI-wQAthSarv006CoxbDi0AQUMpCxkvu3n44Xn_9ULHNES7bGvrTMLND01c5w==">
       <link href="{{ asset('css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/75a5fa0c/css/progressive-media.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/35deb2b4/css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{ asset('bulma/css/bulma.min.css')}}" rel="stylesheet">
        <link href="{{ asset('bulma/css/all.min.css')}}" rel="stylesheet">
        <link href="{{ asset('swiper@8.4.2/swiper-bundle.min.css')}}" rel="stylesheet">
        <link href="{{ asset('css/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{ asset('css/owl.theme.default.min.css')}}" rel="stylesheet">
        <link href="{{ asset('css/icofont.min.css')}}" rel="stylesheet">
        <link href="{{ asset('css/slick.css')}}" rel="stylesheet">
        <link href="{{ asset('css/slick-theme.css')}}" rel="stylesheet">
        <link href="{{ asset('css/site.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    </head>
    <body class="page-cartPage pageType-ContentPage template-pages-CartPageTemplate pageLabel-cart">
        <header class="cart-header">
            <div class="container">
                <div class="columns is-mobile">
                    <div class="column is-half-mobile">
                        <div class="back-to-shop">
                            <a href="/">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span>Tiếp tục mua hàng</span>
                            </a>
                        </div>
                    </div>
                    <div class="column">
                        <div class="cart-logo text-center">
                            <a href="/">
                            <img alt="" src="../images/global-samsung-logo.svg"></a>
                        </div>
                    </div>
                    <div class="column">
                        <div class="text-right">
                            <a href="/">
                            <img height="40" src="{{ asset('images/logo.jpg')  }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="toko-main-container">
            <div class="container">
                <div class="cart-checkout">
                    <div class="columns">
                        <div class="column is-8">
                            <h1>Thanh toán</h1>
                            <section class="step active">
                                <div class="step-title">
                                    <span>1</span>
                                    <h2>Điền thông tin giao hàng</h2>
                                </div>
                                <div class="checkout-form">
                                    <form id="contact-form" action="{{ route('order') }}" method="post">
                                        @csrf                          
                                        <div class="columns">
                                            <div class="column is-8">

                                                <div class="option-group clearfix">
                                                    
                                                    <input type="hidden" name="sex" id="sex" value="Nam"> 
                                                    <input type="hidden" name="province" id="province" value="1"> 
                                                </div>

                                                <div class="form-group field-order-order_name required">
                                                    <label for="order-order_name">Họ tên*</label>
                                                    <input type="text" id="order-order_name" class="form-control" name="name" aria-required="true">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group field-order-order_phone required">
                                                    <label for="order-order_phone">Số điện thoại người đặt hàng*</label>
                                                    <input type="text" id="order-order_phone" class="form-control" name="phone_number" aria-required="true">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group field-order-order_email">
                                                    <label for="order-order_email">Email người đặt hàng</label>
                                                    <input type="text" id="order-order_email" class="form-control" name="mail">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group field-order-address required">
                                                    <label for="order-address">Địa chỉ*</label>
                                                    <input type="text" id="order-address" class="form-control" name="address" aria-required="true">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="step-title">
                                            <span>2</span>
                                            <h2>Chọn thanh toán</h2>
                                        </div>
                                        <div class="help-block"></div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="gender"><b>Hình thức thanh toán</b></label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group field-order-payment_type">
                                                    <input type="hidden" name="Order[payment_type]" value="">
                                                    <div id="order-payment_type" style="display:inline-block" role="radiogroup">
                                                       
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="i2" class="custom-control-input" name="Order[payment_type]" value="4" checked>
                                                            <label class="custom-control-label" for="i2">COD</label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="help-block clearfix hidden-xs hidden-sm"></div>
                                       
                                        <div class="help-block"></div>
                                        <button type="submit" id="send-form" class="btn btn-default btn-next" name="cart-button" >Đặt hàng ngay</button>                            
                                    </form>
                                </div>
                            </section>
                        </div>
                        <div class="column is-4">
                            <div class="sticky-cart-summary">
                                <div class="cart-summary-block">
                                    <div class="cart-summary-title clearfix">Tổng quan</div>
                                    <div class="cart-summary-order-container clearfix">
                                        <div class="cart-summary-item-container clearfix">


                                            <?php
                                                $arrPrice = [];
                                                $key = 0;
                                                
           
                                                $cart = Gloudemans\Shoppingcart\Facades\Cart::content();

                                                

                                                $number_cart = count($cart);


                                               
                                             ?>  

                                            @if($number_cart>0)
                                            @foreach($cart as $key => $data)

                                            <?php 

                                                $price = (int)$data->price*(int)$data->qty;
                                                $key++;
                                                array_push($arrPrice, $price);

                                                $infoProducts = App\Models\product::find($data->id);

                                            ?> 


                                            <div class="cart-summary-order-item columns is-mobile">
                                                <div class="column is-2">
                                                    <div class="order-image">
                                                        <div class="progressive-media progressive-media-image progressive-media-loaded" data-img-src="/media/product/SP-LSP9TKAXXV/1618157397vn-the-premiere-lsp9t-sp-lsp9tkaxxv-414047979.jpg">
                                                            <div class="progressive-media-aspect" style="padding-bottom: 80%;">
                                                                <div class="progressive-media-aspect-inner">
                                                                    <img class="progressive-media-image-placeholder progressive-media-content progressive-media-blur" src="/media/product/SP-LSP9TKAXXV/1618157397vn-the-premiere-lsp9t-sp-lsp9tkaxxv-414047979.jpg" crossorigin="anonymous"><img class="progressive-media-image-placeholder progressive-media-image-placeholder-edge progressive-media-content" src="/media/product/SP-LSP9TKAXXV/1618157397vn-the-premiere-lsp9t-sp-lsp9tkaxxv-414047979.jpg" crossorigin="anonymous">
                                                                    <noscript><img class="progressive-media-image-original progressive-media-content" src="/media/product/SP-LSP9TKAXXV/1618157397vn-the-premiere-lsp9t-sp-lsp9tkaxxv-414047979.jpg"></noscript>
                                                                    <img src="/media/product/SP-LSP9TKAXXV/1618157397vn-the-premiere-lsp9t-sp-lsp9tkaxxv-414047979.jpg" class="progressive-media-image-original progressive-media-content">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column is-10">
                                                    <div class="columns is-mobile item-summary-wrapper">
                                                        <div class="column is-6 item-summary-information">
                                                            <div class="order-name">
                                                                <a href="{{ route('details', $infoProducts->Link) }}">{{ @$infoProducts->Name }}</a>
                                                            </div>
                                                            <div class="attributes">
                                                                <span></span>
                                                            </div>
                                                            <div class="code"><span>{{ $infoProducts->productSku }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="column is-6">

                                                                <?php 
                                                                    $prices = $data->price*$data->qty;
                                                                ?>
                                                                
                                                                 
                                                            <div class="order-price text-right">{{ @number_format($prices) }}đ
                                                            </div>
                                                        </div>
                                                        <div class="cart-item-preorder">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                            @endif

                                            <?php 

                                                 $totalPrice = array_sum($arrPrice);
                                            ?>

                                            
                                        </div>
                                        <div class="help-block"></div>
                                        <div class="order-discount clearfix">
                                        </div>
                                        <div class="tax-summary-cart">
                                            <div class="order-savings clearfix">
                                                <span>Tổng chiết khấu</span>
                                                <span class="pull-right">0 ₫</span>
                                            </div>
                                        </div>
                                        <div class="totals">
                                            <span>Tổng giá</span>
                                            <span class="pull-right"> {{ number_format($totalPrice , 0, ',', '.')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="footer">
                <div class="footer-column container">
                    <div class="columns">
                        <div class="footer-column__item column is-one-quarter">
                            <div class="footer-category">
                                <h3 class="footer-category__title">Sản Phẩm</h3>
                                <div class="footer-category__list-wrap">
                                    <ul class="footer-category__list">
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../tvs/neo-qled-4k.html" title="">
                                            Neo QLED 4K</a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../tvs/neo-qled-8k.html" title="">Neo QLED
                                            8K</a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../tvs/the-premiere.html" title="">
                                            The Premiere</a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="/tvs/lifestyle" title="">Lifestyle</a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../tvs/qled.html" title="">QLED</a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../tvs/uhd.html" title="">UHD</a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../tvs/accessory.html" title="">Accessory</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column__item column is-one-quarter">
                            <div class="footer-category">
                                <h3 class="footer-category__title">Về chúng tôi</h3>
                                <div class="footer-category__list-wrap">
                                    <ul class="footer-category__list">
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="#" title="">Giới thiệu
                                            
                                            </a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="#" title="">
                                            Chính sách bảo hành
                                            </a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="#" title="">
                                            Chính sách vận chuyển & giao nhận
                                            </a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="#" title="">
                                            Quy định hình thức thanh toán
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column__item column is-one-quarter">
                            <div class="footer-category">
                                <h3 class="footer-category__title">Bạn Cần Hỗ Trợ?</h3>
                                <div class="footer-category__list-wrap">
                                    <ul class="footer-category__list">
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../lien-he.html" aria-label="Liên Hệ" title="">Liên Hệ</a>
                                        </li>
                                        <li class="footer-category__item">
                                            <a class="footer-category__link" href="../danh-muc-tin-tuc/ho-tro-ky-thuat.html" title="">Hỗ Trợ Kỹ
                                            thuật</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column__item column is-one-quarter">
                            <div class="footer-category">
                                <h3 class="footer-category__title">Hotline</h3>
                                <p>0932 190 170</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom container">
                    <div class="footer-copyright-wrap">
                        <div class="footer-copyright-align">
                            <p class="footer-copyright">©2021 Siêu thị tivi. </p>
                            <div class="footer-legal">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
        <a class="fab show" title="Go to Top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
        <img class="fab__icon" alt="" src="../images/arrow-up-circle-outline.svg">
        </a>
        <script src="../assets/75a5fa0c/js/progressive-media.min.js"></script>
        <script src="../assets/4f253995/jquery.js"></script>
        <script src="../assets/f8532ac8/yii.js"></script>
        <script src="../assets/f8532ac8/yii.validation.js"></script>
        <script src="../assets/f8532ac8/yii.activeForm.js"></script>
        <script src="../assets/35deb2b4/js/bootstrap.bundle.js"></script>
        <script src="../swiper@8.4.2/swiper-bundle.min.js"></script>
        <script src="../js/owl.carousel.min.js"></script>
        <script src="../js/slick.min.js"></script>
        <script src="../js/main.js"></script>
        <script>jQuery(function ($) {
            jQuery('#contact-form').yiiActiveForm([{"id":"order-order_name","name":"order_name","container":".field-order-order_name","input":"#order-order_name","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Họ tên không được để trống."});yii.validation.string(value, messages, {"message":"Họ tên phải là chuỗi.","max":255,"tooLong":"Họ tên phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-order_phone","name":"order_phone","container":".field-order-order_phone","input":"#order-order_phone","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Số điện thoại không được để trống."});yii.validation.string(value, messages, {"message":"Số điện thoại phải là chuỗi.","max":255,"tooLong":"Số điện thoại phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-order_email","name":"order_email","container":".field-order-order_email","input":"#order-order_email","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Email phải là chuỗi.","max":255,"tooLong":"Email phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-address","name":"address","container":".field-order-address","input":"#order-address","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Địa chỉ không được để trống."});yii.validation.string(value, messages, {"message":"Địa chỉ phải là chuỗi.","max":255,"tooLong":"Địa chỉ phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-company_name","name":"company_name","container":".field-order-company_name","input":"#order-company_name","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Company Name phải là chuỗi.","max":255,"tooLong":"Company Name phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-tax_code","name":"tax_code","container":".field-order-tax_code","input":"#order-tax_code","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Tax Code phải là chuỗi.","max":255,"tooLong":"Tax Code phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-company_address","name":"company_address","container":".field-order-company_address","input":"#order-company_address","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Company Address phải là chuỗi.","max":255,"tooLong":"Company Address phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-email_tax","name":"email_tax","container":".field-order-email_tax","input":"#order-email_tax","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Email Tax phải là chuỗi.","max":255,"tooLong":"Email Tax phải chứa nhiều nhất 255 ký tự.","skipOnEmpty":1});}},{"id":"order-payment_type","name":"payment_type","container":".field-order-payment_type","input":"#order-payment_type","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Payment Type phải là số nguyên.","skipOnEmpty":1});}}], {"errorSummary":".alert.alert-danger","errorCssClass":"is-invalid","successCssClass":"is-valid","validationStateOn":"input"});
            });
        </script>
    </body>
</html>