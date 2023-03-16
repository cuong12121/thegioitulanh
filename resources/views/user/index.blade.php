@extends('layouts.app')

<style type="text/css">
        
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }
    </style>

@section('content')

    <?php 
     $user = DB::table('users')->select('name', 'permision','id', 'email')->get(); 
     $permision = ['chưa cấp quyền','content', 'content+sale', 'admin'];

    ?>

    
    <h2>Danh sách người dùng</h2>

   @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <ul></ul>
   <table>
        <tbody><tr>
            <th>Danh sách</th>
            <th>Email</th>
            <th>Quyền hạn </th>
            <th>Xóa</th>
        </tr>

        

        @foreach($user as $users)
        
        <tr>
            <td>{{ $users->name }}</td>
            <td>{{ @$users->email }}</td>
            
            <td> 
                <select name="option" onchange="location = this.value;">
                    @foreach($permision as $key => $permisions)

                    <option value="{{ route('updatePermission') }}?id={{ $users->id }}&permision={{ $key }}" {{ $users->permision==$key?'selected':'' }}>{{ $permisions }}</option>
                 
                    @endforeach
                </select>

               
            <td>
                <a href="{{ route('deleteUser') }}?id={{ $users->id }}">Xóa</a>
            </td>
        </tr>
        @endforeach
       
                       
    </tbody></table>
@endsection