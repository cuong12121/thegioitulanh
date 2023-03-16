
<?php

    function _substr($str, $length, $minword = 3)
    {
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
          break;
        }
     }
        return $sub . (($len < strlen($str)) ? '...' : '');
    }
        
?>


<?php  
    if(Schema::hasTable('categories')){
        $category =    DB::table('categories')->select('namecategory', 'id')->get();  
        $new_category = [];
        if(count($category)>0){
            foreach ($category as  $value) {
               $new_category[$value->id] = $value->namecategory;
            }
        }
    }    
    
?>

<style type="text/css">
    
    .content h3, .content h2{
        font-size: 20px !important;
        font-weight: 330 !important;

    }

    .content h3 a, .content h2 {
        color: #212529;
    }
    .post-find{
        width: 20%;
    }
</style>

    <form class="form-inline active-pink-3 active-pink-4 post-find" method="get" action="{{ route('findPostAdmin') }}">
                           
        <button><i class="fas fa-search" aria-hidden="true"></i></button>
        <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search" name="searchPost" required> 

    </form>
<br>

<div class="table-responsive">
    <table class="table" id="posts-table">
        <thead>
        <tr>
            <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        
    
        <th>ngày viết bài</th>

        <th>Hiển thị</th>
        <th>Show ra home</th>

        <th>người dùng</th>
        <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>

          
        @if(!empty($posts))    
        @foreach($posts as $post)
            @if($post->category!=5)
            <tr>
                <td><img src="{{ url($post->image) }}" style="width:200px"></td>
            <td>{{ $post->title }}</td>
            <td>{{ @$new_category[$post->category] }}</td>

     

             <td>{{ @$post->date_post }}</td>  

            <td><a href="javascript:voi(0)" class="active-post" onclick="add_active('{{ $post->id }}','{{ $post->active }}')">{!! $post->active ==1?'<b style="color:red">Hạ xuống</b>':'<b style="color:green">Hiển thị</b>' !!}</a></td>   
             
             <td><a href="javascript:void(0)" class="hight-light-post"  onclick="add_hight_light('{{ $post->id }}','{{ $post->hight_light }}')" data-id="{{ $post->id }}">{!! $post->hight_light ==1?'<b style="color:red">Hạ xuống</b>':'<b style="color:green">Hiển thị</b>' !!}</a></td>
             <td>{{ App\User::find($post->id_user)->name??'' }} </td>
                <td width="120">
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('details', [$post->link]) }}"
                           class='btn btn-default btn-xs' target="_blank">
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('posts.edit', [$post->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endif
        @endforeach

        @endif
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function add_active(id, active){

        $.ajax({

        type: 'GET',
            url: "{{ route('add-active-post') }}",
            data: {
                id: id,
                active:active,
                
            },
            success: function(result){
                
                window.location.reload();
               
            }
        });
    }

    function add_hight_light(id, active){

        $.ajax({

        type: 'GET',
            url: "{{ route('add-hight-light-post') }}",
            data: {
                id: id,
                active:active,
                
            },
            success: function(result){
                
                
                window.location.reload();
               
            }
        });
    }

</script>
