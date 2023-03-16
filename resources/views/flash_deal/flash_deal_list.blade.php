@extends('layouts.app')

@section('content')



<style type="text/css">
        
    body{margin-top:20px;}


    /* USER LIST TABLE */
    .user-list tbody td > img {
        position: relative;
        max-width: 50px;
        float: left;
        margin-right: 15px;
    }
    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
        margin-left: 60px;
    }
    .user-list tbody td .user-subhead {
        font-size: 0.875em;
        font-style: italic;
    }

    /* TABLES */
    .table {
        border-collapse: separate;
    }
    .table-hover > tbody > tr:hover > td,
    .table-hover > tbody > tr:hover > th {
        background-color: #eee;
    }
    .table thead > tr > th {
        border-bottom: 1px solid #C2C2C2;
        padding-bottom: 0;
    }
    .table tbody > tr > td {
        font-size: 0.875em;
        background: #f5f5f5;
        /*border-top: 10px solid #fff;*/
        vertical-align: middle;
        padding: 12px 8px;
        border: 1px solid #ddd;
    }
    .table tbody > tr > td:first-child,
    .table thead > tr > th:first-child {
        padding-left: 20px;
    }
    .table thead > tr > th span {
        border-bottom: 2px solid #C2C2C2;
        display: inline-block;
        padding: 0 5px;
        padding-bottom: 5px;
        font-weight: normal;
    }
    .table thead > tr > th > a span {
        color: #344644;
    }
    .table thead > tr > th > a span:after {
        content: "\f0dc";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        margin-left: 5px;
        font-size: 0.75em;
    }
    .table thead > tr > th > a.asc span:after {
        content: "\f0dd";
    }
    .table thead > tr > th > a.desc span:after {
        content: "\f0de";
    }
    .table thead > tr > th > a:hover span {
        text-decoration: none;
        color: #2bb6a3;
        border-color: #2bb6a3;
    }
    .table.table-hover tbody > tr > td {
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
    }
    .table tbody tr td .call-type {
        display: block;
        font-size: 0.75em;
        text-align: center;
    }
    .table tbody tr td .first-line {
        line-height: 1.5;
        font-weight: 400;
        font-size: 1.125em;
    }
    .table tbody tr td .first-line span {
        font-size: 0.875em;
        color: #969696;
        font-weight: 300;
    }
    .table tbody tr td .second-line {
        font-size: 0.875em;
        line-height: 1.2;
    }
    .table a.table-link {
        margin: 0 5px;
        font-size: 1.125em;
    }
    .table a.table-link:hover {
        text-decoration: none;
        color: #2aa493;
    }
    .table a.table-link.danger {
        color: #fe635f;
    }
    .table a.table-link.danger:hover {
        color: #dd504c;
    }

    .table-products tbody > tr > td {
        background: none;
        border: none;
        border-bottom: 1px solid #ebebeb;
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
        position: relative;
    }
    .table-products tbody > tr:hover > td {
        text-decoration: none;
        background-color: #f6f6f6;
    }
    .table-products .name {
        display: block;
        font-weight: 600;
        padding-bottom: 7px;
    }
    .table-products .price {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }
    .table-products .price > i {
        color: #8dc859;
    }
    .table-products .warranty {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }
    .table-products .warranty > i {
        color: #f1c40f;
    }
    .table tbody > tr.table-line-fb > td {
        background-color: #9daccb;
        color: #262525;
    }
    .table tbody > tr.table-line-twitter > td {
        background-color: #9fccff;
        color: #262525;
    }
    .table tbody > tr.table-line-plus > td {
        background-color: #eea59c;
        color: #262525;
    }
    .table-stats .status-social-icon {
        font-size: 1.9em;
        vertical-align: bottom;
    }
    .table-stats .table-line-fb .status-social-icon {
        color: #556484;
    }
    .table-stats .table-line-twitter .status-social-icon {
        color: #5885b8;
    }
    .table-stats .table-line-plus .status-social-icon {
        color: #a75d54;
    }

    .modal-dialog{
        max-width: 800px !important;
    }
</style>

