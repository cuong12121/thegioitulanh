@extends('layouts.app')

@section('content')

    @if(isset($product->Meta_id ))
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Sửa sản phẩm  {{ $product->Name }}</h1>
                </div>
            </div>
        </div>
    </section>
     <?php $metaSeo = App\Models\metaSeo::find($product->Meta_id); ?>

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
    ?>        

   <!--  <div class="btn btn-warning"><a href="{{ route('metaSeos.edit', 1) }}"></a>Seo</div> -->
    <div class="btn btn-warning {{ (empty($_GET['mota']) && empty($_GET['specifications']) && empty($_GET['seo']) )?'activess':'' }}" ><a href="{{ route('products.edit', $product->id) }}">Cơ bản</a></div>
   <div class="btn btn-warning" ><a href="{{ route('group-product-selected', $product->id) }}">Danh mục</a></div>

   <div class="btn btn-warning btn-info seo-click {{ !empty($_GET['seo'])?'activess':'' }}"><a href="{{ route('products.edit', $product->id) }}?seo={{ $product->id }}">SEO</a></div>

    <div class="btn btn-warning {{ !empty($_GET['mota'])?'activess':'' }}"><a href="{{ route('products.edit', $product->id) }}?mota={{ $product->id }}">Mô tả</a></div>
    <div class="btn btn-warning  {{ !empty($_GET['specifications'])?'activess':'' }}" ><a href="{{ route('filter-property') }}?group-product={{ get_Group_Product($product->id)[0]??'' }}&productId={{ $product->id }}">Thông số</a></div>
    <div class="btn btn-warning"><a href="{{ route('images.create') }}?{{ $product->id }}">Ảnh</a></div>
<!--     <div class="btn btn-warning" ><a href="#mo-ta">Thông số kỹ thuật chi tiết</a></div> -->
    <div class="btn btn-warning" ><a href="{{ route('details', $product->Link) }}" target="_blank">Xem tại web</a></div>
    <div class="btn btn-warning check-show" ><a class="" href="javascript:void(0)" onclick="show({{ $product->active==0?1:0  }}, {{ $product->id }})"> {{  $product->active==0?'Ẩn':'Hiển thị' }} </a></div>
    
    @if(!empty($metaSeo) && !empty($_GET['seo']))
    
   
    <div class="content px-3">
        @include('adminlte-templates::common.errors')

        <div class="card seo">

            {!! Form::model($metaSeo, ['route' => ['metaSeos.update', $metaSeo->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('meta_seos.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('metaSeos.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    @endif

    @endif

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

            <?php 

                if(!empty($product->Detail)){


                    $contens = $product->Detail;

                    $images = preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $contens, $matches);

                }

                $ar_new = [];

                $ar_change = [];
                if(!empty($matches[1])){

                    foreach ($matches[1] as $key => $value) {
                        str_replace('id="images'.$key.'"','', $contens);


                        $values = 'src="'.$value.'"';
                        $values1 = 'src="'.asset($value).'" id="images'.$key.'"';

                        $ar_new[] = $values;
                        $ar_change[] = $values1;
                       
                    }
                    $content1 = str_replace($ar_new, $ar_change, $contens);

                    $product->Detail = $content1;
                    $product->Detail = str_replace(['http://dienmaynguoiviet.net', 'https://dienmaynguoiviet.net'], 'https://dienmaynguoiviet.vn', $product->Detail);
                    
                  
                }
                
            ?>

            <div class="card-body">
                <div class="row">
                    @include('products.fields')
                </div>
            </div>
            @if(empty($_GET['seo']))
            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
            </div>
            @endif
            {!! Form::close() !!}

        </div>
    </div>
@endsection

<script type="text/javascript">
    
    function show(active, productId) {
        
        $.ajax({
           
            type: 'POST',
            url: "{{ route('check-active') }}",
            data: {
                product_id: productId,
                active:active
                   
            },
            success: function(result){
                if(active==1){

                    text = '<a href="javascript:void(0)" onclick="show(0, {{ $product->id }})"> Hiển thị </a>'

                    $('.check-show a').remove();

                    $('.check-show').append(text);
                    

                    
                }
                else{
                    text = '<a href="javascript:void(0)" onclick="show(1, {{ $product->id }})"> Ẩn </a>';

                    $('.check-show a').remove();

                    $('.check-show').append(text);
                   
                }
               
            }
        });
    }
</script>
