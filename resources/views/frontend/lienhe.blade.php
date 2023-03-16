@extends('frontend.layouts.apps')
@section('content')

@push('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}"> 

        <link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}"> 
         <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}"> 
         <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
 @endpush  

    
<div class="container page-content">
    <h1>Liên Hệ</h1>
</div>

@if(session()->has('success'))
<p>{{ session('success') }}</p>

@endif
<div class="container page-content">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.9379070683144!2d105.89156431429718!3d20.99512599430295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aeb6d3123c99%3A0x1dacc1ff3c53b2ca!2sThe+Vietnam+Electronics!5e0!3m2!1sen!2s!4v1532137923637" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe> 
        </div>
        <!--col1-->
        <div class="col-sm-6 col-xs-12">
            <style type="text/css">
                .form-group label{
                    width: 40% !important;
                }
                .require { font-weight:bold; color:#F00}


            </style>
            <p>Mọi thắc mắc hoặc góp ý, quý khách vui lòng liên hệ trực tiếp với bộ phận chăm sóc khách hàng của chúng tôi bằng cách điền đầy đủ thông tin vào form bên dưới</p>
            <form method="post"  name="registration" action="{{ route('addlienhe') }}" id="form-lienhe">
                @csrf

                <div class="form-group">
                    <label>Tên đầy đủ</label>
                    <input type="text" class="inputText" name="contact_name" id="contact_name">
                </div>
                <!--form-group-->
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="inputText" name="contact_email" id="contact_email">
                </div>
                <!--form-group-->
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="inputText" name="contact_tel" id="contact_tel">
                </div>
                <!--form-group-->
                <div class="form-group">
                    <label>Thông tin liên hệ</label>
                    <textarea rows="8" name="contact_message" id="contact_message" class="inputText" style="height:50px;"></textarea>
                </div>
                <!--form-group-->
                <input type="button" class="btn btn-primary" value="Gửi liên hệ" onclick="send_contact();" style="cursor:pointer;margin-top: 10px;width: 150px;line-height: 25px;text-align: center;background-color: #00ae93;border-radius: 5px;color: #fff;border: 1px solid #048a75;font-weight: 500;">
                <input type="hidden" value="send" name="action">
                <input type="hidden" name="return_url" value="/lien-he">
            </form>
            <br> <b>Email: lienhe@dienmaynguoiviet.vn </b><br>
            <b>Hotline: 0247.303.6336</b>
            <br><b>Address: 683 Nguyen khoai, Thanh Tri, Hoang Mai, Ha Noi</b><br>
            <b>Website: <a href="https://dienmaynguoiviet.vn/" target="_blank">https://dienmaynguoiviet.vn/</a></b>
            <script>
                function send_contact(){
                var error = "";
                var check_name = $("#contact_name").val();
                var check_email = $("#contact_email").val();
                var check_tel = $("#contact_tel").val();
                var check_message = $("#contact_message").val();  
                
                if(check_name.length < 2 && 2 > 1) error += "- Bạn chưa nhập tên\n";
                if(check_email.length < 2 && 2 > 1) error += "- Bạn chưa nhập email\n";
                if(check_tel.length < 2 && 2 > 1) error += "- Bạn chưa nhập SĐT\n";
                if(check_message.length < 2 && 2 > 1) error += "- Bạn chưa nhập nội dung\n";
               
                
                
                if(error == ""){
                     if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(check_email))
                      {
                        if(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(check_tel)){
                            $('#form-lienhe').submit();

                        }
                        else{
                             error += "số điện thoại không đúng định dạng";
                        }
                        
                      }
                      else{
                        error += "email không đúng định dạng";

                        alert(error);
                      }
                
                    
                }
                    else alert(error);
                    return false;
                }
            </script>
        </div>
        <!--col2-->
    </div>
    <!--row-->
</div>

@endsection