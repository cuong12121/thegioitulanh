@extends('layouts.app')

@section('content')

<?php 

    $request = !empty($redirect)?route('redirect.update', $redirect->id):route('redirect.create');
?>

<div class="group">
    <div class="group-fields">

        <table id="tb_padding">
            <tbody>

                <form method="post" action="{{ $request }}">
                    @csrf
                    <div>
                        <tr>
                            <td>Link cũ</td>
                            <td><input type="text" size="80" name="request_path" id="request_path" value="{{ @$redirect->request_path }}" required></td>
                        </tr>
                        <tr>
                            <td>Link đích mới</td>
                            <td><input type="text" size="80" name="target_path" id="target_path" value="{{ @$redirect->target_path }}" required></td>
                        </tr>
                        <tr>
                            <td>Redirect Code</td>
                            <td><select name="redirect_code" id="redirect_code"><option>--Chọn--</option><option value="0">No redirect</option><option value="301" selected="">301 - Moved Permanently</option><option value="302">302 - Moved Temporarily</option></select></td>
                        </tr>
                    </div>
                    
                    <div class="group-actions">
                        <button type="submit">Cập nhật</button>
                    </div>
                </form>
                

            </tbody>
        </table>

    </div>
    
</div>

@endsection