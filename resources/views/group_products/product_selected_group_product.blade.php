@extends('layouts.app')

@section('content')

<style type="text/css">
    
    .paren1 span{
        cursor: pointer;
    }
</style>



<?php 


    
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

            if(!empty($result[0]) && $result[0]==8){
                $data_groupProduct = App\Models\groupProduct::where('level', 2)->get()->pluck('id');

                if(isset($data_groupProduct)){

                    $result = [];

                    $infoProductOfGroup = App\Models\groupProduct::select('product_id', 'id')->whereIn('id', $data_groupProduct)->get()->toArray();

                    if(isset($infoProductOfGroup)){

                        foreach($infoProductOfGroup as $key => $val){


                            if(!empty($val['product_id'])&& in_array($id, json_decode($val['product_id']))){

                                array_push($result, $val['id']);
                            }
                           
                            
                        }

                    }
                }


            }

            return $result;

    }
    $name_product = App\Models\product::find($id);?>



<div class="btn btn-warning" ><a href="{{ route('products.edit', $id) }}">Cơ bản</a></div>
<div class="btn btn-warning activess" ><a href="{{ route('group-product-selected', $id) }}">Danh mục</a></div>
<div class="btn btn-warning btn-info seo-click"><a href="{{ route('products.edit', $id) }}?seo={{ $id }}">SEO</a></div>
<div class="btn btn-warning"><a href="{{ route('products.edit', $id) }}?mota={{ $id }}">Mô tả</a></div>
<div class="btn btn-warning" ><a href="{{ route('filter-property') }}?group-product={{ get_Group_Product($id)[0]??'' }}&productId={{ $id }}">Thông số</a></div>
<div class="btn btn-warning"><a href="{{ route('images.create') }}?{{ $id }}">Ảnh</a></div>
<div class="btn btn-warning" ><a href="{{ route('details',  $name_product->Link) }}" target="_blank">Xem tại web</a></div>
<h2>Sửa danh mục cho sản phẩm {{ $name_product->Name }}</h2>

<div class="table-responsive">
   <!--  <div>
        <button class="groupProduct">Xem toàn bộ danh mục liên quan</button>

    </div> -->

    <?php  

         $groupProductss = App\Models\groupProduct::select('id', 'name', 'level','product_id','active')->where('level', 0)->get();


        function recursiveMenu($id, $data, $parent_id=0, $sub=true, $level=0){

            $product_id =  $id;

            $data_active = [];


            if(isset($data)){

                foreach ($data as $value) {

                    if(!empty(json_decode($value->product_id))&&in_array($product_id, json_decode($value->product_id))){

                        array_push($data_active, $value->id);

                    }
                    
                }

            }


            if($level==0||$level==1||$level==2||$level==3){
                 $levelcheck = $parent_id;

            }
            else{
                 $levelcheck ='';
            }
            echo $sub ? '<ul>':'<ul class="sub-menu sub'.$levelcheck.'">';
            foreach ($data as $key => $item) {
                
                
                $all_prent = App\Models\groupProduct::where('parent_id', $item['id'])->get();
                if($item['group_product_id'] == $parent_id){
                    unset($data[$key]);
                ?>  

             @if($item['active']> 0)    
            <li class="paren1">

               
              <input type="checkbox" id="select{{ $item['id'] }}" name="sale" onclick="selected({{ $item['id'] }})" {{ in_array($item['id'], $data_active)?'checked':''}}>

              <a href="javascript:void(0)" class="click1" data-id="{{ $item['id'] }}"><?php echo $item['name']?></a>  

              @if($item['level']<count($all_prent))<span class="clicks{{ $item['id'] }}" onclick="showChild('sub{{ $item['id'] }}', 'clicks{{ $item['id'] }}', '{{ $id }}')">+</span>@endif
              
              <?php recursiveMenu($id, $data, $item['id'], false, $item['level'], $data_active); ?>
             </li>
             @endif
                <?php }} 
             echo "</ul>";
        }
        
    ?>

    <?php recursiveMenu($id, $groupProductss);  ?>

    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    

                     <a href="" class="sua">Sửa</a>
                     <br>
                     

                </div>
                
            </div>
        </div>
    </div>

   

    <script type="text/javascript">
        $('.groupProduct').click(function () {
           
           $('#modals-product').modal('show');

        })

        $('.sub-menu').hide();

        $('.click1').dblclick(function(){

            dataId = $(this).attr('data-id');

            $('.sua').attr('href', '{{env("APP_URL")}}/admins/groupProducts/'+dataId+'/edit');

            $('#info-modal').modal('show');


        })

        function showChild(id, classs, product_id) {

            if($('.'+id).is(":visible") ){
                 $('.'+id).hide();
                 $('.'+classs).text('+');

            }
            else{
                

                $.ajax({
                    type: 'GET',
                    url: "{{ route('filter-child-click') }}",
                    data: {
                        id: id,
                        product_id: product_id
                       
                    },
                   
                    success: function(result){

                       

                        if($('.'+id).text()==''){

                             $('.'+id).append(result);

                        }
                       
                    }
                });
                $('.'+id).show();
                $('.'+classs).text('-');
            }

        
        }

        function selected(id) {

             var checked = $('#select'+id).is(':checked'); 


            var active = 0;

            if(checked == true){
                active = 1;
            }
            else{
                active = 0;
            }

            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('add-group-product') }}",
                data: {
                    id: id,
                    product_id:{{ $id }},
                    active:active,
                },
               
                success: function(result){

                    console.log(result);
                   
                }
            });

        }

    </script>
</div>

@endsection
