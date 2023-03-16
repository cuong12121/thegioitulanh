@extends('frontend.layouts.apps')

@section('content')

<style>
    #submit-cart{
        cursor: pointer;
    }

</style>

<div class="container wrap">
    <div class="clearfix" style="clear: both;"></div>
    <section class="box-cart-2021">
        <div class="box-cart-2021-bg" style="right: -351px;"></div>
        <form method="post" enctype="multipart/form-data" action="{{ route('order') }}" onsubmit="return check_field()">

            <div class="content-cart-all">
                <div class="content-cart-all-l">
                    <div class="box-cart-2021-left">
                        <div class="title-cart-new">Thế giới tủ lạnh </div>
                        <div class="content-cart-left-new">
                            <div class="content-cln-l">
                                <div class="title-cart-child">Thông tin nhận hàng</div>
                                <div class="item-cart">
                                    <input type="text" name="mail" id="buyer_email" value="" placeholder="Email*" class="form-control">
                                </div>
                                <div class="item-cart">
                                    <input type="text" name="name" id="buyer_name" value="" placeholder="Họ tên*" class="form-control">
                                </div>
                                <div class="item-cart">
                                    <input type="text" name="phone_number" id="buyer_tel" value="" placeholder="SĐT*" class="form-control">
                                </div>
                                <div class="item-cart">
                                    <input type="text" name="address" id="buyer_address" value="" placeholder="Địa chỉ (tên đường, số nhà)*" class="form-control">
                                </div>
                                <input type="hidden" name="sex" id="sex" value="Anh">
                                <input type="hidden" name="province"  value="1">
                            </div>
                            <div class="content-cln-r">
                                <div class="box-shipping-new">
                                    <div class="title-cart-child">Vận chuyển</div>
                                    <div class="ship-note">Vui lòng nhập thông tin thanh toán</div>
                                </div>
                                <div class="box-paymethod-new">
                                    <div class="title-cart-child">Thanh toán</div>
                                    <div class="box-paymethod-new-ct">
                                        <label for="pay_method2" onclick="showPayDetail(2)">
                                        <input type="radio" id="pay_method2" name="pay_method" value="2" class="pay_option" checked="">
                                        <span class="radiobtn"></span>
                                        <span class="txt">Thanh toán tiền mặt khi nhận hàng</span>
                                        </label>
                                        
                                    </div>
                                    <div class="box-paymethod-new-ct-dt">
                                        <div class="item-dt active" id="pay-detail-2">
                                        </div>
                                        <div class="item-dt " id="pay-detail-3">
                                        </div>
                                        <div class="item-dt " id="pay-detail-4">
                                        </div>
                                        <div class="item-dt " id="pay-detail-5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-l-bot">
                            <a href="/">Chính sách giao hàng</a>
                            <a href="/">Điều khoản sử dụng</a>
                        </div>
                    </div>
                </div>

                <?php

                    $arrPrice = [];
                    $key = 0;
                    

                    $cart = Gloudemans\Shoppingcart\Facades\Cart::content();

                    

                    $number_cart = count($cart);


                   
                 ?>  

                @if($number_cart>0)
                <div class="content-cart-all-r">
                    <div class="box-cart-2021-right">
                        <div class="box-pro-cart-new">
                            <div class="title-cart-pro">
                                Đơn hàng <span>{{ $number_cart }}</span> sản phẩm
                            </div>
                            <table>
                                <!---->
                                <!---->
                                <tbody>
                                     @foreach($cart as $key => $data)

                                    <?php 

                                        $price = (int)$data->price*(int)$data->qty;
                                        $key++;
                                        array_push($arrPrice, $price);

                                        $infoProducts = App\Models\product::find($data->id);

                                    ?> 
                                    <tr class="cartItem">

                                        <td valign="top" width="80" style="text-align: center;">
                                            <img src="{{ asset($infoProducts->Image) }}" width="50"> <br>
                                            <a class="txt_999" href="javascript:" onclick="RemoveCart('{{ $data->rowId }}')">
                                            <i class="fa fa-remove"></i>
                                            Xóa</a>
                                        </td>
                                        <td>
                                            <a href="/lg-fv1413h3ba.html" class="p-c-name">{{ $infoProducts->Name }}</a>
                                            <input class="txtnum" name="quantity_pro_3570" id="quantity_pro_3570" value="1" onchange="updatePrice('pro','3570',this.value)" size="1" type="hidden">
                                        </td>
                                        <td width="120">
                                            <input type="hidden" class="buy-price" value="18690000">
                                            <?php 
                                                $prices = $data->price*$data->qty;

                                            ?>

                                                                     
                                            <span class="js-show-buy-price" id="sell_price_pro_3570">{{ @number_format($prices) }} đ</span>
                                            <span class="total-item-price" id="price_pro_3570" style="display: none;"></span>
                                            <a class="txt_999" href="javascript:deleteShoppingCartItem('pro','3570','1','18690000')" style="float:right;margin-top: 5px;display: none;">
                                            <i class="fa fa-remove"></i>
                                            Xóa</a>
                                        </td>
                                    </tr>

                                    @endforeach


                                    <?php 

                                        $totalPrice = array_sum($arrPrice);
                                    ?>
                                </tbody>
                            </table>
                            <div class="cart-total-content">
                                <div class="item-c">
                                    <span class="txt">Tạm tính</span>
                                    <span class="price-c total-cart-price" id="total_value">{{ number_format($totalPrice , 0, ',', '.')}} đ</span>
                                </div>
                                <div class="item-c">
                                    <span class="txt">Phí chuyển đổi</span>
                                    <span class="price-c" id="price-chuyen-doi">0 đ</span>
                                </div>
                                <div class="item-c item-c-total">
                                    <span class="txt">Tổng cộng</span>
                                    <span class="price-c" id="total_value_buy">{{ number_format($totalPrice , 0, ',', '.')}} đ</span>
                                </div>
                                <div class="item-c item-c-btn">
                                    <button type="submit" id="submit-cart" class="btn btn-red float-right fw-500" style="padding:8px 30px; font-size:15px;">Đặt hàng</button>
                                    <input type="hidden" name="send_order" value="yes">
                                    <input type="hidden" name="item_update_quantity" id="item_update_quantity" value=",pro-3570,pro-2885,">
                                    <input type="hidden" name="update_quantity" value="yes">
                                    <input type="hidden" name="total_cart_value" id="total_cart_value" value="56580000">
                                    <!--<input type="hidden" name="test_mail_template" value="1">-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </form>
    </section>
    <div class="clearfix" style="clear: both;"></div>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    function RemoveCart(id) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: "{{ route('removeCart') }}",
            data: {
                product_id: id,
               
                   
            },
            beforeSend: function() {
               
                $('.loader').show();

            },
            success: function(result){

              window.location.href = "{{ route('cart-tgtl') }}"; 
                
            }
        });

    }

</script>
@endsection