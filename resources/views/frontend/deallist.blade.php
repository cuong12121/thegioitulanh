

@extends('frontend.layouts.apps')

@section('content') 



 @push('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}"> 

        <link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}"> 
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}"> 

        <style type="text/css">
            
            .box-filter .form-control{
                width: 100%;
            }
            .block-manu{
                width: 150px;
            }
            #clock{
              user-select:none;
            }
            .glow{
              font-size:10vw;
              font-weight:bold;
              animation:glow 1s ease-in-out infinite alternate;
              -moz-animation:glow 1s ease-in-out infinite alternate;
              -webkit-animation:glow 1s ease-in-out infinite alternate;
            }

            .list-pro h3 {
                 height: 42px;   
             }  

             #deal_list_page .tbl_time tbody td {
                font-size: 15px;
                font-weight: bold;
                color: #0080cb;
                text-align: center;
            } 

           


        </style>

    
    @endpush

<section id="categoryPage" class="desktops" data-id="1942" data-name="Tivi" data-template="cate">
     <div id="clock"></div>
    <div class="container-productbox">

        <?php 
            $deal = App\Models\deal::orderBy('order', 'desc')->get();
            $now  = Carbon\Carbon::now();
            if(!empty($deal)&count($deal)>0){
                $timeDeal_star = $deal[0]->start;
                $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);
                $timeDeal_end = $deal[0]->end;
                $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);
                $timestamp = $now->diffInSeconds($timeDeal_end);
        
            }
        ?>

        
        @if(!empty($deal)&count($deal)>0)
        <div class="row list-pro">
            
            @foreach($deal as $key => $value)

            @if( $value->active ==1&& $now->between($value->start, $value->end))  


            <?php 
                $product = App\Models\product::find($value->product_id);
                $price_old = $product->Price;
                $percent = ceil((int)$price_old/(int)$value->deal_price);
            ?>                                                     
            <div class="col-md-3 col-6 lists deal{{ $key }}">
                <div class="item  __cate_1942">
                    <a href="{{ route('details', $value->link) }}" data-box="BoxCate" class="main-contain">
                        <span class="icon_tragop">Trả góp <i>0%</i></span>
                        <div class="item-img item-img_1942">
                            <img class="thumb ls-is-cached lazyloaded" data-src="" alt="{{ $value->name }}" style="width:100%" src="{{ asset($product->Image) }}"> 
                        </div>
                        <div class="items-title">
                             
                            <h3>
                               {{ $value->name }}
                            </h3>

                                                                                                                              
                            <strong class="price">{{ @str_replace(',' ,'.', number_format($value->deal_price))}}&#x20AB;</strong>
                           
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>

                            </div>

                        </div>
                        
                    </a>
                    <div class="item-bottom">
                        <a href="#" class="shiping"></a>
                    </div>
                    <table class="tbl_time" width="100%">
                        <thead>
                            <tr>
                            <td>Tiết kiệm</td>
                            <td>Người đã mua</td>
                            <td>Thời gian còn lại</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr bgcolor="#eee">
                            <td align="center">{{ @$percent }}%</td>

                            <?php 

                                if($value->id%2==0){
                                    $numberDeal = 6;
                                }
                                else{
                                    $numberDeal = 5;
                                }
                            ?>
                            <td align="center">{{ $numberDeal }}</td>
                           
                                <?php 

                                    $timestamp = $now->diffInSeconds($value->end);

                                    $hour =  floor($timestamp/3600);
                                    $timestamp = floor($timestamp % 3600);
                                    $minutes =floor($timestamp/60);
                                    $timestamp = floor($timestamp % 60);
                                    $seconds =floor($timestamp);

                                ?>
                                <td align="center">
                                    <div class="clock"><span class="hour">{{ $hour }}</span>:<span class="minutes">{{ $minutes }}</span>:<span class="second">{{ $seconds }}</span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                 
                </div>
            </div>

            @endif

        @endforeach
                                                                                        
        </div>


        @endif
       
    </div>


  
    <div class="errorcompare" style="display:none;"></div>
  
    <div class="watched"></div>
    <div class="overlay"></div>

    @push('script')

    <script type="text/javascript">

        var loop = {{ count($deal) }};
        setInterval(function(){
            for (var i = 0 ; i < loop; i++) {
                run(i);
            }

        }, 1000);


        function run(key) {

          
            var hour =  $('.deal'+key+' .hour').text();
            var minutes =  $('.deal'+key+' .minutes').text();
            var second =  $('.deal'+key+' .second').text();
            h =  parseInt(hour);
            m = parseInt(minutes);
            s = parseInt(second);
            s--;
            /*BƯỚC 1: CHUYỂN ĐỔI DỮ LIỆU*/
              // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
              //  - giảm số phút xuống 1 đơn vị
              //  - thiết lập số giây lại 59
            if (s === -1){
                  m -= 1;
                 
                  s = 59;
            }

            // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
            //  - giảm số giờ xuống 1 đơn vị
            //  - thiết lập số phút lại 59
            if (m === -1){
                h -= 1;
                m = 59;
            }

             if (h < 0){
                $('.deal'+key).remove();
              }  

            hour =  h.toString();

            minutes =  m.toString();
            
            seconds =  s.toString();
          
            let currentHour = h<10?'0'+hour:''+hour;
            let currentMinutes = m<10?'0'+minutes:''+minutes;
            let currentSeconds = s<10?'0'+seconds:''+seconds;
    
            let currentTimeStr ='<span class="hour">'+ currentHour+'</span>:<span class="minutes">'+currentMinutes+'</span>:<span class="second">'+currentSeconds+'</span>' 

            $('.deal'+key+' .clock').html(currentTimeStr);
        }



    </script>
    @endpush
   
   
</section>

@endsection