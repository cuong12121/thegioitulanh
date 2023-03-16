/*--author:phongbv@hurasoft.com--*/

$(document).ready(function(){
  
  
  /*mmenu*/
  $("#mmenu").mmenu({
    // options
  }, {
    // configuration
    classNames: {
      vertical: "expand"
    }
  });
  
  //toTop------
  $(function() {
    $(window).scroll(function() {
      if($(this).scrollTop() != 0) {
        $('#toTop').fadeIn().addClass("active");
      } else {
        $('#toTop').fadeOut().removeClass('active');
      }
    });
    
    $('#toTop').click(function() {
      $('body,html').animate({scrollTop:0},800);
    });
  });
  
  //--------
});

//function-----

function suggest(query_string) {
  if (query_string.length <= 1) {
    $('#suggestions').fadeOut();
  } else {
    if (!$.data(this, 'bouncing-locked')) {
      $.data(this, 'bouncing-locked', true);
      
      $.post("/ajax/get_product_list.php?template=header&cmd=ajax&show=product_search",
             { q: query_string },
             function(data) {
               $('#suggestions').html(data);
               $('#suggestions').show();
             }
            );
      
      self = this;
      setTimeout(function() {
        $.data(self, 'bouncing-locked', false);
      }, 500);
    }
  }
}

//Compare Pro
$(document).ready(function(){
  $("#product_compare_list").val("");
  $("input.p_check").removeAttr("checked");
  $("input.p_check").click(function(){
    if($(this).is(":checked")){
      $(".compare_area").prepend("<a href='#' class='"+$(this).attr("id")+"'><img src='"+$(this).attr("name")+"' alt='' /><i class='bg icon_del_compare'></i></a>");
    }else{
      $("."+$(this).attr("id")).remove();
    }
    
    $(".compare_area a").click(function(){
      $("#"+$(this).attr("class")).click();
      $("#"+$(this).attr("class")).removeAttr("checked");
      $(this).remove();
      return false;
    });
    if($(".compare_area a").length >= 2) $(".btn_compare").show();
    else $(".btn_compare").hide();
  });
  
});

//--------