
<!-- <li class="nav-item">
    <a href="{{ route('banners.index') }}"
       class="nav-link {{ Request::is('banners*') ? 'active' : '' }}">
        <p>Banners</p>
    </a>
</li> -->

<style type="text/css">
    
    .child-nav{
        margin-left: 15px;
    }
</style>



<li>
     <a href="{{ route('home-admin') }}"
       class="nav-link {{ Request::is('home-admin') ? 'active' : '' }}" style="width: 68%;">
        <p>Trang chủ</p>
        
    </a>
</li>



<li class="nav-item"  >
    <div style="display:flex;">
        <a href="{{ route('pop-up-show') }}"
           class="nav-link {{ Request::is('groupProducts*') ? 'active' : '' }}" style="width: 68%;">
            <p>Hiển thị</p>
            
        </a>
       
        <span class="btn btn-link opens-fe" style="width: 12%;">+</span>
    </div>    
        

   <!--  <ul style="width: 68%">
        
        <li class="child-navs" style="">
            <a href="{{ route('pop-up-show') }}" class="nav-link">
                <p>Popup-toàn trang</p>
            </a>
        </li>

        <li class="child-navs" style="">
            <a href="#" class="nav-link">
                <p>Tìm kiếm nhiều cuối trang</p>
            </a>
        </li>

        <li class="child-navs" style="">
            <a href="#" class="nav-link">
                <p>Đổi hình nền toàn trang</p>
            </a>
        </li>
        
    </ul> -->
    
</li>
@if(Auth::user()->permision>1)

<li class="nav-item" style="display: flex; height:44px;"  >

   

    <a href="{{ route('groupProducts.index') }}"
       class="nav-link {{ Request::is('groupProducts*') ? 'active' : '' }}" style="width: 68%;">
        <p>Nhóm sản phẩm</p>
        
    </a>

    <?php
        $listGroup = App\Models\groupProduct::select('name','id')->where('level', 0)->get();

    ?>

    @if(count($listGroup)>0)
     <span class="btn btn-link open" style="width: 12%;">+</span>
     @endif 
    
    
</li>


<ul style="width: 68%;">
    @if(count($listGroup)>0)
    @foreach($listGroup as $value)
    <li class="child-nav">
        <a href="{{ route('select-category',[$value->id]) }}"
           class="nav-link">
            <p>{{ $value->name }}</p>
        </a>
    </li>
    @endforeach

    
    @endif

    <li class="child-nav">
        <a href=""
           class="nav-link">
            <p>Sản phẩm chế độ là Sale</p>
        </a>
    </li>

     <li class="child-nav">
        <a href=""
           class="nav-link">
            <p>Sản phẩm chế độ là Hot</p>
        </a>
    </li>
</ul>
@endif


<li class="nav-item">
    <a href="{{ route('changepassview') }}"
       class="nav-link {{ Request::is('changepassview') ? 'active' : '' }}">
        <p>Đổi mật khẩu</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('makers.index') }}"
       class="nav-link {{ Request::is('makers*') ? 'active' : '' }}">
        <p>Hãng phân phối</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('redirect.list') }}"
       class="nav-link {{ Request::is('makers*') ? 'active' : '' }}">
        <p>redirect link</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('addcss') }}"
       class="nav-link {{ Request::is('makers*') ? 'active' : '' }}">
        <p>Sửa css trang</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <p>Category  bài viết</p>
    </a>
</li>


@if(Auth::user()->permision>1)

<li class="nav-item">
    <a href="https://thegioitulanh.vn/admins/category/3"
       class="nav-link {{ Request::is('products*') ? 'active' : '' }}">
        <p>Sản phẩm</p>
    </a>
</li>

@endif

@if(Auth::user()->permision == 3)

<li class="nav-item">
    <a href="{{ route('view-user') }}"
       class="nav-link {{ Request::is('products*') ? 'active' : '' }}">
        <p>Quản trị người dùng</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('register-user') }}"
       class="nav-link {{ Request::is('products*') ? 'active' : '' }}">
        <p>Đăng ký user</p>
    </a>
</li>

@endif

<li class="nav-item">
    <a href="{{ route('banners.index') }}"
       class="nav-link {{ Request::is('banners*') ? 'active' : '' }}">
        <p>Banner</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('order_list') }}"
       class="nav-link {{ Request::is('order_list') ? 'active' : '' }}">
        <p>Order</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('deal') }}"
       class="nav-link {{ Request::is('deal') ? 'active' : '' }}">
        <p>Deal</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('flashDeal') }}"
       class="nav-link {{ Request::is('flashDeal') ? 'active' : '' }}">
        <p>Flash Deal</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('posts.index') }}"
       class="nav-link {{ Request::is('order_list') ? 'active' : '' }}">
        <p>Bài viết </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('landing') }}"
       class="nav-link {{ Request::is('landing') ? 'active' : '' }}">
        <p>Landing-page </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('rate-client') }}"
       class="nav-link {{ Request::is('order_list') ? 'active' : '' }}">
        <p>Đánh giá sản phẩm </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('postcd') }}"
       class="nav-link {{ Request::is('order_list') ? 'active' : '' }}">
        <p>Nội dung cố định </p>
    </a>
</li>


<style type="text/css">
    
    .child-nav a{
        width: 100%;
    }
</style>

<script type="text/javascript">
    $('.child-nav').hide();

    $('.child-navs').hide();

    $(".open").bind("click", function(){

        var acction = $(".open").text();

        if(acction =='+'){
            $('.child-nav').show();
            $('.open').text('-');
        }
        else{
            $('.child-nav').hide();
            $('.open').text('+');
        }
    });

    $(".opens-fe").bind("click", function(){

        var acction = $(this).text();

        if(acction =='+'){
            
            $(".opens-fe").text('-');
            $('.child-navs').show();
        }
        else{
            
            $(this).text('+');
            $('.child-navs').hide();
        }
    });
    
</script>


<li class="nav-item">
    <a href="{{ route('gifts.index') }}"
       class="nav-link {{ Request::is('gifts*') ? 'active' : '' }}">
        <p>Gifts</p>
    </a>
</li>


