@if(isset($data))

<tbody>
    <tr>
        <td>
            Tên khuyến mãi : <input type="text" value="{{ $data->name }}" id="names">
            <br>
            <br>
            Giá km (nhập số) : <input type="text" value="{{ $data->price }}" id="prices">
            <br>
            <br>    

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="update_deal_price('{{ $data->id }}')">Xác nhận</button>
        </td>
      
    </tr>
</tbody>

@endif