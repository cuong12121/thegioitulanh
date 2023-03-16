
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

    $user  = App\User::orderBy('id','asc')->get()->toArray();
    $posts  = App\Models\post::where('category', 5)->get();

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
</style>



<div class="table-responsive">
    <table class="table" id="posts-table">
        <thead>
        <tr>
            <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        
        <th>Mô tả ngắn</th>

        
      

        <th>người dùng</th>
        <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>


            
        @foreach($posts as $post)
            <tr>
                <td><img src="{{ url($post->image) }}" style="width:200px"></td>
            <td>{{ $post->title }}</td>
            <td>{{ @$new_category[$post->category] }}</td>

       
             <td>{!! _substr(preg_replace("#<\/p>(<\/h[1-6]>)#", '$1', $post->shortcontent),240,3) !!}</td>

           
             <td>{{ @$user[$post->id_user]['name'] }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('posts.show', [$post->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('posts.edit', [$post->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                       
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
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
