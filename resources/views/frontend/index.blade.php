@extends('frontend.layouts.apps')

@section('content')

 @push('css')

 <style type="text/css">
    @media only screen and (max-width: 767px) {
        .wrapper {
            min-width: unset;
        }
        .product-list{
            width: 100%;
        }
        .product{
            width: 49%;
        }
        .ah-item{
            width: 100%;
        } 
        .ah-item .title{
            width: 100%;
            padding: 0;
        }
    }

 </style>

 @endpush

<ul class="ul bxslider bxhome fomart">
    <li>
        <a href="https://thegioitulanh.vn/tu-lanh-hitachi" target='_blank' rel='nofollow'><img border=0 src="https://thegioitulanh.vn/wp-content/uploads/2021/04/Inkedbanner-2021_LI.jpg" alt="" /></a>
    </li>
   
   <!--  <li><a href="/ad.php?id=130" target='_blank' rel='nofollow'><img border=0 src="/media/banner/21_Novf118303817153f4a0617a49ca2c09acd.png" alt="mua tủ lạnh tại kho" /></a></li>
    <li><a href="/ad.php?id=129" target='_blank' rel='nofollow'><img border=0 src="/media/banner/19_Mar0c973e13f92b24359d33f29fa20e7f55.png" alt="máy giặt" /></a></li> -->
</ul>
<div class="clear space10px"></div>
<div class="wrap">
    <div class="product-list">
        <?php 
            $hot = DB::table('hot')->select('product_id')->orderBy('orders', 'asc')->get()->pluck('product_id');


            $product        = App\Models\groupProduct::find(3);

            if(!empty($product)){
                $product_tl      = json_decode($product->product_id);


                $data   =  App\Models\product::whereIn('id',  $product_tl)->orderBy('id', 'desc')->where('active', 1)->take(40)->get();
            }

            

           
        ?>
        @if(!empty($data) && $data->count()>0)
        @foreach($data as $datas)
        <div class="product">
            <div class="img">
                <a href="{{ route('details', $datas->Link) }}" title="{{ $datas->Name }}"><img alt="{{ $datas->Name }}" src="{{ asset($datas->Image) }}"></a>
            </div>
            <h3>
                <p class="name"><a href="{{ route('details', $datas->Link) }}">{{ $datas->Name }}</a></p>
            </h3>
            <p class="price">{{ @number_format($datas->Price , 0, ',', '.')}} <u>đ</u> 

                @if($datas->manuPrice>0)

                <?php 

                    $per = floatval(((intval($datas->manuPrice) - intval($datas->Price))/intval($datas->manuPrice))*100);

                ?>

                <span class="percent">-{{ $per }}%</span>

                @endif
            </p>
            <!-- <p class="mprice">104.900.000 <u>đ</u></p> -->
            <p class="star"><i class="vstar"><i class="star-0"></i></i> (0 nhận xét)</p>
            
        </div>
        @endforeach
        @endif
        
        <div class="clear"></div>
    </div>
    <!--//product-->
    <?php
        $post = App\Models\post::where('active',1)->where('hight_light', 1)->OrderBy('created_at', 'desc')->select('link', 'title', 'image')->limit(3)->get()->toArray();
     ?>
    <div class="clear space10px"></div>
    <div class="article-home">
        <h4 class="format txt_14">
            <p class="name format txt_b">Kinh nghiệm hay</p>
        </h4>

         @if(isset($post) && count($post)>0)
         @for($i=0; $i<count($post); $i++)
        <div class="ah-item {{ $i==2?'end':'' }}">
            <a href="{{ route('details', $post[$i]['link']) }}"><img src="{{ asset($post[$i]['image']) }}" alt="{{ $post[$i]['title'] }}"/></a>
            <h5 class="format txt_12 txt_n">
                <p class="title"><a href="{{ route('details', $post[$i]['link']) }}">{{ $post[$i]['title'] }}</a></p>
            </h5>
        </div>
        @endfor
        @endif
        
        <div class="clear"></div>
    </div>
    <!--//article-->
</div>
@endsection