<script>

    $(document).ready(function() {
         $("#date-picker1" ).datepicker({ dateFormat: 'dd-mm-yy'});
         $("#date-picker2" ).datepicker({ dateFormat: 'dd-mm-yy'});
         $("#date-picker3" ).datepicker({ dateFormat: 'dd-mm-yy'});
         $("#date-picker4" ).datepicker({ dateFormat: 'dd-mm-yy'});
    }); 
 
  </script>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">

                <br>
                <div class="table-responsive">

                    <div>
                        
                        <div class="btn btn-primary add-product">Thêm sản phẩm</div>

                       <!--  <div class="btn btn-default accepts">Xác nhận</div> -->
                    </div>

                    <br>

                    <table class="tb-padding" cellpadding="5" border="1" bordercolor="#CCCCCC">
                        <tbody>
                            <?php 

                                $deal_id =  $_GET['id'];

                                $deal = App\Models\flashdeal::where('flash_deal_id', $deal_id)->orderBy('id', 'desc')->get();



                                $priceDeal = DB::table('flash_deal')->where('id', $deal_id)->get()->last();

                            ?>

                           <?php 

                                if(!empty($deal) && count($deal)>0){

                           ?> 
                            
                          <!-- <tr>
                              <td>Cài đặt thời gian</td>
                              <td>

                               <?php 
                                
                                function get_times ($default = '19:00', $interval = '+30 minutes') {

                                    $output = '';

                                    $current = strtotime('00:00');
                                    $end = strtotime('23:59');

                                    while ($current <= $end) {
                                        $time = date('H:i', $current);
                                        $sel = ($time == $default) ? ' selected' : '';

                                        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) .'</option>';
                                        $current = strtotime($interval, $current);
                                    }

                                    return $output;
                                }

                                ?>

                                  Bắt đầu : <input type="text" id="date-picker1" value="{{  str_replace(strstr($deal[0]->start, ','), '', $deal[0]->start) }}">

                                  <?php  

                                    $start = str_replace(',','',strstr($deal[0]->start, ','));

                                    $end    = str_replace(',','',strstr($deal[0]->end, ','));
                                  ?>

                                   Giờ: 
                                  <select name="time" id="hours1"><?php echo get_times($default = $start, '+30 minutes'); ?></select>
                                  <br>
                                  <br>
                                  Kết thúc : <input type="text"  id="date-picker2" value="{{ str_replace(strstr($deal[0]->end, ','), '', $deal[0]->end) }}"> Giờ: 
                                  <select name="time" id="hours2">
                                      <?php echo get_times($default = $end, '+30 minutes'); ?>
                                  </select>
                              </td>
                          </tr> -->

                            <?php  

                                }

                            ?>


                      </tbody>
                    </table>

                    <br>
                    
                    <table id="tb_padding" border="1" bordercolor="#CCCCCC" style="width:100%">
                        <tbody>
                            <tr style="background-color:#EEE; font-weight:bold;">
                                <td width="30px">STT</td>
                                <td width="120px">Ảnh Sản phẩm</td>
                                <td>Thông tin</td>
                                <td>Giá</td>
                                <td>Tình trạng</td>
                                <td>Quản lý</td>
                                <td>Sắp xếp</td>
                                <td>Flash Deal (theo khung giờ)</td>
                                <td>Flash Deal (giờ nháp)</td>
                                
                            </tr>

                            <?php  
                                $now = Carbon\Carbon::now();
                                $products = DB::table('deal_flash_product')->where('flash_deal_id', $deal_id)->OrderBy('id', 'desc')->distinct()->get()->toArray();

                                $k =0;
                            ?>

                            
                            @if(!empty($products))
                            @foreach($products as $val)
                            <?php  
                                $k++ ;
                                $flashDealTimeId =  $val->flash_deal_time_id;

                                $flashDealTimeIdDemo = $val->flash_deal_time_id_demo??'';

                               
                            ?>
                            <tr id="row_1208">
                                <td>{{ $k }}</td>

                                <?php 
                                    $product_info = App\Models\product::find($val->product_id);
                                ?>
                                <td align="center">
                                    <img src="{{ asset($product_info->Image) }}" width="100" alt="{{ $val->name }}">
                                    <!--<div><a style="color:green" href="javascript:;" onclick="delete_special(1208)">Xóa bỏ</a></div>-->
                                </td>
                                <td>
                                    <div><a href="{{ route('details', $val->link) }}" target="_blank"><b>{{ $val->name }}</b></a></div>
                                    <div>Giá deal : <b style="color:red;">{{  str_replace(',' ,'.', number_format($val->deal_price))   }}</b> vnd - Giá thường: <b style="color:red;">{{  str_replace(',' ,'.', number_format($product_info->Price))   }}</b> </div>
                                    <div>Số lượng : <b style="color:red;">0</b> - Số tối thiểu cho 1 đơn hàng: <b style="color:red;">0</b></div>
                                    <div>Thời gian : Từ <b style="color:red;">{{ @$val->start }}</b> đến <b style="color:red;">{{ $val->end }}</b> 
                                        ({{ $now->between($val->start, $val->end)?'Đang bắt đầu':'chưa bắt đầu'}})
                                    </div>
                                   
                                </td>

                                <td>
                                   <!--  Giá Deal -->
                                    <div>
                                        <input type="text" name="order" value="{{ $val->deal_price }}" class="edit_price_deal{{ $val->id }}">
                                    </div>
                                    
                                    <br>
                                    <div class="btn-primary edit_price_deal{{$val->id}}" style="width: 25%;" onclick="edit_price_deal({{ $val->id }})" >sửa</div>
                                </td>

                                

                                <td>
                                    <div>Số đơn hàng : <b style="color:red;">0</b></div>
                                    <div>Số Sản phẩm đặt mua: <b style="color:red;">0</b></div>
                                    <div>Lượt xem: <b style="color:red;">0</b></div>
                                </td>
                                <td>
                                    <div><a href="javascript:void(0)" onclick="update_product({{ $val->id }})">Sửa lại</a></div>
                                    <div id="is_feature_1208">
                                        <span><a href="javascript:set_feature('{{  $val->id }}','{{ $val->active }}')">{!! $val->active==0?'<b style="color:green;">Hiển thị</b>':'<b style="color:red">Hạ xuống</b>' !!}</a></span>
                                    </div>
                                    <div><a href="javascript:;" onclick="delete_deal('{{ $val->id }}')">xóa</a></div>
                                </td>
                                
                                <td>
                                    <div>
                                        <input type="text" name="order" value="{{ $val->order }}" class="edit_order{{ $val->id }}">
                                    </div>
                                    
                                    <br>
                                    <div class="btn-primary edit_orders{{$val->id}}" style="width: 25%;" onclick="update_order({{ $val->id }})" >sửa</div>
                                </td>
                                <td>
                                    <select  id="flash-deal{{ $val->id }}" class="form-select"  onchange="changeFlashDeal({{ $val->id }})">
                                        <option value="0">Không chọn</option>
                                        <option value="1" {{ $flashDealTimeId==1?'selected':'' }}>9h</option>
                                        <option value="2" {{ $flashDealTimeId==2?'selected':'' }}>12h</option>
                                        <option value="3" {{ $flashDealTimeId==3?'selected':'' }}>14h</option>
                                        <option value="4" {{ $flashDealTimeId==4?'selected':'' }}>17h</option>
                                    </select>
                                </td>

                                <td>
                                    <select  id="flash-deal-demo{{ $val->id }}" class="form-select"  onchange="demoTime({{ $val->id }})">
                                        <option value="0">Không chọn</option>
                                        <option value="1" {{ $flashDealTimeIdDemo==1?'selected':'' }}>9h</option>
                                        <option value="2" {{ $flashDealTimeIdDemo==2?'selected':'' }}>12h</option>
                                        <option value="3" {{ $flashDealTimeIdDemo==3?'selected':'' }}>14h</option>
                                        <option value="4" {{ $flashDealTimeIdDemo==4?'selected':'' }}>17h</option>
                                    </select>
                                </td>

                                
                            </tr>
                            @endforeach

                            @endif
                           
                        </tbody>
                    </table>
                    <br>
                    
                </div>
                
            </div>

        </div>


        <div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chọn sản phẩm</h5>

                        <?php  
                       
                            $option = App\Models\groupProduct::select('id', 'name')->where('parent_id', 0)->get();
                        ?>

                        <select name="group_product_id" id="group_product_id">
                            @foreach($option as $val)
                            <option value="{{$val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                         <h5 class="modal-title" id="exampleModalLabel">tìm kiếm theo tên hoặc model</h5>

                         <input type="text" name="" id="name_product">
                         &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                         <div class="btn-primary accept-find">xác nhận</div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php  


                        ?>
                        <table id="tb-list" border="1" bordercolor="#CCCCCC">
                            <tbody>
                                <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                                    <td style="width:30px">STT</td>
                                    <td>Sản phẩm </td>
                                    <td style="width:150px">Giá bán</td>
                                    <td style="width:150px">Giá Deal</td>
                                    <td style="width:70px">Số lượng</td>
                                   
                                    <td style="width:80px">Chọn</td>
                                </tr>

                                <?php  
                                    $products = App\Models\product::select('Name', 'Link', 'Price','id', 'Link')->where('group_id', 1)->where('active', 1)->Orderby('id', 'desc')->paginate(10);

                                ?>
                               <?php  

                                    $i = 0
                                ?>
                                @if(isset($products))

                                @foreach($products as $val)

                                <?php 

                                    $i++;
                                ?>

                                <tr id="row_{{$val->id}}" class="row-hover">
                                    <td>{{ $i }}</td>
                                    <td>
                                        <b><a href="{{ route('details', $val->Link) }}" class="pop-up">{{ $val->Name }}</a></b> <br>
                                       
                                        <input type="hidden" id="pro_name_{{ $val->id }}" value="{{ $val->id }}">
                                    </td>
                                    <td class="price">
                                        {{ number_format($val->Price , 0, ',', '.')}}  
                                    </td>

                                    <td class="deal-price">
                                        
                                    </td>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        24 Tháng
                                    </td>
                                    <td>
                                        <input type="button" value="Chọn sản phẩm" class="update-bt-all" onclick="selectProduct('{{$val->id}}')"><span id="update_bt_5814"></span>
                                    </td>
                                </tr>

                                @endforeach
                                @endif
                                
                               
                            </tbody>
                        </table>
                    </div>
                   <!--  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add-view">Xác nhận</button>
                    </div> -->
                </div>
            </div>
        </div>


        <div class="modal fade" id="select-price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Giá deal cho sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="price-deal" id="price-deal" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add-deal-price">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>


        @if(!empty($deal)&& !empty($deal[0]))

        
        <div class="modal fade" id="modalSetTimeDeal" tabindex="-1" role="dialog" aria-labelledby="modalSetTimeDeal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cài đặt thời gian cho sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         Bắt đầu : <input type="text" id="date-picker3" value="{{  str_replace(strstr($deal[0]->start, ','), '', $deal[0]->start) }}">

                        <?php  

                            $start = str_replace(',','',strstr($deal[0]->start, ','));

                            $end    = str_replace(',','',strstr($deal[0]->end, ','));
                        ?>

                           Giờ: 
                          <select name="time" id="hours3"><?php echo get_times($default = $start, '+30 minutes'); ?></select>
                          <br>
                          <br>
                          Kết thúc : <input type="text"  id="date-picker4" value="{{ str_replace(strstr($deal[0]->end, ','), '', $deal[0]->end) }}"> Giờ: 
                          <select name="time" id="hours4">
                              <?php echo get_times($default = $end, '+30 minutes'); ?>
                          </select>   

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary accepts-time-deal" onclick="">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

