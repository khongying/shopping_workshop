<?php
    require_once('admin/conDB/conDB.php');
    require_once('function-products.php');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- Bootstrap -->
    <link href="bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-3.3.7/css/bootstrap-theme.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <!-- font-awesome -->
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <title>Shopping</title>
    <script>
      $( document ).ready(function() {
        $(".product-card_cert").click(function(){
          let count = $("#count_cart").attr("count");
          let display = "0";
          count = +count + 1;
          if (count > 99) {
            display ="99+"
          }else {
            display = count;
          }
            $("#count_cart").attr("count",count);
            $("#count_cart").html(display);

            /* in cart */
            let _id = $(this).parent().parent().attr('id');
            _id = _id.replace("product-", "");

            if (!$('input[name="product-'+_id+'"]').val() ) {

              let _str = '<input type="hidden" name="product-'+_id+'" value="1" />';
              console.log(_str);
              $("#form-cart").append(_str);

            }
            else {
              let _val = $('input[name="product-'+_id+'"]').val();
              _val = +_val + 1
              $('input[name="product-'+_id+'"]').val(_val);
            }
        });

        $("#btn-cart").click(function(){
         $.post( "list-product.php", $( "#form-cart" ).serialize() , function( data ) {
           $(".modal-body").html(data);
         });
       });


        $( window ).scroll(function() {
         var height = $(window).scrollTop();
         console.log(height);
         if(height  > 50) {
           $("body").addClass("scl_inited");
         }
         else{
           $("body").removeClass("scl_inited");
         }
     });

    });
    </script>
  </head>
  <body>
    <!-- Large modal -->
    <div class="modal fade" id="shoppingModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>-- Data not found --</p>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <header>
      <div id="menu" class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
          </ul>
      </div>
      <div id="div-search" class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="logo">
              <img src="image/coin.png" />
                Super Market
            </div>
          </div>
          <div class="col-md-6">
            <form class="form-inline">
              <div class="form-group" style="width: 100%">
                <div class="input-group">
                  <input type="text" id="search" placeholder="Search">
                  <div class="input-group-addon">
                      <i class="fa fa-search" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-3">
              <div id="btn-cart" data-toggle="modal" data-target="#shoppingModal">
                  <div id="cart"><img src="image/cart.png"></div>
                  <div id="count_cart" count="0">0</div>
                  <div id="in-cart"><form id="form-cart"></form></div>
              </div>
          </div>
        </div>
      </div>
    </header>
    <div>
      <div id="body" class="container-fluid">
        <div class="row">
          <div class="col-md-2">
              <div id="main-menu-category">
                <ul class="menu-category">
                  <li>Coffee</li>
                  <li>Tea</li>
                  <li>Milk</li>
                </ul>
              </div>
          </div>
          <div class="col-xs-10 col-md-10">
              <?php
              $data_product = get_products($DB_MAIN_LINK);
              if ($data_product['result'] === true) {
                // fore($i=1; $i<10; $i++){
                foreach ($data_product['data'] as $key => $value) {
                  ?>
                  <div class="product" id="product-<?=$value['id']?>">
                    <div class="product-card_img">
                      <img src="admin/product_image/<?=$value['image']?>" class="img_shopping">
                    </div>
                    <div class="product-card_description">
                        <div class="product-card_name">
                            <?=$value['name']?>
                        </div>
                        <div class="product-card_rate">
                          <?php
                            $rate =4;
                            for($star = 0; $star < 5; $star++){
                              if($rate > $star){
                                print '<img src="image/favorite.png"/>';
                              }
                              else{
                                print '<img src="image/star-c.png"/>';
                              }
                            }
                            print "<span class='review'>(22 รีวิว)</span>";
                          ?>
                        </div>
                        <div class="product-card_price"><?=number_format($value['price'])?> บาท</div>
                        <div class="product-card_cert"><i class="fa fa-shopping-basket" aria-hidden="true"></i> ใส่ตระกร้า</div>
                    </div>
                  </div>

              <?php
            }
          }
            ?>
          </div>


        </div>
      </div>
    </div>
  </body>
</html>
