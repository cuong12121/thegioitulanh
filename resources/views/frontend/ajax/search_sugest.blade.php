
 {{ count($product) }}       

@if(isset($product))

@foreach($product as $products){


<tr>
    <td style="vertical-align:top">
    	<a href="{{ route('details', $products-Link) }}">
	    	<img src="{{  asset($products->Image) }}" width="50" style="margin-right:10px;">
	    </a>
    </td>
    <td style="vertical-align:top; color:red; line-height:18px;"><a class="suggest_link" href="{{ asset($products->Link) }}">{{ $products->Name }}</a><br>{{ $products->Price }}</td>
</tr>

@endforeach

@endif
