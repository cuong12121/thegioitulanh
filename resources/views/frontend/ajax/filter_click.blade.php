
    @if(isset($product))
    @foreach($product as $value)

    <?php
        if($value->Quantily==0){
            $status ='Tạm hết hàng';
        
        }
        elseif($value->Quantily<=-1){
            $status ='Ngừng kinh doanh';
        }
        else{
            $status = 'Còn hàng';
        }

    ?>
    <div class="product">
        <div class="img">
            <a href="{{ route('details', $value->Link ) }}" title="{{ $value->Name }}"><img alt="{{ $value->Name }}" src="{{ asset($value->Image) }}"></a>
        </div>
        <h3>
            <p class="name"><a href="{{ route('details', $value->Link ) }}">{{ $value->Name }}</a></p>
        </h3>
        <p class="price">{{ str_replace(',' ,'.', number_format($value->Price)) }}<u>đ</u> 
            <span class="percent">-29%</span>
        </p>
        
        <p class="star"><i class="vstar"><i class="star-0"></i></i> (0 nhận xét)</p>
        <p class="stock"><i class="fa fa-shopping-cart"></i> {{ $status }}
            <i class="check"><input type="checkbox" name="/media/product/75_1430_tu_lanh_samsung_rt19m300bgs_sv_1_300x300.png" class="p_check" id="compare_box_1430" onclick="add_compare_product(1430);"></i>
       
        </p>
    </div>
    @endforeach
    @endif
    
    <div class="clear"></div>
