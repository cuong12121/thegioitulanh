@extends('layouts.app')

@section('content')
<style type="text/css">
    
    @import url("https://fonts.googleapis.com/css?family=Muli&display=swap");
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap");

* {
  box-sizing: border-box;
}


.container {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  overflow: hidden;
  width: 400px;
  max-width: 100%;
}

.header {
  border-bottom: 1px solid #f0f0f0;
  background-color: #f7f7f7;
  padding: 20px 40px;
}

.header h2 {
  margin: 0;
}

.form {
  padding: 30px 40px;
}

.form-control {
  margin-bottom: 10px;
  padding-bottom: 20px;
  position: relative;
}

.form-controls label {
  display: inline-block;
  margin-bottom: 5px;
}

.form-controls input {
  border: 2px solid #f0f0f0;
  border-radius: 4px;
  display: block;
  font-family: inherit;
  font-size: 14px;
  padding: 10px;
  width: 100%;
}

.form-control input:focus {
  outline: 0;
  border-color: #777;
}

.form-control.success input {
  border-color: #2ecc71;
}

.form-controls.error input {
  border-color: #e74c3c;
}

.form-controls i {
  visibility: hidden;
  position: absolute;
  top: 40px;
  right: 10px;
}

.form-control.success i.fa-check-circle {
  color: #2ecc71;
  visibility: visible;
}

.form-control.error i.fa-exclamation-circle {
  color: #e74c3c;
  visibility: visible;
}

.form-controls small {
  color: #e74c3c;
  position: absolute;
  bottom: 0;
  left: 0;
  visibility: hidden;
}

.form-controls.error small {
  visibility: visible;
}

.form button {
  background-color: #8e44ad;
  border: 2px solid #8e44ad;
  border-radius: 4px;
  color: #fff;
  display: block;
  font-family: inherit;
  font-size: 16px;
  padding: 10px;
  margin-top: 20px;
  width: 100%;
}

/* SOCIAL PANEL CSS */
.social-panel-container {
  position: fixed;
  right: 0;
  bottom: 80px;
  transform: translateX(100%);
  transition: transform 0.4s ease-in-out;
}

.social-panel-container.visible {
  transform: translateX(-10px);
}

.social-panel {
  background-color: #fff;
  border-radius: 16px;
  box-shadow: 0 16px 31px -17px rgba(0, 31, 97, 0.6);
  border: 5px solid #001f61;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-family: "Muli";
  position: relative;
  height: 169px;
  width: 370px;
  max-width: calc(100% - 10px);
}

.social-panel button.close-btn {
  border: 0;
  color: #97a5ce;
  cursor: pointer;
  font-size: 20px;
  position: absolute;
  top: 5px;
  right: 5px;
}

.social-panel button.close-btn:focus {
  outline: none;
}

.social-panel p {
  background-color: #001f61;
  border-radius: 0 0 10px 10px;
  color: #fff;
  font-size: 14px;
  line-height: 18px;
  padding: 2px 17px 6px;
  position: absolute;
  top: 0;
  left: 50%;
  margin: 0;
  transform: translateX(-50%);
  text-align: center;
  width: 235px;
}

.social-panel p i {
  margin: 0 5px;
}

.social-panel p a {
  color: #ff7500;
  text-decoration: none;
}

.social-panel h4 {
  margin: 20px 0;
  color: #97a5ce;
  font-family: "Muli";
  font-size: 14px;
  line-height: 18px;
  text-transform: uppercase;
}

.social-panel ul {
  display: flex;
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.social-panel ul li {
  margin: 0 10px;
}

.social-panel ul li a {
  border: 1px solid #dce1f2;
  border-radius: 50%;
  color: #001f61;
  font-size: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  width: 50px;
  text-decoration: none;
}

.social-panel ul li a:hover {
  border-color: #ff6a00;
  box-shadow: 0 9px 12px -9px #ff6a00;
}

.floating-btn {
  border-radius: 26.5px;
  background-color: #001f61;
  border: 1px solid #001f61;
  box-shadow: 0 16px 22px -17px #03153b;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  line-height: 20px;
  padding: 12px 20px;
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 999;
}

.floating-btn:hover {
  background-color: #ffffff;
  color: #001f61;
}

.floating-btn:focus {
  outline: none;
}

.floating-text {
  background-color: #001f61;
  border-radius: 10px 10px 0 0;
  color: #fff;
  font-family: "Muli";
  padding: 7px 15px;
  position: fixed;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  z-index: 998;
}

.floating-text a {
  color: #ff7500;
  text-decoration: none;
}

@media screen and (max-width: 480px) {
  .social-panel-container.visible {
    transform: translateX(0px);
  }

  .floating-btn {
    right: 10px;
  }
}

</style>



<div class="container">
    <div class="header">
        <h2>Đổi passwords</h2>
    </div>

    @if (session('error'))
    <div class="alert alert-danger" role="alert">
            {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
    <form id="form" class="form" method="POST" action="{{ route('changepass') }}">
        @csrf
        <div class="form-controls">
            <?php $user = Auth::user()->name; ?>
            <label for="username">Username {{ $user }}</label>
            
        </div>
        <div class="form-controls">
            <label for="username">Password cũ</label>
            <input type="password" placeholder="" id="password_old" name="old_password" / required>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-controls">
            <label for="username">Password</label>
            <input type="password" placeholder="" id="password" name="password" / required>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-controls">
            <label for="username">Nhập lại password mới</label>
            <input type="password" placeholder="re-enter" id="password2" name="re_password" / required>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <button class="submit">Submit</button>
    </form>
</div>
<!-- SOCIAL PANEL HTML -->
<div class="social-panel-container">
    <div class="social-panel">
        <p>Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="https://florin-pop.com">Saksham Bhambota</a>
        </p>
        <button class=" close-btn"><i class="fas fa-times"></i></button>
        <h4>Get in touch on</h4>
        <ul>
            <li>
                <a href="https://twitter.com/sakshambhambot" target="_blank">
                <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/in/saksham-bhambota//" target="_blank">
                <i class="fab fa-linkedin"></i>
                </a>
            </li>
            <li>
                <a href="https://facebook.com/saksham.bhambota.77/" target="_blank">
                <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="https://instagram.com/saksham.bhambota_" target="_blank">
                <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">
  
  

    $( ".submit" ).click(function() {

      var rep_password = $('#password2').val();
      var password = $('#password').val();

      

      if(rep_password==password){
       
        return;

      }
      else{
         alert('2 mật khẩu không trùng nhau');  
          event.preventDefault();
      }
     
      
        
      });
    

 
</script>


@endsection