@extends('frontend.layouts.apps')
@section('content') 
<link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}?ver=1"> 

<link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}?ver=1"> 
<link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=1"> 
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=1"> 


<style type="text/css">
    td table{
        width: 100%;
    }
    .td-info{
        padding: 0;
        text-align: center;
    }

    #text{
        display: none;
    }
    .text-h3{
        font-size: 30px;
        margin-bottom: 20px;
    }
    td{
        text-align: center;
    }

    .code{
        color: #BF0000;
        font-weight: bold;
    }
    .code-image{
        width: 36%;
    }

    .fa-angle-right{
        display: none;
    }

    .btn-add-cart{
        width: 100%;
        margin: 0 auto;
    }
    .div-button{
        padding: 10px;
    }
    @media only screen and (max-width: 767px) {
     
        .text-h3{
            margin-top: 20px !important;
        }    
    }

</style>
<div class="container">
    <h3 class="text-h3">So sánh sản phẩm</h3>
    <br>
    <div class="table-responsive-lg">
        <table id="tb_padding" border="1" bordercolor="#CCCCCC" style="width:100%">
            <tbody> 

                <?php

                    $data_id = $_GET['cate']??6;

                    $ar_gr[1] = ['Tên sản phẩm','Ảnh sản phẩm','Kích cỡ màn hình', 'Độ phân giải', 'Công nghệ âm thanh', 'Nơi sản xuất', 'Cổng HDMI', 'Công nghệ xử lý hình ảnh', 'Kích thước có chân, đặt bàn', 'Kích thước không chân, treo tường'];
                    $ar_gr[2] = ['Tên sản phẩm','Ảnh sản phẩm','Khối lượng giặt', 'Khối lượng sấy', 'Tốc độ quay vắt', 'Kiểu động cơ', 'Lồng giặt', 'Công nghệ giặt', 'Kích thước - Khối lượng', 'Nơi sản xuất'];
                    $ar_gr[3] = ['Tên sản phẩm','Ảnh sản phẩm','Dung tích sử dụng', 'Dung tích ngăn đá', 'Dung tích ngăn lạnh', 'Công nghệ Inverter', 'Kiểu tủ', 'Kích thước - Khối lượng', 'Nơi sản xuất'];
                    $ar_gr[4] = ['Tên sản phẩm','Ảnh sản phẩm','Loại máy', 'Công suất làm lạnh', 'Công suất sưởi ấm', 'Phạm vi làm lạnh hiệu quả', 'Chế độ tiết kiệm điện', 'Loại Gas sử dụng', 'Nơi sản xuất', 'Năm ra mắt'];

                    $ar_gr[5] = ['Tên sản phẩm', 'Ảnh sản phẩm', 'Đặc điểm nổi bật'];  
                    $ar = $data_id<5?$ar_gr[$data_id]:$ar_gr[5];

                
                ?>

               
                @if(count($ar)>0 && isset($data))

                <?php 
                    $info_product = [];

                    $ar_sp = [];

                    $list_filter = [];

                    $pd_filter = [];
                    foreach ($data as $keys => $value) {

                        $product = App\Models\product::find($value);

                        if($data_id <5){

                            if(!empty($product->Specifications)){

                                $html = $product->Specifications;

                                $dom = new \DOMDocument();

                                $html = mb_convert_encoding($html , 'HTML-ENTITIES', 'UTF-8'); //convert sang tiếng việt cho dom

                                $dom->loadHTML($html);

                                foreach($dom->getElementsByTagName('td') as $td) {

                                    foreach($ar as $key => $value) {

                                        if(strpos($td->nodeValue, $value)>-1){

                                            // $ar_sp[$keys][$key] =  !empty($td->nodeValue)?str_replace($value, '', $td->nodeValue):'';

                                            $pd_filter[$keys][$value] = !empty($td->nodeValue)?str_replace([$value,':'], '', $td->nodeValue):'';

                                            // array_push($list_filter, $value);
                                            
                                        }


                                    }
                                } 

                               $pd_filter[$keys]['Ảnh sản phẩm'] = htmlspecialchars_decode('<img width="327" class="code-image" src="'.asset($product->Image).'">');
                               $pd_filter[$keys]['Tên sản phẩm'] = '<b>'.$product->Name.'</b>';
                               $pd_filter[$keys]['id'] = $product->active===1&&$product->Quantily>0?$product->id:'';
                               $pd_filter[$keys]['links'] = $product->active===1&&$product->Quantily>0&&$product->Price>3000000?route('details', $product->Link).'?show=tra-gop':'';

                            }
                           
                        }
                        else{
                            $pd_filter[$keys]['Tên sản phẩm'] = $product->Name;
                            $pd_filter[$keys]['Ảnh sản phẩm'] = '<img width="327" class="code-image" src="'.asset($product->Image).'">';
                            $pd_filter[$keys]['Đặc điểm nổi bật'] = str_replace(['Xem thêm', 'Đặc điểm nổi bật'], '', html_entity_decode($product->Salient_Features));
                            $pd_filter[$keys]['id'] = $product->active===1&&$product->Quantily>0?$product->id:'';
                            $pd_filter[$keys]['links'] = $product->active===1&&$product->Quantily>0&&$product->Price>3000000?route('details', $product->Link).'?show=tra-gop':'';
                        }

                    }

                ?>

                
                @foreach($ar as $keypd=> $filters)
                
                <tr>
                    <td><b>{{ $filters }}</b></td>
                    @foreach($pd_filter as  $info_productss)
                    <td>
                        <div style="max-height:250px; overflow:auto">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="td-info">
                                             
                                            <div class="div-button">  
                                                <label for="code">{!! !empty($info_productss[$filters])?$info_productss[$filters]:'' !!}</label>
                                            </div>

                                        </td>
                                        
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </td>
                   
                    @endforeach
                </tr>
                @endforeach

                <tr>
                    <td><b></b></td>
                    @foreach($pd_filter as  $info_productss)
                    <td>
                        <div style="max-height:250px; overflow:auto">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="td-info">
                                            @if(!empty($info_productss['id']))
                                            <div class="div-button">  
                                                <button type="button" class="btn btn-lg  btn-add-cart redirectCart" onclick="addToCart({{ $info_productss['id'] }})">MUA NGAY <br>(Giao hàng tận nơi - Giá tốt)</button>
                                            </div>
                                            @endif
                                        </td>
                                        
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </td>
                    @endforeach

                </tr>

                <tr>
                    <td><b></b></td>
                    @foreach($pd_filter as  $info_product_link)
                    <td>
                        <div style="max-height:250px; overflow:auto">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="td-info">
                                             @if(!empty( $info_product_link['links']))
                                            <div class="div-button">  
                                                <a target="_blank" class="but-tra-gop installments-but" href="{{ $info_product_link['links'] }}" admicro-data-event="101725" admicro-data-auto="1" admicro-data-order="false"> <strong>TRẢ GÓP QUA THẺ</strong> <br> (Visa, Master, JCB) </a>
                                            </div>
                                            @endif
                                        </td>
                                        
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </td>
                    @endforeach

                </tr>

                @endif
                
            </tbody>
        </table>
    </div>
    
</div>

<script type="text/javascript">
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
</script>


@endsection