@extends('layouts.app')

@section('content')
    <?php 
        $page = ['homecs.css', 'categorycs.css', 'detailscs.css'];
    ?>
    File {{ $page[$id] }}
    <form method="post" action="{{ route('saveCss') }}">
        @csrf
         <button type="submit">Lưu lại</button>

          <br>

        <input type="hidden" name="file" value="{{ $page[$id] }}">  

        <textarea style="width: 800px; height: 1900px;" name="css">{{ strip_tags(nl2br($contents))  }}</textarea>

         <br>
       
       
    </form>
    
@endsection

