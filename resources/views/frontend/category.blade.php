@extends('frontend.layouts.apps')
@section('content')


<style type="text/css">
    @media only screen and (max-width: 768px) {
        .pd-left{
            width: 100%;
        }
        .pd-right{
            width: 100%;
        }
        .product{
            width: 49%;
        }
        .fb-comments{
            display: none;
        }
    }
</style>

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
                    <!-- <span class="percent">-29%</span> -->
                </p>
                
                <p class="star"><i class="vstar"><i class="star-0"></i></i> (0 nhận xét)</p>
                <p class="stock"><i class="fa fa-shopping-cart"></i> {{ $status }}
                    <i class="check"><input type="checkbox" name="/media/product/75_1430_tu_lanh_samsung_rt19m300bgs_sv_1_300x300.png" class="p_check" id="compare_box_1430" onclick="add_compare_product(1430);"></i>
               
                </p>
            </div>
            @endforeach
            @endif
            
            <div class="clear"></div>
        </div>

        @if(\Request::route()->getName()!='search-product-frontend' && !empty($data))

        <div class="top_area_list_page">
            <div class="paging">

                <?php 

                    $limit =  floor(intval($numberdata)/12); 
                ?>
                @for($i=0; $i<=$limit; $i++)
                @if($page>5)
                    @if($i<=$page+4 && $i>$page-6)

                    <a href="{{ route('details',$link) }}?page={{ $i+1 }}">{{ $i+1 }}</a>
                    @endif
                @else 
                    @if($i<10)
                    <a href="{{ route('details',$link) }}?page={{ $i+1 }}">{{ $i+1 }}</a>
                    @endif
                @endif
                @endfor    
            </div>
            <!--paging-->
            <div class="clear"></div>
        </div>
        @endif
        
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
            <li class="filters-{{ $filters->id }}">
                <input  type="checkbox" name="property" value="{{ $property->id }}" onclick = "filterClick({{ $property->id }}, {{ $filters->id }})" id="filterClick{{ $property->id }}" data-id="{{ $filters->id }}"> 
                <h2 class="format txt_13 txt_n"><a href="/tu-lanh-hitachi.html">{{ $property->name}} </a></h2>
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

     function filterClick(id,filterId) {
        var checked = $('#filterClick'+id).is(':checked'); 

        checked_fil = [];

        if(checked == true){
            
            $('#filterClick'+id).parent().removeClass('filters-'+filterId);

            $('.filters-'+filterId).hide();
           
        }   
        else{
            var index = checked_fil.indexOf(id);
            if (index !== -1) {
              checked_fil.splice(index, 1);
            }
        } 

        checked_fil = [...new Set(checked_fil)];

       

        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: "{{ route('filter-checkbox') }}",
            data: {
                datas: id,
                id:filterId
               
            },
           
            success: function(result){


                $('.product-list').html('');

                $('.product-list').append(result)

            }
        });

    }
</script>
@endsection