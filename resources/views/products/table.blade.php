<style type="text/css">
    
    .group_gift{
        cursor: pointer;
    }

    .table td, .table th{
        padding: 0 3.5px!important;
    }
</style>

<div class="table-responsive">
    <table class="table" id="products-table">
        <thead>
        <tr>
            <th>Image</th>
        <th>Tên sản phẩm</th>
        <th>Sửa nhanh</th>
        
        <th>Số lượng trong kho</th>
        <th>Hiển thị</th>
        <th>chọn danh mục nhanh</th>

      
        <th>Tick sản phẩm</th>
       <!--  <th>Sản phẩm Sale</th>
        <th>Sản phẩm Mới</th> -->
        <th>Quà tặng</th>
        <th>Ngày tạo</th>
        @if(Auth::user()->id==4 || Auth::user()->id==6)
        <th>Chênh lệch giá</th>
        @endif
        <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php

            //cắt chuỗi khi dài quá
            function substrwords($text, $maxchar, $end='...') {
                if (strlen($text) > $maxchar || $text == '') {
                    $words = preg_split('/\s/', $text);      
                    $output = '';
                    $i      = 0;
                    while (1) {
                        $length = strlen($output)+strlen($words[$i]);
                        if ($length > $maxchar) {
                            break;
                        } 
                        else {
                            $output .= " " . $words[$i];
                            ++$i;
                        }
                    }
                    $output .= $end;
                } 
                else {
                    $output = $text;
                }
                return $output;
            }


            function get_Group_Product($id){
                $data_groupProduct = App\Models\groupProduct::where('level', 0)->get()->pluck('id');

                $infoProductOfGroup = App\Models\groupProduct::select('product_id', 'id')->whereIn('id', $data_groupProduct)->get()->toArray();

                $result = [];


                if(isset($infoProductOfGroup)){
                    foreach($infoProductOfGroup as $key => $val){
                        if(!empty($val['product_id'])&& in_array($id, json_decode($val['product_id']))){

                            array_push($result, $val['id']);
                        }
                    }
                }
                return $result;
            } 
        ?>    

        <?php  

            $list_hot = App\Models\hotProduct::select('product_id')->get();
            $list_sale = App\Models\saleProduct::select('product_id')->get();

            $list_new  =  App\Models\newProduct::select('product_id')->get();
            $list_hots   =  App\Models\hotsProduct::select('product_id')->get();


            function convertListToArray($list)
            {   
                $ar_list = [];

                if(count($list)){
                    foreach($list as $value){
                        array_push($ar_list, $value['product_id']);
                    }    
                }
                
                return $ar_list;
            }

            $list_hot = convertListToArray($list_hot);
            $list_sales = convertListToArray($list_sale);
            $list_new  = convertListToArray($list_new);
            $list_hots = convertListToArray($list_hots);
        ?>

        <?php  
            $now = Carbon\Carbon::now(); 
        ?>

        @foreach($products as $product)

            <tr>
                <td><img src="{{ asset($product->Image) }}" width="150px" height="150px"></td>
            <td style="width: 400px;">
                <a href="{{ route('products.edit', [$product->id]) }}">{{ $product->Name }}</a>
                <br>
                thời gian update :{{ $product->updated_at->format('d/m/Y, H:i:s') }}

                <br>
                người update : {{ App\User::find($product->user_id)->name }} 
                <br>

                <?php 
                    $check = App\Models\historyPd::where('product_id', $product->id)->get();
                ?>

                @if($check->count()>0)
                <a href="{{ route('view-history', $product->id) }}">xem lịch sử</a>
                @endif
            </td>
            <td width="100">
                
                <label>Giá</label>

                <div>
                    <input type="" name="flashPrice" value="{{ @str_replace(',' ,'.', number_format($product->Price))}} " id="flashPrice{{$product->id}}">
                </div>

                <br>

                <div class="btn-primary" onclick="flashPrice('{{ $product->id}}')" id="prices_edit{{ $product->id }}">Sửa</div>

                <br>

            </td>
                  
            
            <td style="width: 124px;">
                <label>Sửa</label>
                <input type="" name="qualtily" value="{{ $product->Quantily }}" id="qualtity{{ $product->id }}" style="width: 100%;">

                <br>

                <br>

                <div class="btn-primary" onclick="flashQualtily('{{ $product->id}}')"  id="qualtity_edit{{ $product->id }}">Sửa</div>


                <br>

            </td>

            <td><input type="checkbox" id="active{{ $product->id }}" name="active" onclick='active({{ $product->id }})'   {{ $product->active==1?'checked':'' }}></td>

            <td><a href="{{ route('group-product-selected', $product->id) }}"class="btn-primary">Sửa</a></td>

          

            <td style="width:40%">
                <input type="checkbox" id="hot{{ $product->id }}" name="hot"  onclick='handleClick({{ $product->id }});' data-id ="{{ get_Group_Product($product->id)[0]??'' }}" {{ in_array($product->id, $list_hot)?'checked':'' }}>
                Sản phẩm Show Home

                <br>

                 <input type="checkbox" id="sale{{ $product->id }}" name="sale"  onclick='saleClick({{ $product->id }});' data-id ="{{ get_Group_Product($product->id)[0]??'' }}" {{ in_array($product->id, $list_sales)?'checked':'' }}>
                 Sản phẩm Sale
                <br> 

                <input type="checkbox" id="new{{ $product->id }}" name="new"  onclick='newClick({{ $product->id }});' data-id ="{{ get_Group_Product($product->id)[0]??'' }}" {{ in_array($product->id, $list_new)?'checked':'' }}>
                  Sản phẩm Mới
                  <br>
                <input type="checkbox" id="hots{{ $product->id }}" name="hots"  onclick='hotClick({{ $product->id }});' data-id ="{{ get_Group_Product($product->id)[0]??'' }}" {{ in_array($product->id, $list_hots)?'checked':'' }}>
                  Sản phẩm Hot
                <br>
                <input type="checkbox" id="limit{{ $product->id }}" name="limit"  onclick="limit({{ $product->id }})" {{  $product->limits ==1?'checked':'' }}>

                Sản phẩm số lượng có hạn
  
            </td>
            

            <?php  

                $promotion = App\Models\promotion::where('id_product', $product->id)->get()->last(); 

                $gift = '';

                if(!empty($promotion)){

                    // $convert_time = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $promotion->created_at);

                    // $convert_time = $convert_time->addDays($product->time);

                    // $result_time = $convert_time->diffInHours($now);

                    // if(!empty($promotion)&& $result_time>=0 &&$promotion->id_gift!=0){
                    //     $gift = App\Models\gift::find($promotion->id_gift);

                    // }
                    
                } 

                $group_gift = DB::table('group_gift')->select('id', 'group_name')->get();

                $promotion = DB::table('promotion')->where('id_product', $product->id)->get()->last();

                
                $id_group_gift = $promotion->id_group_gift??'';

            ?>


            <td>
                <select id="gift" onchange="add_gift_group({{ $product->id }})">
                    <option value="0">Không chọn</option>


                    @if(isset($group_gift))
                    
                    @foreach($group_gift as $value)
                    
                    <option value="{{ $value->id }}" {{ $id_group_gift == $value->id?'selected':'' }} >{{ $value->group_name }}</option>
                    @endforeach
                    @endif

                       
                </select>
            </td>
            <td>{{ $product->created_at->format('d/m/Y, H:i:s') }}</td>
            @if(Auth::user()->id==4 || Auth::user()->id==6)
            <td>{{  str_replace(',' ,'.', number_format(intval($product->Price) - intval($product->InputPrice)))   }}</td>
            @endif

            
                <td width="120">
                    {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                    <div class='btn-group' style="display:block;">
                        <a href="{{ route('details', [$product->Link]) }}"
                           class='btn btn-default btn-xs' target="_blank">
                            <i class="far fa-eye"></i>
                        </a>
                        
                        <a href="{{ route('products.edit', [$product->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        

                         <a href="{{ route('images.create', [$product->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="fas fa-image"></i>
                        </a>

                        

                         <a href="{{ route('filter-property') }}?group-product={{ get_Group_Product($product->id)[0]??'' }}&productId={{ $product->id }}"
                           class='btn btn-default btn-xs'>
                            <i class="fa fa-filter"></i>
                        </a>
                        

                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<input type="hidden" name="product-click" id="product-click">
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
                    <input type="text" id="time" name="time" required>

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

                $list = DB::table('group_gift')->get();

                $gifts_list = DB::table('gifts')->select('name')->get()->toArray();
            ?>

            <table>
                <tbody>
                    <tr>
                        <th>Nhóm khuyến mãi</th>
                        <th>Quà 1</th>
                        <th>Quà 2</th>
                        <th>kiểu chọn</th>
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
                    </tr>
                    @endforeach   
                    @endif
                                   
                </tbody>
            </table>


        </div>
    </div>
</div>



<script type="text/javascript">

    function openModal(name, id) {
        $('#product-click').val(id);
        let title ='Quà tặng khi mua '+name;

        $('#gift-product').text(title);
        $('#modal-gift').modal('show');

       

    }



    function add_gift_group(product_id) {

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
                id_group_gift:$('#gift').val(),
                   
            },
            success: function(result){

                alert(result);
                
            }
        });
        
    }

    function selectGift() {

        type = $('#type').val();
        name_promotion    = $('#name_group_promotion').val();

        gift2    = $('#gift2').val();

        gift1    = $('#gift1').val();

        time       = $('#time').val();
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
                time:time,
                type:type,
                name_promotion:name_promotion,

                   
            },
            success: function(result){

                $('#modal-gift').modal('hide');
                alert(result);
                
            }
        });

    }



  
    function handleClick(id) {

        var checked = $('#hot'+id).is(':checked'); 

        const group_id = $('#hot'+id).attr('data-id');

        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if(checked == true)
        $.ajax({
           
            type: 'POST',
            url: "{{ route('add-hot-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });
        else
        $.ajax({
           
            type: 'POST',
            url: "{{ route('remove-hot-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });

    }

    function flashQualtily(productId) {

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

           
        $.ajax({
           
            type: 'POST',
            url: "{{ route('edit-fast-qualtity') }}",
            data: {
                product_id: productId,
                qualtity:$('#qualtity'+productId).val()
                   
            },
            success: function(result){

                $('#qualtity_edit'+productId).text('thành công');
                 
                setTimeout(location.reload(), 3000);
            }
        });
       
    }

    function saleClick(id) {

         var checked = $('#sale'+id).is(':checked'); 

        const group_id = $('#sale'+id).attr('data-id');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if(checked == true)
        $.ajax({
           
            type: 'POST',
            url: "{{ route('add-sale-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });
        else
        $.ajax({
           
            type: 'POST',
            url: "{{ route('remove-sale-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });

    } 

    function newClick(id) {

         var checked = $('#new'+id).is(':checked'); 

        const group_id = $('#new'+id).attr('data-id');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if(checked == true)
        $.ajax({
           
            type: 'POST',
            url: "{{ route('add-new-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });
        else
        $.ajax({
           
            type: 'POST',
            url: "{{ route('remove-new-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });

    }

    function hotClick(id) {

         var checked = $('#hots'+id).is(':checked'); 

        const group_id = $('#hots'+id).attr('data-id');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if(checked == true)
        $.ajax({
           
            type: 'POST',
            url: "{{ route('add-hots-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });
        else
        $.ajax({
           
            type: 'POST',
            url: "{{ route('remove-hots-product') }}",
            data: {
                product_id: id,
                group_id: group_id,
                   
            },
            success: function(result){
                console.log(result);
            }
        });

    }


    function active(productId) {
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
            url: "{{ route('check-active') }}",
            data: {
                product_id: productId,
                active:active
                   
            },
            success: function(result){
                console.log(result);
            }
        });
       
    }   


    function flashPrice(productId) {
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
           
        $.ajax({
           
            type: 'POST',
            url: "{{ route('fast-price') }}",
            data: {
                product_id: productId,
                price:$('#flashPrice'+productId).val()
                   
            },
            success: function(result){
                $('#prices_edit'+productId).text('thành công');
                setTimeout(location.reload(), 3000);
              
            }
        });
    } 

    function limit(productId) {

        var checked = $('#limit'+productId).is(':checked'); 

        if(checked == true)
             
        $.ajax({
            type: 'POST',
            url: "{{ route('add-limit-product') }}",
            data: {
                product_id: productId,
                   
            },
            success: function(result){
                alert('thành công');
              
            }
           
        });
        else
        $.ajax({
           
            type: 'POST',
            url: "{{ route('remove-limit-product') }}",
            data: {
                product_id: productId,
                   
            },
            success: function(result){
                alert(' xóa thành cong')
              
            }
           
        });

    }

</script>
