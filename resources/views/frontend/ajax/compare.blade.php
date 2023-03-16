<style type="text/css">

     @media only screen and (max-width: 768px) {
        .add-mobile-compare{
            width: 100% !important;
        }
    }
</style>


@if(!empty($data))

@foreach($data as $datas)
<div class="col-md-4">
    <a href="javascript:void(0)" class="js-compare-item position-relative compare-add-mobile" data-id="39839">
        <!-- <span class="remove-compare js-remove-compare" onclick="removeCompare({{ $datas->id }})">X</span> -->
        <div class="img-compare">
            <img src="{{ asset($datas->Image) }}">
        </div>
        
        <span>{{ $datas->Name }}</span>
    </a>

</div>

@endforeach

<?php 
    $count = 3-count($data);
?>

@for($i=1; $i<=$count; $i++)

<div class="col-md-4">

        <div class="img-compare">
            <a href="javascript:void(0)" class="add-search-popup add-compare-a add-mobile-compare"  id="search-pro-{{ $i }}">

           <i class="icImageCompareNew"></i>

            <span>Thêm sản phẩm</span>
        </div>
        
    </a>
</div>



@endfor

@endif

<style type="text/css">
    .pro-compare_viewed{
        display: flex;
        overflow: hidden;
        border: unset;
        justify-content: center
    }
   .pro-compare_viewed li {
        float: left;
        width: 33.33%;
        border: 1px solid #e5e5e5;
        border-right: 0;
        text-align: center;
        padding: 15px 4px 20px 4px;
        margin: 0 0 20px;
        position: relative;
    }

    .pro-compare_viewed li h3{
        overflow: hidden;
        overflow-x: hidden;
        overflow-y: hidden;
        font-size: 14px;
        padding: 0 0 3px 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
    }

    .input-search-compare{
        border: 1px solid #ddd;
        width: 50%;
        height: 35px;
    }
    
</style>


<div class="modal" tabindex="-1" role="dialog" id="modal-search-pd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sản phẩm đã xem gần nhất</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div>
                        <ul class="pro-compare pro-compare_viewed">

                            
                        </ul>
                    </div>
                    <div>
                         <input type="text" class="input-search ui-autocomplete-input input-search-compare" id="searchs" placeholder="Nhập tên hoặc mã model" name="key" autocomplete="off" maxlength="100" required="" id="search-model"> 

                         <button type="button" class="btn btn-success" onclick="add_Pd_search('')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                </svg>
                       
                      </button>
                     
                        
                        <div id="suggesstion-box"></div>
                       <!--  <div id="search-result"></div>  -->
                    </div>
                   
                
            </div>

            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary close-modal" >Close</button>
            </div>
           
        </div>
    </div>
</div>

<script type="text/javascript">
    var id_name = [];

    getPDViewer();

    function getPDViewer() {
        
        viewerPD = JSON.parse(localStorage.getItem('viewed_product'));

        viewerPDSend = JSON.stringify(viewerPD);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: "{{ route('ajax-compare-viewerPd') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                viewerPD:  viewerPDSend,
            },
           
            success: function (data) {
                $('.pro-compare_viewed').append(data);
                     
            }
        });
       

        
    }

    $('.add-search-popup').click(function () {

         id_names = $(this).attr('id');

         id_name.push(id_names);

       $('#modal-search-pd').show();

    });



    $('.close-modal').click(function () {
       
      $('#modal-search-pd').hide();
    });
    
   

    function add_Pd_search(search) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
      
        $.ajax({

            url: "{{  route('search-pd-compare')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                search: search??$('#searchs').val()
            },
           
            success: function (data) {

               let classname =  id_name[0]??'';
               $('#'+classname).html('');
               html = '<img src="https://dienmaynguoiviet.vn/'+data.Image+'"> <span>'+data.Name+'</span>';
               $('#'+classname).append(html);
                $('#'+classname).removeClass('add-compare-a');
               $('#modal-search-pd').modal().hide();
               $('#modal-search-pd').modal('hide');
               id_name = [];
               ar_product.push(data.id);
              
              
            }
        });
    }

    $(function() {
        $("#searchs").autocomplete({

            minLength: 2,
            
            source: function(request, response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    url: "{{  route('search-input-pd-compare')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        search:$('#searchs').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        var items = data;                      
                        
                        // response(items);

                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);

                        
                    
                    }
                });
            },
            html:true,
        });
    });
</script>
