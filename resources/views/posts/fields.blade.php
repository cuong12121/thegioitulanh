
<?php  $url_domain =  Config::get('app.url') ?>

<style type="text/css">
    .border1{
        border: 2px solid #e74032;

    }
</style>

<div class="col-md-12 draft-article" >
    <button type="button" class="btn btn-info article-but" onclick="setDataForm()">Bài viết nháp</button>
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    
</div>

<?php 
    if(Schema::hasTable('categories')){
        $category =    DB::table('categories')->select('namecategory', 'id')->get();
        $new_category = [];
        if(isset($category)){
            foreach ($category as  $value) {
               $new_category[$value->id] = $value->namecategory;
            }
        }
        
        $categoryselected = !empty($post)?$post['category']:'1';
    }
     
        
?>
@if(Schema::hasTable('categories'))
<div class="form-group col-sm-6">
    {!! Form::label('category', 'category:') !!}
   {{ Form::select('category', @$new_category, $categoryselected, ['id' => 'category', 'class' => 'form-control']) }}
</div>
@endif

<!-- shortcontent Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('shortcontent', 'Mô tả ngắn:') !!}
   <textarea class="form-control content-input" name="shortcontent" cols="50" rows="10" id="shortcontent">{!! strip_tags(@$post->shortcontent) !!}</textarea>
</div>





<div id="article_media_holder"><style type="text/css">
    a.preview_media{
        position:relative; /*this is the key*/
        z-index:24;}
    a.preview_media:hover{z-index:25; cursor:pointer}
    a.preview_media span{display: none}
    a.preview_media:hover span{
        display:block;
        position:absolute;
        top:-120px; left:50px; width:auto;
        text-align: center}
</style>


<br>


</div>
<style type="text/css">
    .button{
        cursor: pointer;
        border-radius: 5px;
        padding: 5px;
    }
</style>

<!-- Content Field -->
<div class="btn-primary button" onclick ='removeHref()'>Xóa link content</div>

&nbsp &nbsp &nbsp &nbsp

<div class="btn-primary button" onclick ='removeHref_byselected()'>Xóa link bôi đen </div>


<div class="form-group col-sm-12 col-md-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control content-input']) !!}
</div>

<div class="col-md-12 col-sm-12">
    
    <div id="article_media_holder">
    <style type="text/css">
        a.preview_media{
        position:relative; /*this is the key*/
        z-index:24;}
        a.preview_media:hover{z-index:25; cursor:pointer}
        a.preview_media span{display: none}
        a.preview_media:hover span{
        display:block;
        position:absolute;
        top:-120px; left:50px; width:auto;
        text-align: center}
    </style>
    <table class="big_table" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="3">
        <tbody>
            <tr>
                @if(isset($matches[1]))
                @foreach($matches[1] as $key => $value)
                 <td class="img{{ $key }} tdimg"><a href="javascript:void(0);" onclick="clicks('images{{ $key }}', '{{ asset($value) }}')"><img src="{{ asset($value) }}" style="max-width:100px; max-height:130px" id="img{{ $key }}"></a></td>
             
                @endforeach
                @endif
            </tr>
            
           
        </tbody>
    </table>
    <br>
    
    <br>
</div>
@if(isset($post->id))

<?php  

    $imagecontent = App\Models\imagescontent::where('product_id', $post->id)->where('option',2)->get();
?>

<div><a href="{{ route('imagescontent', $post->id) }}?option=2">Thêm ảnh content</a></div>


<table class="big_table" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="3">
    <tbody>
        <tr>
            @if(isset($imagecontent))
            @foreach($imagecontent as $key => $values)
            <td class="img1{{ $key }}"><a href="javascript:void(0);" onclick="click1('images1{{ $key }}', '{{ asset($values->image) }}')"><img src="{{ asset($values->image) }}" style="max-width:100px; max-height:130px" id="img1{{ $key }}"></a></td>
         
            @endforeach
            @endif
        </tr>
        
       
    </tbody>

</table>
@endif



