

@if(isset($data))

   
    @foreach($data as $datas)

        @if($datas->active>0) 
                  
        <li class="paren1">
            <input type="checkbox" id="select{{ $datas->id }}" name="sale" onclick="selected('{{ $datas->id }}')" {{ json_decode($datas->product_id)!=null && in_array($product_id, json_decode($datas->product_id))?'checked':''}}><a href="javascript:void(0)" class="click1" data-id="{{ $datas->id }}">{{ $datas->name }}</a>  @if($datas->level<4)<span class="clicks{{ $datas->id }}" onclick="showChild('sub{{ $datas->id }}', 'clicks{{ $datas->id }}', '{{ $product_id }}')">+</span>@endif            
            
        </li>
        @endif
        <ul class="sub-menu sub{{ $datas->id }}" style="display: none;"></ul>
    
    @endforeach
   
@endif   

