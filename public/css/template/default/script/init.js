/*--author:phongbv@hurasoft.com--*/

var tplSearch = `<a href="{{productUrl}}" class="item">
<span class="img"><img class="lazy-ajax" src="{{productImage.medium}}" alt=""></span>
<span class="title"><span class="name d-block text-555 txt_555">{{productName}}</span><span class="price text-red txt_red">{{price}}</span></span></a>`;

function formatCurrency(a) {
  var b = parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
  var len = b.length;
  b = b.substring(0, len - 3);
  return b;
}

function transTplPro(value,template){

  isNew = value.productType.isNew; if (isNew == 1)  isNew = '<i class="new">Hàng mới</i>'; else isNew ='';
  isBestSale = value.productType.isBestSale; if (isBestSale == 1)  isBestSale = '<i class="bestsale">Bán chạy</i>'; else isBestSale ='';
  isSaleoff = value.productType.isSaleOff; if (isSaleoff == 1)  isSaleoff = '<i class="saleoff">Khuyến mãi</i>'; else isSaleoff ='';
  isHot = value.productType.isHot; if (isHot == 1)  isHot = '<i class="hot">Có bán sỉ</i>'; else isHot ='';

  productName  = value.productName;
  productUrl  = value.productUrl;
  productSummary  = value.productSummary;
  price = value.price;
  if (price == 0) price ="Giá: Liên hệ"; else price  = formatCurrency(value.price) +" đ";
  marketPrice = value.marketPrice;
  if (marketPrice > 0) marketPrice  = formatCurrency(value.marketPrice); else marketPrice  = "";
  percent = Math.round(100 - value.price*100/value.marketPrice);
  if (value.marketPrice > 0) percent = '<i class="percent rouded-circle">-'+ percent +'%</i>'; else percent="";
  specialOffer = value.specialOffer;
  if (specialOffer.length > 0) specialOffer = 'Khuyến mại: ' + value.specialOffer[0].content;
  quantity = "Liên hệ";
  if (value.quantity > 0)  quantity = "Còn hàng";

  return template
    .replace(new RegExp("{{isNew}}", "g"), isNew)
    .replace(new RegExp("{{isBestSale}}", "g"), isBestSale)
    .replace(new RegExp("{{isSaleoff}}", "g"), isSaleoff)
    .replace(new RegExp("{{isHot}}", "g"), isHot)
    .replace(new RegExp("{{productId}}", "g"), value.productId)
    .replace(new RegExp("{{productUrl}}", "g"), productUrl)
    .replace(new RegExp("{{productName}}", "g"), productName)
    .replace(new RegExp("{{productImage.medium}}", "g"), value.productImage.medium)
    .replace(new RegExp("{{productImage.large}}", "g"), value.productImage.large)
    .replace(new RegExp("{{price}}", "g"), price)
    .replace(new RegExp("{{marketPrice}}", "g"), marketPrice)
    .replace(new RegExp("{{percent}}", "g"), percent)
    .replace(new RegExp("{{specialOffer}}", "g"), specialOffer)
    .replace(new RegExp("{{quantity}}", "g"), quantity)
    .replace(new RegExp("{{productSummary}}", "g"), productSummary)
    .replace(new RegExp("{{rating}}", "g"), value.rating)
    .replace(new RegExp("{{reviewCount}}", "g"), value.reviewCount)
    .replace(new RegExp("{{visit}}", "g"), value.visit);
}

function fixTopMenu() {
  var L0, R0;
  var tab = $('.menu-top');
  L0 = tab.offset().left;
  R0 = L0 + tab.outerWidth();
  $('ul.child').each(function () {
    var L1 = $(this).parent().offset().left;
    var W1 = $(this).outerWidth();
    var R1 = L1 + W1;
    var id = $(this).attr('id');
    if (L1 - L0 < 50) {
      $(this).css('left', L0 - L1 - 1);
    }
    else if (R1 > R0) {
      $(this).css('left', R0 - R1 - 1);
    }
  });
}

function suggetSearch(content,key,productId,holder){
  $('.search-results').show();
  var key = $(key).val();
  var url= "/ajax/get_json.php?action=search&content="+content+"&q=" + key;

  $.getJSON( url, function(data) {
    var list = "";
    var data = data;  
    var item =[];
    //console.log(data);

    $.each( data, function( num, product ) {
      if(num >= 20) return;
      list += transTplPro(product, tplSearch);
    });

    $(holder).html(list);
  });
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


$(document).ready(function(){


  $(window).click(function() {
    $('.box-search .search-results').hide()
  });
  $('.box-search').click(function(event){
    event.stopPropagation();
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

  //fixTopMenu------
  fixTopMenu()

  //--------
});
//--------