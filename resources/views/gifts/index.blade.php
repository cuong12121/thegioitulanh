@extends('layouts.app')

@section('content')
<style type="text/css">
    
    #modal-g .modal-content{
        width: 860px;
    }
    .group_gift{
        cursor: pointer;
    }
</style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gifts</h1>

                    <div><div class="btn btn-primary" onclick="openModal()">tạo nhóm khuyến mãi</div></div>

                    
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('gifts.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php    
    $list = DB::table('group_gift')->get(); 
    $groupProduct_gift = DB::table('gift_group')->get();
?>
    
    @if(isset($list))
  
        <select id="group_gift_selelected">
            <option value="0">Không chọn</option>
            @foreach($list as $value)
            <option value="{{ $value->id }}">{{ $value->group_name }}</option>
            @endforeach
        </select>
       
    
    <br>
   
    <div><div class="btn btn-primary" onclick="openModalProduct()">Thêm danh sách </div></div>
    <br>

   
 

    <div class="btn-primary group_gift" style="width: 10%;">khuyến mãi cho nhóm</div>


     @endif

    <br> 
    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('gifts.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $gifts])
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if (session('error'))
    <div class="alert alert-danger" role="alert">
            {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif


<!-- The Modal -->
<div class="modal" id="Modal_group_gift">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Chọn quà tặng cho nhóm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <table id="tb-list" border="1" bordercolor="#CCCCCC">
                    <tbody>
                        <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                            <td style="width:30px">STT</td>
                            <td>nhóm sản phẩm </td>
                            <td style="width:80px">nhóm quà tặng</td>
                            
                        </tr>
                        @if(!empty($list))
                        <?php 
                            $k =0;
                        ?>
                        @foreach($groupProduct_gift as $lists)
                        <?php  $k++;?>
                        <tr id="row_4175" class="row-hover">
                            <td>{{ $k }}</td>
                            <td>
                               {{ $lists->name}}
                            </td>
                            <td>
                                <select class="group_gift_select" data-id="{{ $lists->id }}">
                                    <option value="0">Không chọn</option>
                                    @foreach($list as $value)
                                    <option value="{{ $value->id }}" {{ $lists->group_gift==$value->id?'selected':'' }}>{{ $value->group_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                                
                            
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    <!-- Modal -->
<div class="modal fade" id="modal-gift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gift-product">Quà tặng khi mua </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php  
                    $gift = App\Models\gift::get();

                ?>
                @isset($gift)
                <form>
                    <label for="username">Tên nhóm khuyến mãi:</label><br>
                    <input type="text" name="name_group_promotion" id="name_group_promotion" required><br>
                    <label for="type">Kiểu chọn:</label><br>

                    <input id= "type" name="type" type="checkbox" value="1" /> 1 trong 2<br>


                    
                    <label for="username">Chọn quà tặng kèm:</label><br>
                    <select id="gift1">
                        <option value="0">Không chọn</option>
                        @foreach($gift as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                       
                    </select>

                    <select id="gift2">
                        <option value="0">Không chọn</option>
                        @foreach($gift as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                       
                    </select>

                    <br>
                    <label for="pwd">Nhập số giờ khuyến mãi:</label><br>
                    Bắt đầu : <input type="text" id="date-picker1" value="" required> Giờ: 
                      <select name="time" id="hours1"><option value="00:00">00:00</option><option value="00:30">00:30</option><option value="01:00">01:00</option><option value="01:30">01:30</option><option value="02:00">02:00</option><option value="02:30">02:30</option><option value="03:00">03:00</option><option value="03:30">03:30</option><option value="04:00">04:00</option><option value="04:30">04:30</option><option value="05:00">05:00</option><option value="05:30">05:30</option><option value="06:00">06:00</option><option value="06:30">06:30</option><option value="07:00">07:00</option><option value="07:30">07:30</option><option selected="" value="08:00">08:00</option><option value="08:30">08:30</option><option value="09:00">09:00</option><option value="09:30">09:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:30">23:30</option></select>
                      <br>
                      <br>
                      Kết thúc : <input type="text" size="10"  id="date-picker2" value="" required> Giờ: 
                      <select name="time" id="hours2"><option value="00:00">00:00</option><option value="00:30">00:30</option><option value="01:00">01:00</option><option value="01:30">01:30</option><option value="02:00">02:00</option><option value="02:30">02:30</option><option value="03:00">03:00</option><option value="03:30">03:30</option><option value="04:00">04:00</option><option value="04:30">04:30</option><option value="05:00">05:00</option><option value="05:30">05:30</option><option value="06:00">06:00</option><option value="06:30">06:30</option><option value="07:00">07:00</option><option value="07:30">07:30</option><option value="08:00">08:00</option><option value="08:30">08:30</option><option selected="" value="09:00">09:00</option><option value="09:30">09:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:30">23:30</option></select>

                </form>
                @endisset


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="selectGift()">Xác nhận</button>
            </div>

            <hr>

            <h2>Danh sách nhóm quà tặng</h2>

            <?php 

                

                $gifts_list = DB::table('gifts')->select('name')->get()->toArray();
            ?>

            <table>
                <tbody>
                    <tr>
                        <th>Nhóm khuyến mãi</th>
                        <th>Quà 1</th>
                        <th>Quà 2</th>
                        <th>kiểu chọn</th>
                        <th>ngày bắt đầu</th>
                        <th>ngày kết thúc</th>
                        <th>Xóa</th>
                    </tr>
                    @isset($list)
                    @foreach($list as $lists)
                    <tr>
                        <td>{{ $lists->group_name  }}</td>
                        <?php  $gift1 = DB::table('gifts')->select('name')->where('id', $lists->gift1)->first();  $gift2 = DB::table('gifts')->select('name')->where('id', $lists->gift2)->first();   ?>
                        
                        <td>{{  @$gift1->name }} </td>
                        <td>
                           {{ @$gift2->name }}
                        </td>
                        <td>{{ $lists->type==1?'chọn 1 trong 2 sản phẩm':'chọn toàn bộ sản phẩm' }}</td>
                        
                        <td>{{ $lists->start }}</td>
                        <td>{{ $lists->end }}</td>
                        <td><a href="{{ route('destroyGiftGroup', $lists->id) }}">xóa</a></td>
                    </tr>
                    @endforeach   
                    @endif
                                   
                </tbody>
            </table>


        </div>
    </div>
</div>

<div class="modal fade" id="modal-g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chọn sản phẩm</h5>

                <?php  
                    $option = App\Models\groupProduct::select('id', 'name')->where('level', 0)->get();
                ?>

                <select name="group_product_id" id="group_product_id">
                    <option value="0">Không chọn</option>
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

            
            

                <?php  


                ?>
                <table id="tb-list" border="1" bordercolor="#CCCCCC">
                    <tbody>
                        <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                            <td style="width:30px">STT</td>
                            <td>Sản phẩm </td>
                            <td style="width:150px">Giá bán</td>
                            
                            <td style="width:70px">Số lượng</td>
                            <td style="width:80px">Bảo hành</td>
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

                            
                            <td>
                                1
                            </td>
                            <td>
                                24 Tháng
                            </td>
                            <td>
                                <input type="button" value="Chọn sản phẩm" class="update-bt-all" ><span id="update_bt_5814" ></span>
                            </td>
                        </tr>

                        @endforeach
                        @endif
                        
                       
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-view">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="modal-productss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chọn sản phẩm</h5>

              
            </div>
            <div class="modal-body">

                <?php  
                    $promotion 

                ?>
                <table id="tb-list" border="1" bordercolor="#CCCCCC">
                    <tbody>
                        <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                            <td style="width:30px">STT</td>
                            <td>Sản phẩm </td>
                            <td style="width:150px">Tên</td>
                            <td style="width:150px">Xóa</td>
                            
                        </tr>

                       

                        <tr id="" class="row-hover">
                            <td></td>
                            <td>
                               fghgfh
                            </td>
                            <td><a href="">xóa</a></td>
                           
                        </tr>

                        
                        
                       
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-view">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
 -->
<input type="hidden" name="" id="km">

<script type="text/javascript">

    $('.group_gift_select').bind('change',function(){
        group_product = $(this).attr('data-id');
        group_gift = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{ route('giftGroupAdd') }}",
            data: {
                    
                group_product : group_product,
                group_gift : group_gift
            },
            success: function(result){

                
                alert(result);

                
            }
        });

    })
    

    $("#date-picker1").datepicker({ dateFormat: 'dd-mm-yy'});
    $("#date-picker2").datepicker({ dateFormat: 'dd-mm-yy'});
    function openModal() {
       
       
        $('#modal-gift').modal('show');

    }

    function openModalProduct(argument) {
         $('#modal-g').modal('show');
    }

    function selectGift() {

        type = $('#type').val();
        name_promotion    = $('#name_group_promotion').val();

        

        gift2    = $('#gift2').val();

        gift1    = $('#gift1').val();

        start    = $('#date-picker1').val()+','+$('#hours1').val(),

        end       = $('#date-picker2').val()+','+$('#hours2').val(),
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       
        $.ajax({
           
            type: 'POST',
            url: "{{ route('add-group-gift') }}",
            data: {
                
                gift1: gift1,
                gift2: gift2,
                start:start,
                end:end,
                name_promotion:name_promotion,

                   
            },
            success: function(result){

                $('#modal-gift').modal('hide');
                alert(result);
                window.location.href;
                
            }
        });

    }

    $('.accept-find').click(function(){

        data = $('#name_product').val();

        $('#modal-product .modal-body').show();

        if(data != null){

            $.ajax({

            type: 'GET',
                url: "{{ route('filter-product-deal') }}",
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

    });

    km =0;

     $("#group_gift_selelected").bind("change", function() {
        km = $('#group_gift_selelected').val();
        $('#km').val(km);
    });   

     $('#km').val(km);
    function selectProduct(product_id) {
        
        km = $('#km').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       
        $.ajax({
           
            type: 'POST',
            url: "{{ route('add-gift') }}",
            data: {
                
                product_id:product_id,
                id_group_gift:km,
                   
            },
            success: function(result){
                $('#selectProduct'+product_id).val('Đã chọn');
                alert(result);
                
            }
        });
        
     } 

     function openModalProducts_view() {
         $('#modal-productss').modal('show');
     }


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

     $('.group_gift').click(function(){
        $('#Modal_group_gift').modal('show');
        
    });

</script>




@endsection

