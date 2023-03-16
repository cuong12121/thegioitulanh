@extends('frontend.layouts.apps')
@section('content')


<div class="container wrap">
    <!--default-->
    <div id="breadcrumb">
        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a itemprop="item" href="/">
                <span itemprop="name">Trang chủ</span>
                </a> <span class="bre-chia"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <meta itemprop="position" content="1">
            </li>
            <!--  -->
            <!-- 2 -->
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a itemprop="item" href="/tu-lanh.html">
                <span itemprop="name">Tủ lạnh</span>
                </a> <span class="bre-chia"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <meta itemprop="position" content="2">
            </li>
        </ol>
    </div>
    <!--breadcrumb-->
    <div class="clear"></div>
    <div class="bn-list" style="display:flex; justify-content: center;">
        <div class="itm fl"><a href="/ad.php?id=139" target="_blank" rel="nofollow"><img border="0" src="/media/banner/26_Nov5799aacfe6adde232a8433c44e9a6279.jpg" width="595" height="215" alt=""></a></div>
        <div class="itm fl"><a href="/ad.php?id=136" target="_blank" rel="nofollow"><img border="0" src="https://dienmayabc.com/media/lib/may-giatcopy.jpg" width="595" height="215" alt="1 doi 1 30 ngay"></a></div>
    </div>
    <div class="clear space5px"></div>
    <div class="pd-left">
        <h1 class="format txt_14">Tủ lạnh</h1>
        <div class="product-list">
            @if(isset($data))
            @foreach($data as $value)

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
            
            @else

            @if(isset($product_search))
                    <?php $arr_id_pro = []; ?>
                   
                @foreach($product_search as $value)

                <?php   

                    $id_product = $value->id;
                    array_push($arr_id_pro, $id_product);

                    $check_deal = App\Models\deal::select('deal_price','start', 'end')->where('product_id', $value->id)->where('active', 1)->first();

                    $deal_check_add = false;

                    
                    if(!empty($check_deal) && !empty(!empty($check_deal->deal_price))){
                         $now  = Carbon\Carbon::now();
                        $timeDeal_star = $check_deal->start;
                        $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);
                        $timeDeal_end = $check_deal->end;
                        $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);
                        $timestamp = $now->diffInSeconds($timeDeal_end);

                        if($now->between($check_deal->start, $check_deal->end)){
                           
                            $value->Price = $check_deal->deal_price;
                            
                        }
                        
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
                    <p class="stock"><i class="fa fa-shopping-cart"></i> {{ @$status }}
                        <i class="check"><input type="checkbox" name="/media/product/75_1430_tu_lanh_samsung_rt19m300bgs_sv_1_300x300.png" class="p_check" id="compare_box_1430" onclick="add_compare_product(1430);"></i>
                   
                    </p>
                </div>
                @endforeach
            @endif
            @endif
            
            <div class="clear"></div>
        </div>
        <div class="top_area_list_page">
            <div class="paging">
                <a href="/tu-lanh.html?page=1">1</a>
                <a href="/tu-lanh.html?page=2">2</a>
                <a href="/tu-lanh.html?page=3">3</a>
                <a href="/tu-lanh.html?page=4">4</a>
                <a href="/tu-lanh.html?page=5">5</a>
                <a href="/tu-lanh.html?page=6">6</a>
                <a href="/tu-lanh.html?page=7">7</a>
            </div>
            <!--paging-->
            <div class="clear"></div>
        </div>
        <div class="clear space10px"></div>
        <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop" data-width="970" data-href="https://dienmayabc.com/tu-lanh.html" data-numposts="10" data-colorscheme="light" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=&amp;color_scheme=light&amp;container_width=970&amp;height=100&amp;href=https%3A%2F%2Fdienmayabc.com%2Ftu-lanh.html&amp;locale=vi_VN&amp;numposts=10&amp;sdk=joey&amp;version=v4.0&amp;width=970"><span style="vertical-align: bottom; width: 970px; height: 212px;"><iframe name="f4c8493068014" width="970px" height="100px" data-testid="fb:comments Facebook Social Plugin" title="fb:comments Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v4.0/plugins/comments.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df150747ecfafea%26domain%3Ddienmayabc.com%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fdienmayabc.com%252Ff25bad8e84fdcfc%26relation%3Dparent.parent&amp;color_scheme=light&amp;container_width=970&amp;height=100&amp;href=https%3A%2F%2Fdienmayabc.com%2Ftu-lanh.html&amp;locale=vi_VN&amp;numposts=10&amp;sdk=joey&amp;version=v4.0&amp;width=970" style="border: none; visibility: visible; width: 970px; height: 212px;" class=""></iframe></span></div>
        <div class="clear"></div>
    </div>
    <!--//pd-left-->
    <div class="pd-right att-list">

        @if(isset($filter))
        @foreach($filter as $filters)

        
        <?php
            $filtername = '';
            $propertyId = cache()->remember('filterId_'.$filters->id, 1000, function () use($filters){

                $propertyId =  App\Models\property::where('filterId', $filters->id)->get()??'';
                return $propertyId;
            });
           
        ?>

        @if($filters->name !=  $filtername)
        <div class="att-title">{{ $filters->name }}</div>
        <ul class="ul">
            @if(isset($propertyId))
            @foreach($propertyId as $property)
            <li>
                <input  type="checkbox" name="property" value="{{ $property->id }}"> 
                <h2 class="format txt_13 txt_n"><a href="/tu-lanh-hitachi.html">{{ $property->name}}</a></h2>
            </li>
            @endforeach
            @endif
           
        </ul>
        @endif
                        
        @endforeach
        @endif
        
    </div>
    <!--//pd-right-->
    <div class="clear"></div>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $('input:checkbox[name=property]').each(function() 
    {    
        if($(this).is(':checked'))
          alert($(this).val());
    });


    function checked(propertyId, id) {
        var checked = $('#active'+productId).is(':checked'); 

        var active = 0;

        if(checked == true){
            active = 1;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
           
        $.ajax({
           
            type: 'POST',
            url: "https://dienmaynguoiviet.vn/admins/check-active",
            data: {
                product_id: productId,
                active:active
                   
            },
            success: function(result){
                console.log(result);
            }
        });
       
    }   


</script>
@endsection