<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('image', ['class' => 'custom-file-input']) !!}
            {!! Form::label('image', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">

    $(document).ready(function() {

        $( "#title" ).autocomplete({  
            source: function( request, response ) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('searTitlePost') }}',
                    data: {
                        title: $("#title").val(),
        
                    },
                    dataType: "json",
                    

                    success: function(data) {
                      
                        var items = data;

                        response(items[0]);
                       
                    }
                });
            
            },
            minLength: 3,
            html:true,  
            autofocus: true   
        });  

    });
    var activeReplace = [];


   
   
    function clicks(id,src) {
        editor = CKEDITOR.instances.content;
        var documentWrapper = editor.document; // replace by your CKEDitor instance ID
        var documentNode = documentWrapper.$; // or documentWrapper['$'] ;
        var edata = editor.getData();
        documentNode.getElementById(id).scrollIntoView();
        ids = id.replace('images', 'img');
        $('.tdimg').removeClass('border1');
        activeReplace.push(src);
        activeReplace.push(id);
        activeReplace.push(ids);
        $('.'+ids).addClass('border1');
    }

    function click1(id, src) {
        if(activeReplace.length==0){
            img = '<img src="'+src+'">';
            CKEDITOR.instances['content'].insertHtml(img);
        }
        else{
            editor = CKEDITOR.instances.content;
            var documentWrapper = editor.document; // replace by your CKEDitor instance ID
            var documentNode = documentWrapper.$; // or documentWrapper['$'] ;
            var edata = editor.getData();
            var replaced_text = edata.replace(activeReplace[0], src); // you could also use a regex in the replace 
            editor.setData(replaced_text);
            documentNode.getElementById(activeReplace[1]).scrollIntoView();
            $('#'+activeReplace[2]).attr('src', src);
            activeReplace.pop();
            activeReplace.pop();
            activeReplace.pop();
            $('.tdimg').removeClass('border1');
        }

        
    }
    
</script>




<script>
    var item_local_store =  JSON.parse(localStorage.getItem('infopost'));

    if(item_local_store!=null){
        $('.draft-article').show();
    }
    else{
        $('.draft-article').hide();
    }




    function getDataform(){

        if(item_local_store !=null){

            localStorage.removeItem('infopost');

        }

        const title = $('#title').val();
        const shortcontent = $('#shortcontent').val();
        const content = CKEDITOR.instances.content.getData();

        infopost = [title, shortcontent, content];

        localStorage.setItem('infopost', JSON.stringify(infopost));

         $('.draft-article').show();

    }

    $('#shortcontent').bind("change", function() { 
        getDataform();

    });

    
    let ar_image = [];

    // function getBase64(file) {
    //    var reader = new FileReader();
    //    reader.readAsDataURL(file);
    //    reader.onload = function () {
    //         ar_image.push(reader.result);
    //         console.log(ar_image);
           
    //         const max = parseInt((ar_image.length)/2)
    //         for (i = 0; i <= max; i++) {
                
    //                 for(j=i; j<=i*2; j++){
    //                     '<td width="50%" align="center"><a href="javascript:void(0); title="Click để chuyển ảnh vào mô tả"><img src="++" height="60"></a></td>';
    //                 } 
               
    //         }
         
    //    };
    //    reader.onerror = function (error) {
    //      // console.log('Error: ', error);
    //    };
    // }

    $('#file-image-content').bind("change", function() { 
        
        var file = document.querySelector('#file-image-content').files[0];
        getBase64(file);

    });
   
    editor = CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl: '{{ $url_domain }}/ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700',
        on: {
            change: function( evt ) {

                getDataform();
            },
        },
        
    });



    function removeHref_byselected(text1) {

        check = $('#cke_74').hasClass('cke_button_off');

        // nếu button xóa link hiển thị thì click1
        // còn không thì customn click

        if(check==true){
            $( "#cke_74" ).click();

        }
        else{
            var text1 =  CKEDITOR.instances.content.getSelection().getSelectedText();

            CKEDITOR.instances.content.insertText(text1);
        }
    }


    function removeHref() {

        let content = CKEDITOR.instances.content.getData();

        var regex = /(<\s*a([^>]+)>|<\/\s*a\s*>)/ig;

        contents = content.replace(regex, ""); 

        CKEDITOR.instances.content.setData(contents);
    }

    function setDataForm() {

        item_local_stores =  JSON.parse(localStorage.getItem('infopost'));
        console.log(item_local_stores)
        
        CKEDITOR.instances.content.setData(item_local_stores[2]);
        $('#title').val(item_local_stores[0]);
        $('#shortcontent').val(item_local_stores[1]);
        $('.article-but').css('color', 'red');

    }

   

    // $(document).ready(function()
    // {
    //     $(window).bind("beforeunload", function() { 
    //         return confirm("Do you really want to close?"); 

    //     });

       
    // });
</script>



