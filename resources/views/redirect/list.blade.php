@extends('layouts.app')

@section('content')

<a href="{{ route('redirect.creates') }}">thêm link</a>

<table border="1" bordercolor="#CCCCCC" id="tb_padding" style="border-collapse:collapse; width:100%">
    <tbody>
        <tr style="background-color:#EEE; font-weight:bold;">
            <td width="30px">STT</td>
            <td>Link truy cập</td>
            <td>Link đích</td>
            <td>Redirect_code</td>
            <td width="100px">Lựa chọn</td>
        </tr>

        @if(isset($list))

        <?php 
            $number = 0;
        ?>

        @foreach($list as  $val)
        <?php 
            $number++;
        ?>
        <tr id="row_164654" onmouseover="this.className='row-hover'" onmouseout="this.className=''" class="">
            <td>{{ $number }}</td>
            <td><input type="text" size="30" value="{{ @$val->request_path }}"></td>
            <td>
                <input type="text" size="60" value="{{ @$val->target_path }}">
                
            </td>
            <td>301</td>
            <td><a href="{{ route('redirect.show', $val->id) }}">Sửa</a></td>
            <td><a href="{{ route('redirect.remove', $val->id) }}">xóa</a></td>
        </tr>
        @endforeach

        @endif
       
    </tbody>
</table>

{!! $list->links() !!}
@endsection