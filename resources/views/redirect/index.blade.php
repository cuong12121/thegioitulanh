@extends('layouts.app')

@section('content')
<table border="1" bordercolor="#CCCCCC" id="tb_padding" style="border-collapse:collapse; width:100%">
    <tbody>
        <tr style="background-color:#EEE; font-weight:bold;">
            <td width="30px">STT</td>
            <td>Link truy cập</td>
            <td>Link đích</td>
            <td>Redirect_code</td>
            <td width="100px">Lựa chọn</td>
        </tr>
        <tr id="row_164654" onmouseover="this.className='row-hover'" onmouseout="this.className=''" class="">
            <td>1</td>
            <td><input type="text" size="30" value="/dieu-hoa-daikin-ftkc71uvmv-1-chieu-inverter-24200btu/"> (<a href="/dieu-hoa-daikin-ftkc71uvmv-1-chieu-inverter-24200btu/" target="_blank">xem</a>)</td>
            <td>
                <input type="text" size="60" value="https://dienmaynguoiviet.vn/dieu-hoa-daikin-ftkc71uvmv-1-chieu-inverter-24000btu/">
                (<a href="?opt=url&amp;view=redirect-form&amp;id=164654">Sửa lại</a>)
            </td>
            <td>301</td>
            <td><a href="javascript:;" onclick="delete_url('164654')">Xóa</a></td>
        </tr>
       
    </tbody>
</table>
@endsection