<html lang="vi">
    <head>
        <meta charset="utf-8">
        <title>Trả góp online</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="Trả góp online">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style type="text/css">
            .require {
            color: red;
            }
            .form-group.col-sm-5{margin: 5px;}
            #header {
            background: #0083d1;
            overflow: hidden;
            padding: 8px 10px;
            }
            .btn-info {
            color: #fff;
            background-color: #333 !important;
            border-color: #333;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <a href="/" style="float: left;"><img src="/uploads/product/1642667048_5767_77c1ptb_501.jpg" alt="" style="height:34px;"></a>
            <h1 style="color: #fff;text-transform: uppercase;font-weight: bold;font-size: 22px;margin: 5px 20px;float: left;">Trả góp online</h1>
        </div>
        <div id="container" class="container">
            <div class="col-sm-5 col-xs-12">
                <h3 id="titleItem">
                    {{ $data->Name }}
                </h3>

                <?php 

                    $check_deal = App\Models\deal::select('deal_price')->where('product_id', $data->id)->where('active', 1)->first();

                    if(empty($check_deal)){

                        $now = \Carbon\Carbon::now();

                        // check flash deal
                        $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;
                        $date_flashdeal = \Carbon\Carbon::create($date_string_flash_deal);

                        if($date_flashdeal->isToday()){
                            $add_date = $date_string_flash_deal;
                            $time1_start = \Carbon\Carbon::createFromDate($add_date.', 9:00');
                            $time1 = \Carbon\Carbon::createFromDate($add_date.', 12:00');
                            $time2_start = \Carbon\Carbon::createFromDate($add_date.', 12:00');
                            $time2 = \Carbon\Carbon::createFromDate($add_date.', 14:00');
                            $time3_start = \Carbon\Carbon::createFromDate($add_date.', 14:00');
                            $time3 = \Carbon\Carbon::createFromDate($add_date.', 17:00');
                            $time4_start = \Carbon\Carbon::createFromDate($add_date.', 17:00');
                            $time4 = \Carbon\Carbon::createFromDate($add_date.', 22:00');
                            $define = [['start'=>'9h', 'endTime'=>$time1, 'startTime'=>$time1_start], ['start'=>'12h', 'endTime'=>$time2, 'startTime'=>$time2_start], ['start'=>'14h', 'endTime'=>$time3, 'startTime'=>$time3_start], ['start'=>'17h', 'endTime'=>$time4, 'startTime'=>$time4_start]];

                            foreach($define as $key => $value){
                                if($now->between($value['startTime'], $value['endTime'])){
                                    
                                    $groups_deal = $key;

                                    $groups_deal = $groups_deal+1;

                                    $check_deal = App\Models\flashdeal::where('product_id',  $data->id)->where('flash_deal_time_id', $groups_deal)->where('active',1)->first();
                                    
                                }    

                            }    
                        }   
                    }
                    if(!empty($check_deal) && !empty(!empty($check_deal->deal_price))){

                        $data->Price = $check_deal->deal_price;

                    }

                ?>
                <br>
                <p><img src="{{ asset($data->Image) }}" width="250" alt="{{ $data->Name }}"></p>
                <p class="txt_u txt_red txt_18"><strong>Giá</strong>: <span class="price_info price_config" data-price="{{ @str_replace(',' ,'.', number_format($data->Price))}}" style="color:#e00; font-weight:bold;">{{!empty($check_deal)?str_replace(',' ,'.', number_format(trim($data->Price))):str_replace(',' ,'.', number_format(trim($data->Price))) }}VND</span></p>
                <p id="config-info"></p>
                <p><strong>Bảo hành</strong>: 24 Tháng
                </p>
                <p><b>Tình trạng: </b> Còn hàng</p>
                <p>&nbsp;</p>
            </div>
            <!--col-->
            <div class="col-sm-7">
                <h3>Thông tin khách hàng</h3>
                <form class="form-" role="form" method="POST" id="formSubmit" action="{{ route('alepay') }}">

                    @csrf
                    <div class="form-group col-sm-5">

                        <label class="control-label">Tổng Tiền <span class="require">(*)</span></label>

                        <input type="text" class="form-control"name="amount" id="amount" value="{{ @str_replace(',' ,'.', number_format($data->Price))}}"   required  readonly>

                    </div>

                    <div class="form-group col-sm-5">     
                        <label class="control-label">Số Tiền trả trước <span
                                class="require">(*)</span></label>

                        <input type="text" placeholder="Số tiền trả trước" class="form-control" name="before_money" id="before_money" onkeyup="this.value = writeStringToPrice(this.value)" value="0" >
                    </div>
                    <div class="form-group col-sm-5">     
                        <label class="control-label">Số Lượng <span class="require">(*)</span></label>

                        <input type="text" placeholder="Số Lượng" class="form-control" name="totalItem" id="totalItem" required value="1">

                    </div>

                    <!-- Text input-->
                   <!--  <div class="form-group col-sm-5">
                        <label class="control-label">Tiền Tệ <span
                                class="require">(*)</span></label>

                        <select name="currency" id="currency" class="form-control">
                            <option value="VND" selected>VND</option>
                            <option value="USD">USD</option>
                        </select>

                    </div> -->
                    <div class="form-group col-sm-5">     
                        <label class="control-label">Email <span
                                class="require">(*)</span></label>

                        <input type="text" placeholder="Email" class="form-control"
                               name="buyerEmail"
                               id="buyerEmail" required>

                    </div>
                    <!-- Text input-->
                    <div class="form-group col-sm-5">
                        <label class="control-label">Họ Tên <span  class="require">(*)</span></label>

                        <input type="text" placeholder="Tên" class="form-control"
                               name="buyerName"
                               id="buyerName" required>
                    </div>
                    <div class="form-group col-sm-5">     
                        <label class="control-label">Số Điện Thoại <span
                                class="require">(*)</span></label>

                        <input type="text" placeholder="Số Điện Thoại" class="form-control"
                               name="phoneNumber"
                               id="phoneNumber" required>
                    </div>
                    <!-- Text input-->
                    <div class="form-group col-sm-5">
                        <label class="control-label">Địa Chỉ <span
                                class="require">(*)</span></label>

                        <input type="text" placeholder="Địa Chỉ" class="form-control"
                               name="buyerAddress"
                               id="buyerAddress" required>

                    </div>
                 
                    <!-- Text input-->
                   <!--  <div class="form-group col-sm-5">
                        <label class="control-label" for="orderDescription">Mô Tả Hóa
                            Đơn<span class="require">(*)</span></label>

                        <textarea placeholder="Thông Tin Mô Tả Hóa Đơn" id="orderDescription"
                                  name="orderDescription"
                                  class="form-control" required=""></textarea>
                    </div> -->
                    <div class="form-group col-sm-5">     
                        <label class="control-label">Thành Phố <span
                                class="require">(*)</span></label>

                        <input type="text" placeholder="Thành Phố" class="form-control"
                               name="buyerCity"
                               id="buyerCity" required value="Hà Nội">

                        <input type="hidden" name="product_id" value="{{ $data->id }}">  
                        <input type="hidden" name="product_name" value="{{ $data->Name }}">  
                        <input type="hidden" name="amountPre" id="amountPre" value="{{ @str_replace(',' ,'.', number_format($data->Price))}}" >    

                        <?php 
                            session(['priceProduct' => str_replace(',' ,'.', number_format($data->Price))]);
                            
                        ?>
                    </div>
                    <div class="row"></div>
                    <div class="col-sm-12" id="alert"></div>
                    <div class="form-group col-sm-5">
                        <p>&nbsp;</p>
                        <button id="sendInstallment" type="submit" class="btn btn-info btn-lg" name="sendInstallment">
                            Thanh Toán Trả Góp
                        </button>

                    </div>
                   
                </form>
                <input type="hidden" name="prePrice" id="prePriceInput" value="0">
            </div>
        </div>
        <!--    Start sendOrderToAlepayInstallment    -->
        <!--    End sendOrderToAlepayInstallment    -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
            
        </script>

        <script type="text/javascript">

              function numberWithCommas(x) {
                var parts = x.toString().split(".");
                parts[0]=parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
                return parts.join(",");
                }

             function writeStringToPrice(str){
                str = (str+'').replace(/\./g, "");
                var first_group = str.substr(0,str.length % 3);
                var remain_group = str.replace(first_group,"");
                var num_group = remain_group.length/3;
                var result = "";
                for(var i=0;i < num_group;i++){
                    group_of_three = remain_group.substr(i*3,3);
                    result += group_of_three;
                    if(i != (num_group-1)) result += ".";
                }
                if(first_group.length > 0) {
                    if(result != "") return first_group + "." + result ;
                    else return first_group;
                }else{
                    if(result != "") return result;
                    else return "";
                }

                
            }

            amount = parseInt($('#amount').val().replace(/\./g, ''));

            $('#before_money').change(function(){

               
            
                price = parseInt(($('#before_money').val()).replace(/\./g, ''));

               
              

                if($('#before_money').val()==''|| isNaN($('#before_money').val().replace(/\./g, ''))){
                   price = 0;
                }
              

                prices = amount - price;



               
                $('#amount').val(numberWithCommas(prices));

                if(prices<3000000){

                    $('#prePriceInput').val(prices);

                    alert('Số tiền trả trước không đúng quy định xin kiểm tra lại')

                }

                
            })

            $("form").submit(function(e){

                if( parseInt(($('#prePriceInput').val()))>0){
                     alert('Số tiền trả trước không đúng quy định xin kiểm tra lại');
                    e.preventDefault(e);
                }
                
                return;
               
               
            });

           

        </script>
        <style>
            div#alert {
            white-space: pre-line;
            color: #d00;
            margin-left: 10px;
            }
            .form-control2 select {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            }
            .tbl-common td{padding:5px 5px 5px 0; font-size:13px;}
            .price{font-weight:bold; color:#e00; font-size:16px;}
        </style>
        <!-- Load time: 0.139 seconds  / 8 mb-->
        <!-- Powered by HuraStore 7.4.4, Released: 12-Aug-2018 / Website: www.hurasoft.vn -->
    </body>
</html>