/* Banner-area carousel slider */
$(document).ready(function(){

  $('#banner-area .owl-carousel').owlCarousel({
    loop:true,
    autoplay:true,
    autoplaySpeed:3000,
    dots:true,
    items:1
  });

  // top Sale owl carousel
  $('#top-sale .owl-carousel').owlCarousel({
    loop:true,
    nav:false,
    dots:false,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:3
      },
      1000:{
        items:5
      }
    }
  });

// isotope filter
var $grid = $(".grid").isotope({
  itemSelector:".grid-item",
  layoutMode: 'fitRows'
});

// filter items on button click
$('.button-group').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: 'filterValue' });
  console.log(filterValue);
});

// new phones owl carousel
$('#new-phones .owl-carousel').owlCarousel({
  loop:true,
  nav:false,
  dots:true,
  responsive:{
    0:{
      items:1
    },
    600:{
      items:3
    },
    1000:{
      items:5
    }
  }
});

// Categories owl carousel
$('#blogs .owl-carousel').owlCarousel({
  loop:true,
  nav:false,
  dots:true,
  responsive:{
    0:{
      items:1
    },
    600:{
      items:4
    }
  }
});


// product qty section
let $qty_up = $(".qty .qty-up");
let $qty_down = $(".qty .qty-down");
let $deal_price = $("#deal-price");
let $deal_price_ship_adr = $("#deal-price_ship_adr");
let $ship_adr_total = $("#ship_adr_total");
//let $input = $(".qty .qty_input")

 $qty_up.click(function(e) {
   let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
   let $price = $(`.product_price[data-id='${$(this).data("id")}']`);
   //change product price using ajax call
   $.ajax({
     url:"template/ajax.php",
     type:"post",
     data:{itemid:$(this).data("id")},
     success:function (result) {
     let obj = JSON.parse(result);
     let item_price = obj[0]['price'];
     let prod_id = obj[0]['id'];
     let sizes = obj[0]['sizes'];
     let available_qty = sizes.split(":");

     if ($input.val() >=1 && $input.val() < available_qty[1] && $input.val() <= 10) {
       $input.val(function (i,oldval) {
         return++oldval;
       });

    // update qty in cart...
       $.ajax({
         url:"template/ajax.php",
         type:"post",
         data:{prod_id:prod_id, qty:$input.val()},
         success:function(result_data){
           //alert(result_data);
         }
       });

       // increase price of the Product
       $price.text(parseInt(item_price * $input.val()).toFixed(2));

       // set subtotal price
       let subtotal = parseInt($deal_price.text()) +parseInt(item_price);
       $deal_price.text(subtotal.toFixed(2));
       $deal_price_ship_adr.text('Rs. ' + subtotal.toFixed(2));
       $ship_adr_total.text('Rs. ' + subtotal.toFixed(2));
     }
   } // closing success function...
 }); // closing ajax request

 });

 $qty_down.click(function(e) {
   let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
   let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

   //change product price using ajax call
   $.ajax({
     url:"template/ajax.php",
     type:"post",
     data:{itemid:$(this).data("id")},
     success:function (result) {
     let obj = JSON.parse(result);
     let item_price = obj[0]['price'];
     let prod_id = obj[0]['id'];

     if ($input.val() > 1 && $input.val() <= 10) {
       $input.val(function (i,oldval) {
         return--oldval;
       });

       // update qty in cart...
          $.ajax({
            url:"template/ajax.php",
            type:"post",
            data:{prod_id:prod_id, qty:$input.val()},
            success:function(result){
              //alert(result);
            }
          });

       // increase price of the Product
       $price.text(parseInt(item_price * $input.val()).toFixed(2));

       // set subtotal price
       let subtotal = parseInt($deal_price.text()) - parseInt(item_price);
       $deal_price.text(subtotal.toFixed(2));
       $deal_price_ship_adr.text('Rs. ' + subtotal.toFixed(2));
       $ship_adr_total.text('Rs. ' + subtotal.toFixed(2));
     }

   }
 }); // closing ajax request
}); // closing of down click


}); // closing of main script body.
