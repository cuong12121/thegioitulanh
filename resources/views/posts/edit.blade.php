@extends('layouts.app')

@section('content')

@if(isset($post->Meta_id ))
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Product</h1>
                </div>
            </div>
        </div>
    </section>
     <?php $metaSeo = App\Models\metaSeo::find($post->Meta_id); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Post</h1>
                </div>
            </div>
        </div>
    </section>



     @if(!empty($metaSeo))
    <div class="btn btn-info seo-click"> Dùng cho SEO </div>



   
    <div class="content px-3">

        
        @include('adminlte-templates::common.errors')

        <div class="card seo">

            {!! Form::model($metaSeo, ['route' => ['metaSeos.update', $metaSeo->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('meta_seos.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('metaSeos.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    @endif

@endif
    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'patch', 'files' => true]) !!}
             <?php 

                if(!empty($post->content)){

                    $contens = $post->content;

                    $images = preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $contens, $matches);

                }

                $ar_new = [];

                $ar_change = [];
                if(isset($matches[1])){
                    foreach ($matches[1] as $key => $value) {
                        str_replace('id="images'.$key.'"','', $contens);
                        $values = 'src="'.$value.'"';
                        $values1 = 'src="'.asset($value).'" id="images'.$key.'"';

                        $ar_new[] = $values;
                        $ar_change[] = $values1;
                       
                    }
                    $content1 = str_replace($ar_new, $ar_change, $contens);

                    $post->content = $content1;
                }    
            ?>


            <div class="card-body">
                <div class="row">
                    @include('posts.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('posts.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
