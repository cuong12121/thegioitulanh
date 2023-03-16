@if(Route::currentRouteName()=="banners.create")
<?php 
    $option[0] = ['name'=>'Banner slide home', 'size'=>'1920px x 630px'];
    $option[1] = ['name'=>'Banner top', 'size'=>'1920px x 44px'];
    $option[2] = ['name'=>'Banner bên phải slider home', 'size'=>'254px x 254px'];
    $option[3] = ['name'=>'Banner dưới slider home', 'size'=>'690px x 305px'];
    $option[4] = ['name'=>'Banner category', 'size'=>'1200 x 200px'];
    $option[5] = ['name'=>'Banner trên phần sale home', 'size'=>'1200 x 90'];
    $option[6] = ['name'=>'Banner home Tivi', 'size'=>'1200 x 90'];
    $option[7] = ['name'=>'Banner home Máy giặt', 'size'=>'1200 x 90'];
    $option[8] = ['name'=>'Banner home Tủ lạnh', 'size'=>'1200 x 90'];
    $option[9] = ['name'=>'Banner home Điều hòa', 'size'=>'1200 x 90'];
    $option[10] = ['name'=>'Banner home Gia dụng', 'size'=>'1200 x 90'];
    $option[11] = ['name'=>'Banner home Máy lọc nước', 'size'=>'1200 x 90'];
    $option[12] = ['name'=>'Banner scroll home left', 'size'=>'179px - 271px'];
    $option[13] = ['name'=>'Banner scroll home right', 'size'=>'179px - 271px'];
?>
<div class="form-group col-sm-12">
<select name="option">
    @foreach($option as $key => $options)
    <option value="{{ $key }}">{{ $options['name'] }}</option>
 
    @endforeach
</select>
@endif
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('image', ['class' => 'custom-file-input']) !!}
            {!! Form::label('image', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>


<!-- slogan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slogan', 'Slogan:') !!}
    {!! Form::text('slogan', null, ['class' => 'form-control']) !!}
</div>

<!-- stt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stt', 'STT:') !!}
    {!! Form::text('stt', null, ['class' => 'form-control']) !!}
</div>



<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>