</div>
<input type="hidden" name="edit-deal" id="edit-deal">
<input type="hidden" name="time-deal" id="time-deal">

<input type="hidden" name="row" id="row_id">
<script type="text/javascript">


$('.add-product').click(function(){
    $('#modal-product').modal('show');

})

$('.update-bt-all').click(function(){


    $('#select-price').modal('show');

})

 function numberWithCommas(x) {

     x = x.toString().replace('.','');
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}



function selectProduct(id){

    price = '{{ $priceDeal->price }}';

    deal_product.push({price_deal:price, id:id});

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({

    type: 'GET',
        url: "{{ route('filter-deal-flash-add') }}",
        data: {
            data: JSON.stringify(deal_product),
            edit_id:'',
            id_time:{{ $deal_id??'' }},
            id_product:deal_product[0].id,
            
        },
        success: function(result){

            if(result=='1'){
                alert('sản phẩm đã tồn tại deal hàng ngày, vui lòng xem lại!');
            }
            else{
                window.location.reload();
            }
            
           

        }
    });

}

function setTimeDeal(id) {

    $.ajax({

        type: 'GET',
        url: "{{ route('getTimeDeal') }}",
        data: {
            product_id:id,
            
        },
        success: function(result){

            console.log(result);
            start = result[0];
            end   = result[1];
           
            ar_start = start.split(',');
            start_date = ar_start[0];
            start_time = ar_start[1];

            ar_end = end.split(',');
            end_date = ar_end[0];
            end_time = ar_end[1];

            $('#date-picker3').val(start_date);

            // $('#hours3 option:selected').remove();

            $("#hours3 option[value='"+start_time+"']").prop('selected', true);


            $('#date-picker4').val(end_date);


            $("#hours4 option[value='"+end_time+"']").prop('selected', true);

            $('#time-deal').val(id);

        }
    });

    $('#modalSetTimeDeal').modal('show');
}


function update_product(id){


    $('#modal-product').modal('show');

    $('.add-view').addClass('edit');

    $('#modal-product .modal-body').hide();

    $('#edit-deal').val(id);
}
function edit_price_deal(id){
    let val = $('.edit_price_deal'+id).val();

    $.ajax({

    type: 'GET',
        url: "{{ route('editFlashPricedeal') }}",
        data: {
            product_id:id,
            val: val
            
        },
        success: function(result){
           window.location.reload();
           
        }
    });

}


function update_order(id){

    let val = $('.edit_order'+id).val();
    console.log(val)
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({

    type: 'GET',
        url: "{{ route('order-flash-deal') }}",
        data: {
            product_id:id,
            val: val
            
        },
        success: function(result){
            $('.edit_orders'+id).text('thành công');
           
        }
    });

}


deal_product = [];


$('.add-deal-price').click(function(){

    id_row = $('#row_ids').val();

    const price = $('#price-deal').val(); 

    $('#row_'+id_row+' .deal-price').text(numberWithCommas(price));

    for (let i = 0; i < deal_product.length; i++) {

        if (deal_product[i].id == id_row) {

            deal_product.splice(deal_product[i], 1);

            deal_product.splice(deal_product[i], 1);
          
        }
    }

    deal_product.push({price_deal:price, id:id_row});

    $('#select-price').modal('hide');

});




 $("#group_product_id").bind("change", function() {

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({

        type: 'GET',
            url: "{{ route('filter-group-id') }}",
            data: {
                group_id: $( "#group_product_id" ).val(),
                action:$(this).val(),
                
            },
            success: function(result){


                $('#tb-list .row-hover').remove();
                $('#tb-list tbody').append(result);

               
            }
        });

    });

 $('.add-view').click(function(){

        // edit_id = $('#edit-deal').val();

        // id_row = $('#row_ids').val();
    
        // const price = '99000'; 

        // $('#row_'+id_row+' .deal-price').text(numberWithCommas(price));

        // for (let i = 0; i < deal_product.length; i++) {

        //     if (deal_product[i].id == id_row) {

        //         deal_product.splice(deal_product[i], 1);

        //         deal_product.splice(deal_product[i], 1);
              
        //     }
        // }

       
 })

function changeFlashDeal(id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

    type: 'POST',
        url: "{{ route('add-deal-flash') }}",
        data: {
            val: $('#flash-deal'+id).val(),
            id:id,
            
        },
        success: function(result){
           
            alert('Thành công');
            // window.location.reload();

        }
    });

}   


function demoTime(id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

    type: 'POST',
        url: "{{ route('add-deal-flash-demo') }}",
        data: {
            val: $('#flash-deal-demo'+id).val(),
            id:id,
            
        },
        success: function(result){
           
            alert('Thành công');
            // window.location.reload();

        }
    });

}  




function set_feature(id, active){

    $.ajax({

    type: 'GET',
        url: "{{ route('active-flash-deal') }}",
        data: {
            id: id,

            active: active,
        },
        success: function(result){

           window.location.reload();
        }
    });
}

$('.accepts-time-deal').click(function(){

    $.ajax({

    type: 'GET',
        url: "{{ route('updateTimeDeal') }}",
        data: {
            start: $('#date-picker3').val()+','+$('#hours3').val(),

            end:$('#date-picker4').val()+','+$('#hours4').val(),
            id:$('#time-deal').val()
           
            
        },
        success: function(result){

           window.location.reload();
        }
    });


})



$('.accepts').click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

    type: 'GET',
        url: "{{ route('result-add') }}",
        data: {
            start: $('#date-picker1').val()+','+$('#hours1').val(),

            end:$('#date-picker2').val()+','+$('#hours2').val(),
           
            
        },
        success: function(result){

           window.location.reload();
        }
    });

})




$('.accept-find').click(function(){

    data = $('#name_product').val();

    $('#modal-product .modal-body').show();

    if(data != null){

        $.ajax({

        type: 'GET',
            url: "{{ route('filter-product-deal-flash') }}",
            data: {
                data:data,
                page:'deal',
            },
            success: function(result){

                $('#tb-list .row-hover').remove();
                $('#tb-list tbody').append(result);

            }
        });

    }

})



function delete_deal(id){

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({

    type: 'GET',
        url: "{{ route('removeFlashDeal') }}",
        data: {
            id: id,
            
        },
        success: function(result){

            window.location.reload();
        }    
    });

}

    
</script>



@endsection